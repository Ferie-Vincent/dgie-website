<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $countries = [
            ['name' => 'France', 'flag_emoji' => '🇫🇷', 'population_label' => '120 000+ Ivoiriens', 'order' => 1],
            ['name' => 'États-Unis', 'flag_emoji' => '🇺🇸', 'population_label' => '80 000+ Ivoiriens', 'order' => 2],
            ['name' => 'Canada', 'flag_emoji' => '🇨🇦', 'population_label' => '50 000+ Ivoiriens', 'order' => 3],
            ['name' => 'Maroc', 'flag_emoji' => '🇲🇦', 'population_label' => '25 000+ Ivoiriens', 'order' => 4],
            ['name' => 'Tunisie', 'flag_emoji' => '🇹🇳', 'population_label' => '15 000+ Ivoiriens', 'order' => 5],
            ['name' => 'Belgique', 'flag_emoji' => '🇧🇪', 'population_label' => '30 000+ Ivoiriens', 'order' => 6],
            ['name' => 'Allemagne', 'flag_emoji' => '🇩🇪', 'population_label' => '20 000+ Ivoiriens', 'order' => 7],
            ['name' => 'Italie', 'flag_emoji' => '🇮🇹', 'population_label' => '18 000+ Ivoiriens', 'order' => 8],
            ['name' => 'Royaume-Uni', 'flag_emoji' => '🇬🇧', 'population_label' => '15 000+ Ivoiriens', 'order' => 9],
            ['name' => 'Chine', 'flag_emoji' => '🇨🇳', 'population_label' => '10 000+ Ivoiriens', 'order' => 10],
            ['name' => 'Sénégal', 'flag_emoji' => '🇸🇳', 'population_label' => '40 000+ Ivoiriens', 'order' => 11],
            ['name' => 'Gabon', 'flag_emoji' => '🇬🇦', 'population_label' => '35 000+ Ivoiriens', 'order' => 12],
        ];

        foreach ($countries as $country) {
            Country::updateOrCreate(['name' => $country['name']], $country);
        }
    }
}
