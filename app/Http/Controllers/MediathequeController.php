<?php

namespace App\Http\Controllers;

use App\Models\GalerieAlbum;

class MediathequeController extends Controller
{
    public function index()
    {
        $videos = GalerieAlbum::where('type', 'video')
            ->where('status', 'publie')
            ->with('items')
            ->latest()
            ->get()
            ->map(function ($album) {
                $url = $album->items->first()?->file_path ?? '';
                $videoId = $this->extractYoutubeId($url);
                return (object) [
                    'title' => $album->title,
                    'video_id' => $videoId,
                    'embed_url' => $videoId ? "https://www.youtube.com/embed/{$videoId}" : '',
                    'thumbnail' => $videoId ? "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg" : '',
                    'date' => $album->created_at,
                ];
            })
            ->filter(fn($v) => $v->video_id);

        return view('front-end.pages.mediatheque', compact('videos'));
    }

    private function extractYoutubeId(string $url): ?string
    {
        if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $m)) {
            return $m[1];
        }
        return null;
    }
}
