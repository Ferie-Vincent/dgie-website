<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            [
                'acronym' => 'DAOSAR',
                'name' => 'Direction de l\'Aide, de l\'Orientation Sociale et de l\'Assistance au Retour',
                'description' => 'Accompagne les Ivoiriens de l\'extérieur dans leur projet de retour et de réintégration en Côte d\'Ivoire.',
                'link' => '/retour-reintegration',
                'order' => 1,
            ],
            [
                'acronym' => 'DMCRIE',
                'name' => 'Direction de la Mobilisation des Compétences et des Ressources des Ivoiriens de l\'Extérieur',
                'description' => 'Mobilise les compétences et les investissements de la diaspora pour le développement de la Côte d\'Ivoire.',
                'link' => '/investir-contribuer',
                'order' => 2,
            ],
            [
                'acronym' => 'DAS',
                'name' => 'Direction de l\'Action Sociale',
                'description' => 'Assure l\'action sociale en faveur des Ivoiriens de l\'extérieur et de leurs familles.',
                'link' => '/nos-services',
                'order' => 3,
            ],
        ];

        foreach ($departments as $dept) {
            Department::updateOrCreate(['acronym' => $dept['acronym']], $dept);
        }
    }
}
