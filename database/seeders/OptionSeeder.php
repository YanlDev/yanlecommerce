<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tipo 1 es texto tipo 2 es color
        $options = [
            [
                'name' => 'Talla',
                'type' => 1,
                'features' => [
                    [
                        'value' => 'S',
                        'description' => 'Small',
                    ],
                    [
                        'value' => 'M',
                        'description' => 'Medium',
                    ],
                    [
                        'value' => 'L',
                        'description' => 'Large',
                    ],
                    [
                        'value' => 'Xl',
                        'description' => 'Extra large',
                    ]

                ]
            ],
            [
                'name' => 'Color',
                'type' => 2,
                'features' => [
                    [
                        'value' => '#ffffff',
                        'description' => 'Blanco',
                    ],
                    [
                        'value' => '#000000',
                        'description' => 'Negro',
                    ],
                    [
                        'value' => '#00ff59',
                        'description' => 'Verde',
                    ],
                    [
                        'value' => '#ff0000',
                        'description' => 'Rojo',
                    ]
                ]
            ],
            [
                'name' => 'Sexo',
                'type' => 1,
                'features' => [
                    [
                        'value' => 'M',
                        'description' => 'Masculino',
                    ],
                    [
                        'value' => 'F',
                        'description' => 'Femenino',
                    ]
                ]
            ]
        ];

        foreach ($options as $option) {
            $optionModel = Option::create([
                'name' => $option['name'],
                'type' => $option['type'],
            ]);
            foreach ($option['features'] as $feature) {
                $optionModel->features()->create([
                    'value' => $feature['value'],
                    'description' => $feature['description'],
                ]);
            }
        }

    }
}
