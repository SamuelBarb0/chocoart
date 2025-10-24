<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            // Categorías de Productos
            [
                'name' => 'Bombones',
                'slug' => 'bombones',
                'type' => 'product',
                'description' => 'Bombones artesanales de chocolate',
                'color' => '#e28dc4',
                'order' => 1,
                'active' => true,
            ],
            [
                'name' => 'Barras',
                'slug' => 'barras',
                'type' => 'product',
                'description' => 'Barras de chocolate premium',
                'color' => '#81cacf',
                'order' => 2,
                'active' => true,
            ],
            [
                'name' => 'Trufas',
                'slug' => 'trufas',
                'type' => 'product',
                'description' => 'Trufas de chocolate gourmet',
                'color' => '#c6d379',
                'order' => 3,
                'active' => true,
            ],
            [
                'name' => 'Tabletas',
                'slug' => 'tabletas',
                'type' => 'product',
                'description' => 'Tabletas de chocolate artesanal',
                'color' => '#5f3917',
                'order' => 4,
                'active' => true,
            ],
            [
                'name' => 'Gift Box',
                'slug' => 'gift-box',
                'type' => 'product',
                'description' => 'Cajas de regalo especiales',
                'color' => '#e28dc4',
                'order' => 5,
                'active' => true,
            ],
            [
                'name' => 'Temporada',
                'slug' => 'temporada',
                'type' => 'product',
                'description' => 'Productos de temporada especiales',
                'color' => '#81cacf',
                'order' => 6,
                'active' => true,
            ],

            // Categorías de Cursos (Niveles)
            [
                'name' => 'Principiante',
                'slug' => 'principiante',
                'type' => 'course',
                'description' => 'Cursos para quienes inician en el mundo del chocolate',
                'color' => '#c6d379',
                'order' => 1,
                'active' => true,
            ],
            [
                'name' => 'Intermedio',
                'slug' => 'intermedio',
                'type' => 'course',
                'description' => 'Cursos para perfeccionar técnicas',
                'color' => '#81cacf',
                'order' => 2,
                'active' => true,
            ],
            [
                'name' => 'Avanzado',
                'slug' => 'avanzado',
                'type' => 'course',
                'description' => 'Cursos avanzados para expertos',
                'color' => '#e28dc4',
                'order' => 3,
                'active' => true,
            ],
            [
                'name' => 'Todos los niveles',
                'slug' => 'todos-los-niveles',
                'type' => 'course',
                'description' => 'Cursos adaptables a cualquier nivel',
                'color' => '#5f3917',
                'order' => 4,
                'active' => true,
            ],

            // Categorías de Blog Posts
            [
                'name' => 'Técnicas',
                'slug' => 'tecnicas',
                'type' => 'post',
                'description' => 'Artículos sobre técnicas de chocolatería',
                'color' => '#e28dc4',
                'order' => 1,
                'active' => true,
            ],
            [
                'name' => 'Recetas',
                'slug' => 'recetas',
                'type' => 'post',
                'description' => 'Recetas y creaciones con chocolate',
                'color' => '#81cacf',
                'order' => 2,
                'active' => true,
            ],
            [
                'name' => 'Negocio',
                'slug' => 'negocio',
                'type' => 'post',
                'description' => 'Consejos para emprender en chocolatería',
                'color' => '#c6d379',
                'order' => 3,
                'active' => true,
            ],
            [
                'name' => 'Historia',
                'slug' => 'historia',
                'type' => 'post',
                'description' => 'Historia y cultura del chocolate',
                'color' => '#5f3917',
                'order' => 4,
                'active' => true,
            ],
            [
                'name' => 'Decoración',
                'slug' => 'decoracion',
                'type' => 'post',
                'description' => 'Técnicas de decoración con chocolate',
                'color' => '#e28dc4',
                'order' => 5,
                'active' => true,
            ],

            // Categorías de Galería (ejemplos)
            [
                'name' => 'Eventos',
                'slug' => 'eventos',
                'type' => 'gallery',
                'description' => 'Fotos de eventos y talleres',
                'color' => '#81cacf',
                'order' => 1,
                'active' => true,
            ],
            [
                'name' => 'Productos',
                'slug' => 'productos-galeria',
                'type' => 'gallery',
                'description' => 'Galería de nuestros productos',
                'color' => '#c6d379',
                'order' => 2,
                'active' => true,
            ],
            [
                'name' => 'Procesos',
                'slug' => 'procesos',
                'type' => 'gallery',
                'description' => 'Proceso de elaboración del chocolate',
                'color' => '#5f3917',
                'order' => 3,
                'active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug'], 'type' => $category['type']],
                $category
            );
        }

        $this->command->info('✓ Categorías creadas/actualizadas exitosamente');
    }
}
