<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventSchedule;
use App\Models\Category;
use App\Models\EventType;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $organizers = User::where('role', 'organizer')->get();
        $techCategory = Category::where('slug', 'teknologi-it')->first();
        $businessCategory = Category::where('slug', 'kewirausahaan-bisnis')->first();
        
        $bootcampType = EventType::where('slug', 'bootcamp')->first();
        $workshopType = EventType::where('slug', 'workshop')->first();
        $webinarType = EventType::where('slug', 'webinar')->first();

        // Event 1: Web Development Bootcamp
        $event1 = Event::create([
            'user_id' => $organizers[0]->id,
            'category_id' => $techCategory->id,
            'event_type_id' => $bootcampType->id,
            'title' => 'Full Stack Web Development Bootcamp',
            'slug' => Str::slug('Full Stack Web Development Bootcamp'),
            'description' => 'Bootcamp intensif 3 bulan untuk belajar web development dari dasar hingga mahir. Materi meliputi HTML, CSS, JavaScript, PHP, Laravel, React, dan deployment.',
            'objectives' => 'Peserta dapat membuat aplikasi web full stack secara mandiri dan siap bekerja sebagai web developer',
            'requirements' => 'Laptop/PC, koneksi internet stabil, dasar logika pemrograman (opsional)',
            'price' => 2500000,
            'quota' => 30,
            'registered_count' => 12,
            'location' => 'Online via Zoom',
            'venue_type' => 'online',
            'status' => 'published',
            'start_date' => now()->addDays(14),
            'end_date' => now()->addDays(104),
            'registration_deadline' => now()->addDays(10),
            'instructor_info' => 'Tim instructor berpengalaman 5+ tahun di industri tech',
            'is_featured' => true,
            'certificate_available' => true,
            'points_reward' => 500,
        ]);

        // Add schedules for event 1
        EventSchedule::create([
            'event_id' => $event1->id,
            'title' => 'Opening & HTML/CSS Fundamentals',
            'description' => 'Perkenalan bootcamp dan pembelajaran dasar HTML/CSS',
            'start_time' => now()->addDays(14)->setTime(19, 0),
            'end_time' => now()->addDays(14)->setTime(21, 0),
            'location' => 'Online via Zoom',
        ]);

        EventSchedule::create([
            'event_id' => $event1->id,
            'title' => 'JavaScript & DOM Manipulation',
            'description' => 'Pembelajaran JavaScript dan manipulasi DOM',
            'start_time' => now()->addDays(21)->setTime(19, 0),
            'end_time' => now()->addDays(21)->setTime(21, 0),
            'location' => 'Online via Zoom',
        ]);

        // Event 2: UI/UX Workshop
        $event2 = Event::create([
            'user_id' => $organizers[0]->id,
            'category_id' => $techCategory->id,
            'event_type_id' => $workshopType->id,
            'title' => 'UI/UX Design Workshop for Beginners',
            'slug' => Str::slug('UI/UX Design Workshop for Beginners'),
            'description' => 'Workshop 2 hari untuk mempelajari dasar-dasar UI/UX design menggunakan Figma. Cocok untuk pemula yang ingin terjun ke dunia design.',
            'objectives' => 'Peserta dapat membuat design mockup aplikasi mobile dan website dengan Figma',
            'requirements' => 'Laptop/PC dengan Figma terinstall, tidak perlu background design',
            'price' => 150000,
            'quota' => 50,
            'registered_count' => 28,
            'location' => 'Jakarta Creative Hub, Jakarta Selatan',
            'venue_type' => 'offline',
            'status' => 'published',
            'start_date' => now()->addDays(7),
            'end_date' => now()->addDays(8),
            'registration_deadline' => now()->addDays(5),
            'instructor_info' => 'Senior UI/UX Designer dari startup unicorn',
            'is_featured' => true,
            'certificate_available' => true,
            'points_reward' => 100,
        ]);

        // Event 3: Entrepreneur Webinar (Free)
        $event3 = Event::create([
            'user_id' => $organizers[1]->id,
            'category_id' => $businessCategory->id,
            'event_type_id' => $webinarType->id,
            'title' => 'From Zero to Hero: Membangun Startup dari Nol',
            'slug' => Str::slug('From Zero to Hero: Membangun Startup dari Nol'),
            'description' => 'Webinar gratis bersama founder startup sukses yang akan berbagi pengalaman membangun startup dari nol hingga mendapat funding.',
            'objectives' => 'Memberikan insight dan motivasi bagi calon entrepreneur',
            'requirements' => 'Koneksi internet dan antusiasme untuk belajar!',
            'price' => 0,
            'quota' => 500,
            'registered_count' => 156,
            'location' => 'Online via Google Meet',
            'venue_type' => 'online',
            'status' => 'published',
            'start_date' => now()->addDays(3),
            'end_date' => now()->addDays(3),
            'registration_deadline' => now()->addDays(2),
            'instructor_info' => 'CEO & Founder dari 3 startup teknologi',
            'is_featured' => false,
            'certificate_available' => true,
            'points_reward' => 50,
        ]);

        // Event 4: Digital Marketing Course
        Event::create([
            'user_id' => $organizers[1]->id,
            'category_id' => $businessCategory->id,
            'event_type_id' => EventType::where('slug', 'course')->first()->id,
            'title' => 'Digital Marketing Mastery Course',
            'slug' => Str::slug('Digital Marketing Mastery Course'),
            'description' => 'Course 6 minggu untuk menguasai digital marketing: SEO, SEM, Social Media Marketing, Email Marketing, dan Analytics.',
            'objectives' => 'Peserta dapat merancang dan menjalankan campaign digital marketing yang efektif',
            'requirements' => 'Laptop/PC, akses internet, akun social media untuk praktek',
            'price' => 750000,
            'quota' => 40,
            'registered_count' => 0,
            'location' => 'Hybrid (Online & Offline)',
            'venue_type' => 'hybrid',
            'status' => 'published',
            'start_date' => now()->addDays(30),
            'end_date' => now()->addDays(72),
            'registration_deadline' => now()->addDays(25),
            'instructor_info' => 'Digital Marketing Strategist dengan 8+ tahun pengalaman',
            'is_featured' => false,
            'certificate_available' => true,
            'points_reward' => 300,
        ]);

        // Event 5: Draft Event (not published yet)
        Event::create([
            'user_id' => $organizers[0]->id,
            'category_id' => $techCategory->id,
            'event_type_id' => $bootcampType->id,
            'title' => 'Mobile App Development with Flutter',
            'slug' => Str::slug('Mobile App Development with Flutter'),
            'description' => 'Bootcamp pengembangan aplikasi mobile menggunakan Flutter untuk iOS dan Android.',
            'objectives' => 'Peserta dapat membuat aplikasi mobile cross-platform',
            'requirements' => 'Dasar pemrograman, laptop dengan spesifikasi memadai',
            'price' => 3000000,
            'quota' => 25,
            'registered_count' => 0,
            'location' => 'Bandung Tech Park',
            'venue_type' => 'offline',
            'status' => 'draft',
            'start_date' => now()->addDays(60),
            'end_date' => now()->addDays(150),
            'registration_deadline' => now()->addDays(50),
            'instructor_info' => 'TBA',
            'is_featured' => false,
            'certificate_available' => true,
            'points_reward' => 600,
        ]);
    }
}