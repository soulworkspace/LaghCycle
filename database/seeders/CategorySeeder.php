<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'الدراجات الهوائية',
                'slug' => 'bicycles',
                'type' => 'bicycle',
                'icon' => 'heroicon-o-bolt',
                'image' => 'https://images.unsplash.com/photo-1485965120184-e220f721d03e?auto=format&fit=crop&w=1200&q=80',
                'description' => 'دراجات جبلية ومدنية ودراجات الطرق والأطفال والكهربائية.',
                'sort_order' => 1,
                'children' => [
                    ['name' => 'دراجات جبلية', 'slug' => 'mountain-bikes'],
                    ['name' => 'دراجات الطرق', 'slug' => 'road-bikes'],
                    ['name' => 'دراجات المدينة', 'slug' => 'city-bikes'],
                    ['name' => 'دراجات الأطفال', 'slug' => 'kids-bikes'],
                    ['name' => 'دراجات هوائية كهربائية', 'slug' => 'electric-bicycles'],
                ],
            ],
            [
                'name' => 'الدراجات النارية والسكوترات',
                'slug' => 'motorcycles',
                'type' => 'motorcycle',
                'icon' => 'heroicon-o-bolt',
                'image' => 'https://images.unsplash.com/photo-1558981806-ec527fa84c39?auto=format&fit=crop&w=1200&q=80',
                'description' => 'دراجات نارية وسكوترات بمختلف الأحجام وأنواع المحركات.',
                'sort_order' => 2,
                'children' => [
                    ['name' => 'سكوترات', 'slug' => 'scooters'],
                    ['name' => 'دراجات نارية للمدينة', 'slug' => 'commuter-motorcycles'],
                    ['name' => 'دراجات نارية رياضية', 'slug' => 'sport-motorcycles'],
                    ['name' => 'دراجات الطرق الوعرة', 'slug' => 'off-road-motorcycles'],
                    ['name' => 'دراجات نارية كهربائية', 'slug' => 'electric-motorcycles'],
                ],
            ],
        ];

        foreach ($categories as $categoryData) {
            $children = $categoryData['children'] ?? [];
            unset($categoryData['children']);

            $parent = Category::updateOrCreate(
                ['slug' => $categoryData['slug']],
                [...$categoryData, 'parent_id' => null, 'is_active' => true, 'show_in_menu' => true],
            );
            foreach ($children as $sortOrder => $childData) {
                Category::updateOrCreate(
                    ['slug' => $childData['slug']],
                    [
                        ...$childData,
                        'parent_id' => $parent->id,
                        'type' => $categoryData['type'],
                        'sort_order' => $sortOrder + 1,
                        'is_active' => true,
                        'show_in_menu' => true,
                    ],
                );
            }
        }

        Category::query()
            ->whereIn('slug', [
                'suv', 'compact-crossover', 'family-suv-7-seats', 'luxury-suv',
                'sedan-hatchback', 'economy-sedan', 'luxury-sedan', 'hatchback',
                'electric-hybrid', 'full-electric', 'plug-in-hybrid',
                'commercial-vehicles', 'pickup-trucks', 'cargo-vans',
            ])
            ->update(['is_active' => false, 'show_in_menu' => false]);

        $this->command->info('Bicycle and motorcycle categories seeded successfully.');
    }
}