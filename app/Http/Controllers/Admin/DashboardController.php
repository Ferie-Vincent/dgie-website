<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
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

        return view('back-end.dashboard', compact('stats', 'recentArticles', 'recentEvenements', 'recentMessages', 'portraits', 'adBanners', 'heroBanner'));
    }
}
