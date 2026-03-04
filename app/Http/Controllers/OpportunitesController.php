<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use Illuminate\Http\Request;

class OpportunitesController extends Controller
{
    public function index(Request $request)
    {
        $query = Opportunity::active();

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('organisme', 'like', "%{$search}%");
            });
        }

        $opportunites = $query->latest()->paginate(12)->withQueryString();

        $featured = Opportunity::active()->featured()->take(3)->get();

        $typeCounts = Opportunity::where('is_active', true)
            ->selectRaw('type, count(*) as count')
            ->groupBy('type')
            ->pluck('count', 'type');

        $total = Opportunity::where('is_active', true)->count();

        $types = [
            'emploi' => 'Emploi',
            'investissement' => 'Investissement',
            'formation' => 'Formation',
            'bourse' => 'Bourse',
            'appel_a_projets' => 'Appel à projets',
        ];

        return view('front-end.pages.opportunites', compact(
            'opportunites', 'featured', 'typeCounts', 'types', 'total'
        ));
    }
}
