<?php

namespace App\Http\Controllers;

use App\Models\Evenement;

class EvenementFrontController extends Controller
{
    public function show(string $slug)
    {
        $evenement = Evenement::published()
            ->where('slug', $slug)
            ->firstOrFail();

        // Autres événements à venir (pour la sidebar)
        $upcomingEvents = Evenement::published()
            ->where('id', '!=', $evenement->id)
            ->where('event_date', '>', now())
            ->orderBy('event_date')
            ->take(4)
            ->get();

        return view('front-end.pages.evenement', compact('evenement', 'upcomingEvents'));
    }
}
