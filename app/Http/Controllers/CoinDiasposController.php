<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use App\Models\Testimonial;
use App\Models\Country;
use App\Models\CulturalItem;
use App\Models\PollQuestion;
use App\Models\ToolkitItem;

class CoinDiasposController extends Controller
{
    public function index()
    {
        // Prochain événement diaspora à venir
        $nextDiaspoEvent = Evenement::where('status', 'publie')
            ->where('section', 'diaspora')
            ->where('event_date', '>', now())
            ->orderBy('event_date')
            ->first();

        // Si aucun événement diaspora, prendre le prochain événement général
        if (!$nextDiaspoEvent) {
            $nextDiaspoEvent = Evenement::where('status', 'publie')
                ->where('event_date', '>', now())
                ->orderBy('event_date')
                ->first();
        }

        // Événements diaspora passés (réalisés)
        $pastDiaspoEvents = Evenement::where('status', 'publie')
            ->where('section', 'diaspora')
            ->where('event_date', '<', now())
            ->orderByDesc('event_date')
            ->take(4)
            ->get();

        // Événements diaspora à venir (hors le prochain)
        $upcomingDiaspoEvents = Evenement::where('status', 'publie')
            ->where('section', 'diaspora')
            ->where('event_date', '>', now())
            ->when($nextDiaspoEvent, fn($q) => $q->where('id', '!=', $nextDiaspoEvent->id))
            ->orderBy('event_date')
            ->take(4)
            ->get();

        // Témoignages actifs
        $testimonials = Testimonial::where('is_active', true)
            ->orderByDesc('created_at')
            ->take(3)
            ->get();

        // Pays diaspora
        $countries = Country::where('is_active', true)
            ->orderBy('name')
            ->get();

        // Coups de coeur culturels
        $culturalItems = CulturalItem::where('is_active', true)
            ->orderByDesc('created_at')
            ->take(4)
            ->get();

        // Sondage actif
        $activePoll = PollQuestion::with('options')
            ->where('is_active', true)
            ->orderByDesc('created_at')
            ->first();

        // Boîte à outils
        $toolkitItems = ToolkitItem::where('is_active', true)
            ->orderBy('order')
            ->take(4)
            ->get();

        return view('front-end.pages.coin-des-diaspos', compact(
            'nextDiaspoEvent',
            'pastDiaspoEvents',
            'upcomingDiaspoEvents',
            'testimonials',
            'countries',
            'culturalItems',
            'activePoll',
            'toolkitItems'
        ));
    }
}
