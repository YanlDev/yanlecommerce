<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\ProductFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Elimina la carpeta y la crea para que no se llene de imágenes basura
        Storage::deleteDirectory('products');
        Storage::makeDirectory('products');

        // User::factory(10)->create();
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('admin123'),
        ]);

        $this->call([
            FamilySeeder::class,
            OptionSeeder::class,
        ]);

        Product::factory(150)->create();
    }
}
