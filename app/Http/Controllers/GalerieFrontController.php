<?php

namespace App\Http\Controllers;

use App\Models\GalerieAlbum;
use Illuminate\Http\Request;

class GalerieFrontController extends Controller
{
    public function index(Request $request)
    {
        // Exclude YouTube video albums — only show self-uploaded content
        $excludeYoutube = function ($q) {
            $q->whereDoesntHave('items', function ($qi) {
                $qi->where('file_path', 'like', '%youtube.com%')
                   ->orWhere('file_path', 'like', '%youtu.be%');
            });
        };

        $albums = GalerieAlbum::published()
            ->with('items')
            ->tap($excludeYoutube)
            ->when($request->type, fn($q, $type) => $q->where('type', $type))
            ->latest()
            ->get();

        $totalCount = GalerieAlbum::published()->tap($excludeYoutube)->count();
        $photoCount = GalerieAlbum::published()->where('type', 'photo')->tap($excludeYoutube)->count();
        $videoCount = GalerieAlbum::published()->where('type', 'video')->tap($excludeYoutube)->count();

        $albumsJson = $albums->map(function ($a) {
            return [
                'title' => $a->title,
                'type' => $a->type,
                'photos' => $a->items->map(function ($i) use ($a) {
                    if ($a->type === 'video' && str_contains($i->file_path, 'youtube.com')) {
                        preg_match('/[?&]v=([^&]+)/', $i->file_path, $m);
                        $src = $m ? 'https://www.youtube.com/embed/' . $m[1] : $i->file_path;
                    } else {
                        $src = asset('storage/' . $i->file_path);
                    }
                    return [
                        'src' => $src,
                        'caption' => $i->title ?? $a->title,
                    ];
                }),
            ];
        });

        return view('front-end.pages.galerie', compact('albums', 'totalCount', 'photoCount', 'videoCount', 'albumsJson'));
    }
}
