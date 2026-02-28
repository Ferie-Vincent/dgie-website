<?php

namespace App\Http\Controllers;

use App\Models\Dossier;
use Illuminate\Support\Collection;

class DossierFrontController extends Controller
{
    /**
     * Maps URL slugs to blade template names.
     * Accepts both short URL slugs and full DB slugs.
     */
    private const TEMPLATE_MAP = [
        'retour-volontaire'                          => 'retour-volontaire',
        'retour-volontaire-et-reintegration'         => 'retour-volontaire',
        'accompagnement-social'                      => 'accompagnement-social',
        'accompagnement-social-des-migrants'         => 'accompagnement-social',
        'cadre-juridique'                            => 'cadre-juridique',
        'cadre-juridique-et-textes-de-reference'     => 'cadre-juridique',
        'competences-diaspora'                       => 'competences-diaspora',
        'mobilisation-des-competences-de-la-diaspora' => 'competences-diaspora',
        'investissement-diaspora'                    => 'investissement-diaspora',
        'investissement-de-la-diaspora'              => 'investissement-diaspora',
        'partenariats'                               => 'partenariats',
        'partenariats-internationaux'                => 'partenariats',
    ];

    public function index()
    {
        $dossiers = Dossier::published()
            ->withCount(['articles' => fn ($q) => $q->where('status', 'publie')])
            ->orderBy('order')
            ->get();

        return view('front-end.pages.dossiers', compact('dossiers'));
    }

    public function show(string $slug)
    {
        $template = self::TEMPLATE_MAP[$slug] ?? null;
        abort_unless($template, 404);

        // Try exact DB match, then prefix match
        $dossier = Dossier::published()->where('slug', $slug)->first()
            ?? Dossier::published()->where('slug', 'like', $slug . '%')->first();

        // Load dynamic data if dossier exists, empty collections otherwise
        $testimonials = $dossier
            ? $dossier->testimonials()->where('is_active', true)->orderBy('order')->get()
            : new Collection();

        $faqs = $dossier
            ? $dossier->faqs()->orderBy('order')->get()
            : new Collection();

        return view('front-end.pages.dossier-' . $template, compact('dossier', 'testimonials', 'faqs'));
    }
}
