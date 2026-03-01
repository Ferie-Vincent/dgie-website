<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalerieAlbum;
use App\Models\GalerieItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GalerieController extends Controller
{
    public function index()
    {
        $albums = GalerieAlbum::where('type', 'photo')
            ->with('items')
            ->withCount('items')
            ->latest()
            ->get();

        $videos = GalerieAlbum::where('type', 'video')
            ->with('items')
            ->latest()
            ->get();

        return view('back-end.galerie.index', compact('albums', 'videos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:photo,video',
            'status' => 'required|in:brouillon,publie,archive',
            'description' => 'nullable|string|max:1000',
            'event_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'cover_image' => 'nullable|image|max:2048',
            'photos' => 'nullable|array',
            'photos.*' => 'file|max:51200|mimes:jpg,jpeg,png,gif,webp,mp4,mov,webm',
            'video_url' => 'nullable|url|max:500',
        ]);

        $albumData = [
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'type' => $validated['type'],
            'status' => $validated['status'],
            'description' => $validated['description'] ?? null,
            'event_date' => $validated['event_date'] ?? null,
            'location' => $validated['location'] ?? null,
        ];

        if ($request->hasFile('cover_image')) {
            $albumData['cover_image'] = $request->file('cover_image')->store('galerie', 'public');
        }

        $album = GalerieAlbum::create($albumData);

        // Handle multi-upload (photos + videos)
        if ($request->hasFile('photos')) {
            $order = 0;
            foreach ($request->file('photos') as $file) {
                $path = $file->store('galerie/items', 'public');
                $isVideo = str_starts_with($file->getMimeType(), 'video/');
                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $safeName = Str::slug($originalName) ?: 'media';
                GalerieItem::create([
                    'album_id' => $album->id,
                    'title' => $safeName . '.' . $file->getClientOriginalExtension(),
                    'file_path' => $path,
                    'type' => $isVideo ? 'video' : 'image',
                    'order' => $order++,
                ]);
            }
            $album->update(['items_count' => $album->items()->count()]);
        }

        // Handle YouTube video URL
        if ($validated['type'] === 'video' && !empty($validated['video_url'])) {
            GalerieItem::create([
                'album_id' => $album->id,
                'title' => $validated['title'],
                'file_path' => $validated['video_url'],
                'type' => 'video',
                'order' => 0,
            ]);
        }

        return redirect()->route('admin.galerie.index')
            ->with('success', 'Album créé avec succès.');
    }

    public function update(Request $request, GalerieAlbum $galerie)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|in:brouillon,publie,archive',
            'description' => 'nullable|string|max:1000',
            'event_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'cover_image' => 'nullable|image|max:2048',
            'photos' => 'nullable|array',
            'photos.*' => 'file|max:51200|mimes:jpg,jpeg,png,gif,webp,mp4,mov,webm',
            'video_url' => 'nullable|url|max:500',
        ]);

        $albumData = [
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'status' => $validated['status'],
            'description' => $validated['description'] ?? null,
            'event_date' => $validated['event_date'] ?? null,
            'location' => $validated['location'] ?? null,
        ];

        if ($request->hasFile('cover_image')) {
            $albumData['cover_image'] = $request->file('cover_image')->store('galerie', 'public');
        }

        $galerie->update($albumData);

        // Handle new media uploads (photos + videos)
        if ($request->hasFile('photos')) {
            $maxOrder = $galerie->items()->max('order') ?? -1;
            foreach ($request->file('photos') as $file) {
                $path = $file->store('galerie/items', 'public');
                $isVideo = str_starts_with($file->getMimeType(), 'video/');
                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $safeName = Str::slug($originalName) ?: 'media';
                GalerieItem::create([
                    'album_id' => $galerie->id,
                    'title' => $safeName . '.' . $file->getClientOriginalExtension(),
                    'file_path' => $path,
                    'type' => $isVideo ? 'video' : 'image',
                    'order' => ++$maxOrder,
                ]);
            }
            $galerie->loadCount('items');
            $galerie->update(['items_count' => $galerie->items_count]);
        }

        // Handle video URL update
        if ($galerie->type === 'video' && !empty($validated['video_url'])) {
            $item = $galerie->items()->first();
            if ($item) {
                $item->update(['file_path' => $validated['video_url'], 'title' => $validated['title']]);
            } else {
                GalerieItem::create([
                    'album_id' => $galerie->id,
                    'title' => $validated['title'],
                    'file_path' => $validated['video_url'],
                    'type' => 'video',
                    'order' => 0,
                ]);
            }
        }

        return redirect()->route('admin.galerie.index')
            ->with('success', 'Album mis à jour avec succès.');
    }

    public function destroy(GalerieAlbum $galerie)
    {
        $galerie->items()->delete();
        $galerie->delete();

        return redirect()->route('admin.galerie.index')
            ->with('success', 'Album supprimé avec succès.');
    }
}
