<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Teknologi & IT',
                'description' => 'Event dan bootcamp seputar teknologi informasi, programming, dan digital skill',
                'icon' => '💻',
            ],
            [
                'name' => 'Kewirausahaan & Bisnis',
                'description' => 'Pelatihan dan workshop tentang entrepreneurship dan pengembangan bisnis',
                'icon' => '💼',
            ],
            [
                'name' => 'Pengembangan Diri',
                'description' => 'Program pengembangan soft skill dan personal development',
                'icon' => '🎯',
            ],
            [
                'name' => 'Sosial & Kemanusiaan',
                'description' => 'Kegiatan sosial, volunteer, dan community service',
                'icon' => '❤️',
            ],
            [
                'name' => 'Seni & Kreativitas',
                'description' => 'Workshop dan kelas kreatif di bidang seni dan desain',
                'icon' => '🎨',
            ],
            [
                'name' => 'Kesehatan & Olahraga',
                'description' => 'Event seputar kesehatan, fitness, dan gaya hidup sehat',
                'icon' => '💪',
            ],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
                'icon' => $category['icon'],
                'is_active' => true,
            ]);
        }
    }
}