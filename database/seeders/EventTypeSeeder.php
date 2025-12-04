<?php

namespace Database\Seeders;

use App\Models\EventType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EventTypeSeeder extends Seeder
{
    public function run(): void
    {
        $eventTypes = [
            [
                'name' => 'Bootcamp',
                'description' => 'Program pelatihan intensif dengan durasi beberapa minggu hingga bulan',
            ],
            [
                'name' => 'Workshop',
                'description' => 'Pelatihan praktis dengan durasi singkat (1-3 hari)',
            ],
            [
                'name' => 'Seminar',
                'description' => 'Kegiatan presentasi dan diskusi topik tertentu',
            ],
            [
                'name' => 'Webinar',
                'description' => 'Seminar online melalui platform digital',
            ],
            [
                'name' => 'Course',
                'description' => 'Kursus pembelajaran terstruktur dengan materi bertahap',
            ],
            [
                'name' => 'Volunteer',
                'description' => 'Kegiatan sosial dan pengabdian masyarakat',
            ],
            [
                'name' => 'Competition',
                'description' => 'Kompetisi dan lomba di berbagai bidang',
            ],
        ];

        foreach ($eventTypes as $type) {
            EventType::create([
                'name' => $type['name'],
                'slug' => Str::slug($type['name']),
                'description' => $type['description'],
            ]);
        }
    }
}