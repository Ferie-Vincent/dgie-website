<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Contact
            ['key' => 'contact_address', 'value' => 'Abidjan, Plateau, Immeuble CAISTAB, 5e étage', 'group' => 'contact'],
            ['key' => 'contact_phone', 'value' => '+225 27 20 21 XX XX', 'group' => 'contact'],
            ['key' => 'contact_email', 'value' => 'info@dgie.gouv.ci', 'group' => 'contact'],
            ['key' => 'contact_hours', 'value' => 'Lundi - Vendredi : 8h00 - 16h30', 'group' => 'contact'],
            ['key' => 'contact_map_url', 'value' => '', 'group' => 'contact'],

            // Social
            ['key' => 'social_facebook', 'value' => 'https://facebook.com/DGIE.CI', 'group' => 'social'],
            ['key' => 'social_twitter', 'value' => 'https://twitter.com/DGIE_CI', 'group' => 'social'],
            ['key' => 'social_linkedin', 'value' => 'https://linkedin.com/company/dgie-ci', 'group' => 'social'],
            ['key' => 'social_youtube', 'value' => '', 'group' => 'social'],
            ['key' => 'social_instagram', 'value' => '', 'group' => 'social'],

            // Stats (chiffres clés homepage)
            ['key' => 'stat_diaspora', 'value' => '4.5', 'group' => 'stats'],
            ['key' => 'stat_diaspora_suffix', 'value' => 'M+', 'group' => 'stats'],
            ['key' => 'stat_diaspora_label', 'value' => 'Ivoiriens de l\'extérieur', 'group' => 'stats'],
            ['key' => 'stat_pays', 'value' => '92', 'group' => 'stats'],
            ['key' => 'stat_pays_suffix', 'value' => '', 'group' => 'stats'],
            ['key' => 'stat_pays_label', 'value' => 'Pays de résidence', 'group' => 'stats'],
            ['key' => 'stat_transferts', 'value' => '1200', 'group' => 'stats'],
            ['key' => 'stat_transferts_suffix', 'value' => 'Mds', 'group' => 'stats'],
            ['key' => 'stat_transferts_label', 'value' => 'FCFA de transferts annuels', 'group' => 'stats'],
            ['key' => 'stat_programmes', 'value' => '15', 'group' => 'stats'],
            ['key' => 'stat_programmes_suffix', 'value' => '+', 'group' => 'stats'],
            ['key' => 'stat_programmes_label', 'value' => 'Programmes actifs', 'group' => 'stats'],

            // SEO
            ['key' => 'seo_title', 'value' => 'DGIE — Direction Générale des Ivoiriens de l\'Extérieur', 'group' => 'seo'],
            ['key' => 'seo_description', 'value' => 'Site officiel de la Direction Générale des Ivoiriens de l\'Extérieur. Services, programmes et accompagnement de la diaspora ivoirienne.', 'group' => 'seo'],
            ['key' => 'seo_keywords', 'value' => 'DGIE, diaspora ivoirienne, Côte d\'Ivoire, retour, réintégration, investissement', 'group' => 'seo'],

            // Mot du directeur
            ['key' => 'mot_directeur_text', 'value' => '', 'group' => 'dgie'],
            ['key' => 'mot_directeur_photo', 'value' => '', 'group' => 'dgie'],
            ['key' => 'mot_directeur_name', 'value' => 'S.E.M. Gaoussou KARAMOKO', 'group' => 'dgie'],
            ['key' => 'mot_directeur_title', 'value' => 'Directeur Général des Ivoiriens de l\'Extérieur', 'group' => 'dgie'],

            // General
            ['key' => 'site_name', 'value' => 'DGIE', 'group' => 'general'],
            ['key' => 'site_full_name', 'value' => 'Direction Générale des Ivoiriens de l\'Extérieur', 'group' => 'general'],
            ['key' => 'ministry_name', 'value' => 'Ministère des Affaires Étrangères, de l\'Intégration Africaine et des Ivoiriens de l\'Extérieur', 'group' => 'general'],
            ['key' => 'footer_text', 'value' => '© 2025 DGIE — Direction Générale des Ivoiriens de l\'Extérieur', 'group' => 'general'],
            ['key' => 'emergency_number', 'value' => '+225 07 08 09 10 11', 'group' => 'general'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
