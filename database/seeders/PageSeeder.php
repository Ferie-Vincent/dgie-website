<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            ['title' => 'La DGIE', 'slug' => 'la-dgie', 'meta_description' => 'Découvrez la Direction Générale des Ivoiriens de l\'Extérieur.'],
            ['title' => 'Nos services', 'slug' => 'nos-services', 'meta_description' => 'Les services de la DGIE pour la diaspora ivoirienne.'],
            ['title' => 'Contact', 'slug' => 'contact', 'meta_description' => 'Contactez la DGIE.'],
            ['title' => 'Le coin des diaspos', 'slug' => 'coin-des-diaspos', 'meta_description' => 'Espace dédié à la diaspora ivoirienne.'],
            ['title' => 'Mentions légales', 'slug' => 'mentions-legales', 'meta_description' => 'Mentions légales du site DGIE.'],
            ['title' => 'Politique de confidentialité', 'slug' => 'politique-confidentialite', 'meta_description' => 'Politique de confidentialité du site DGIE.'],
            ['title' => 'Plan du site', 'slug' => 'plan-du-site', 'meta_description' => 'Plan du site DGIE — toutes les pages accessibles.'],
        ];

        foreach ($pages as $page) {
            Page::create($page);
        }
    }
}
