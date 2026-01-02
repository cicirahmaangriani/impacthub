<?php
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$eventsWithoutSlug = \App\Models\Event::whereNull('slug')->orWhere('slug', '')->get();

echo "Events without slug: " . $eventsWithoutSlug->count() . PHP_EOL;

foreach($eventsWithoutSlug as $event) {
    echo "ID: {$event->id}, Title: {$event->title}, Slug: " . ($event->slug ?? 'NULL') . PHP_EOL;
}
