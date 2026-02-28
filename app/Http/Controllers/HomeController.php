<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Evenement;
use App\Models\GalerieAlbum;
use App\Models\Magazine;
use App\Models\Partner;
use App\Models\Staff;

class HomeController extends Controller
{
    public function index()
    {
        // Load all published articles in a single query, then split
        $allArticles = Article::published()
            ->with('category')
            ->latest('published_at')
            ->take(50)
            ->get();

        $featuredArticles = $allArticles->take(3);
        $featuredIds = $featuredArticles->pluck('id');
        $latestArticles = $allArticles->whereNotIn('id', $featuredIds)->take(4);
        $returnArticles = $allArticles->where('section', 'retour')->take(2);
        $investArticles = $allArticles->where('section', 'investir')->take(2);
        $actionSocialeArticles = $allArticles->where('section', 'action-sociale')->take(2);

        // Gallery albums (latest 2, excluding YouTube video albums)
        $galleryAlbums = GalerieAlbum::published()
            ->whereDoesntHave('items', function ($q) {
                $q->where('file_path', 'like', '%youtube.com%')
                  ->orWhere('file_path', 'like', '%youtu.be%');
            })
            ->with(['items' => fn ($q) => $q->orderBy('order')->take(6)])
            ->latest()
            ->take(2)
            ->get();

        // Videos (existing logic)
        $videos = GalerieAlbum::where('type', 'video')
            ->where('status', 'publie')
            ->with('items')
            ->latest()
            ->take(3)
            ->get()
            ->map(function ($video) {
                $url = $video->items->first()?->file_path ?? '';
                $videoId = $this->extractYoutubeId($url);
                return (object) [
                    'title' => $video->title,
                    'url' => $url,
                    'video_id' => $videoId,
                    'embed_url' => $videoId ? "https://www.youtube.com/embed/{$videoId}" : '',
                    'thumbnail' => $videoId ? "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg" : '',
                ];
            })
            ->filter(fn ($v) => $v->video_id);

        // Sidebar: officials
        $officials = Staff::active()->orderBy('order')->get();

        // Sidebar: next upcoming event
        $nextEvent = Evenement::published()
            ->where('event_date', '>', now())
            ->orderBy('event_date')
            ->first();

        // Sidebar: calendar events (JSON for JS)
        $calendarEventsRaw = Evenement::published()
            ->whereNotNull('event_date')
            ->get();

        $calendarEventsFormatted = $calendarEventsRaw->mapWithKeys(function ($evt) {
            return [$evt->event_date->format('Y-m-d') => $evt->title . ' — ' . ($evt->location ?? 'Abidjan')];
        });

        // Sidebar: categories with article counts
        $categories = Category::withCount(['articles' => fn ($q) => $q->published()])
            ->having('articles_count', '>', 0)
            ->orderByDesc('articles_count')
            ->get();

        // Partners
        $homePartners = Partner::active()->get();

        // Modal event (featured)
        $modalEvent = Evenement::published()->featured()
            ->where('event_date', '>', now())
            ->first();

        // Ad banners (3 pubs sur la page d'accueil)
        $adBanners = Banner::active()->position('pub')->take(3)->get();

        // Latest magazine
        $latestMagazine = Magazine::active()->latest('published_at')->first();

        return view('front-end.pages.home', compact(
            'featuredArticles',
            'latestArticles',
            'returnArticles',
            'investArticles',
            'actionSocialeArticles',
            'galleryAlbums',
            'videos',
            'officials',
            'nextEvent',
            'calendarEventsFormatted',
            'categories',
            'homePartners',
            'modalEvent',
            'adBanners',
            'latestMagazine'
        ));
    }

    private function extractYoutubeId(string $url): ?string
    {
        if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $m)) {
            return $m[1];
        }
        return null;
    }
}
