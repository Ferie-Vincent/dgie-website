<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\AuditLog;
use App\Models\Category;
use App\Models\Dossier;
use App\Models\Evenement;
use App\Models\FlashInfo;
use App\Models\GalerieAlbum;
use App\Models\User;
use App\Models\Comment;
use App\Models\ContactMessage;
use App\Models\NewsletterSubscriber;
use App\Models\Testimonial;
use App\Models\Partner;
use App\Models\FaqItem;
use App\Models\Staff;
use App\Models\Banner;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'articles' => Article::count(),
            'categories' => Category::count(),
            'dossiers' => Dossier::count(),
            'evenements' => Evenement::count(),
            'flash_infos' => FlashInfo::where('is_active', true)->count(),
            'albums' => GalerieAlbum::count(),
            'utilisateurs' => User::count(),
            'comments_pending' => Comment::where('is_approved', false)->count(),
            'messages_unread' => ContactMessage::where('is_read', false)->count(),
            'newsletter' => NewsletterSubscriber::where('is_active', true)->count(),
            'testimonials' => Testimonial::where('is_active', true)->count(),
            'partners' => Partner::where('is_active', true)->count(),
            'faqs' => FaqItem::count(),
        ];

        $recentArticles = Article::with('category', 'author')
            ->latest()
            ->take(5)
            ->get();

        $recentEvenements = Evenement::latest()
            ->take(5)
            ->get();

        $recentMessages = ContactMessage::latest()
            ->take(5)
            ->get();

        $portraits = Staff::whereIn('type', ['ministre', 'dg'])
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        $adBanners = Banner::where('position', 'pub')
            ->orderBy('order')
            ->get();

        $heroBanner = Banner::where('position', 'top')
            ->where('is_active', true)
            ->first();

        // --- Chart 1: Activité globale par semaine (3 derniers mois) ---
        $threeMonthsAgo = Carbon::now()->subMonths(3);

        $chartRaw = AuditLog::where('created_at', '>=', $threeMonthsAgo)
            ->selectRaw("DATE(created_at) as date, action, COUNT(*) as count")
            ->groupBy('date', 'action')
            ->orderBy('date')
            ->get()
            ->groupBy('date')
            ->map(fn($dayGroup) => [
                'created' => $dayGroup->where('action', 'created')->sum('count'),
                'updated' => $dayGroup->where('action', 'updated')->sum('count'),
                'deleted' => $dayGroup->where('action', 'deleted')->sum('count'),
            ]);

        $activityLabels = [];
        $activityCreated = [];
        $activityUpdated = [];
        $activityDeleted = [];
        $current = $threeMonthsAgo->copy()->startOfWeek();
        $now = Carbon::now();

        while ($current->lte($now)) {
            $weekEnd = $current->copy()->endOfWeek();
            $activityLabels[] = $current->format('d M');
            $weekCreated = 0;
            $weekUpdated = 0;
            $weekDeleted = 0;
            $day = $current->copy();
            while ($day->lte($weekEnd) && $day->lte($now)) {
                $dateStr = $day->format('Y-m-d');
                if ($chartRaw->has($dateStr)) {
                    $weekCreated += $chartRaw[$dateStr]['created'];
                    $weekUpdated += $chartRaw[$dateStr]['updated'];
                    $weekDeleted += $chartRaw[$dateStr]['deleted'];
                }
                $day->addDay();
            }
            $activityCreated[] = $weekCreated;
            $activityUpdated[] = $weekUpdated;
            $activityDeleted[] = $weekDeleted;
            $current->addWeek();
        }

        // --- Chart 2: Articles par statut ---
        $articlesByStatus = [
            'publie' => Article::where('status', 'publie')->count(),
            'brouillon' => Article::where('status', 'brouillon')->count(),
            'archive' => Article::where('status', 'archive')->count(),
        ];

        // --- Chart 3: Publications par mois (6 derniers mois) ---
        $sixMonthsAgo = Carbon::now()->subMonths(5)->startOfMonth();
        $monthlyRaw = Article::where('status', 'publie')
            ->where('created_at', '>=', $sixMonthsAgo)
            ->selectRaw("YEAR(created_at) as y, MONTH(created_at) as m, COUNT(*) as count")
            ->groupBy('y', 'm')
            ->orderBy('y')
            ->orderBy('m')
            ->get()
            ->keyBy(fn($item) => $item->y . '-' . str_pad($item->m, 2, '0', STR_PAD_LEFT));

        $monthlyLabels = [];
        $monthlyData = [];
        $monthCursor = $sixMonthsAgo->copy();
        while ($monthCursor->lte($now)) {
            $key = $monthCursor->format('Y-m');
            $monthlyLabels[] = $monthCursor->translatedFormat('M Y');
            $monthlyData[] = $monthlyRaw->has($key) ? $monthlyRaw[$key]->count : 0;
            $monthCursor->addMonth();
        }

        return view('back-end.dashboard', compact(
            'stats', 'recentArticles', 'recentEvenements', 'recentMessages',
            'portraits', 'adBanners', 'heroBanner',
            'activityLabels', 'activityCreated', 'activityUpdated', 'activityDeleted',
            'articlesByStatus', 'monthlyLabels', 'monthlyData'
        ));
    }
}
