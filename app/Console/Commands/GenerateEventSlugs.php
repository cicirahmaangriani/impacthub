<?php

namespace App\Console\Commands;

use App\Models\Event;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GenerateEventSlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'events:generate-slugs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate slugs for events that don\'t have one';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $eventsWithoutSlug = Event::whereNull('slug')->orWhere('slug', '')->get();
        
        $count = $eventsWithoutSlug->count();
        
        if ($count === 0) {
            $this->info('All events already have slugs!');
            return 0;
        }
        
        $this->info("Found {$count} events without slugs. Generating...");
        
        $bar = $this->output->createProgressBar($count);
        $bar->start();
        
        foreach ($eventsWithoutSlug as $event) {
            $slug = Str::slug($event->title) . '-' . Str::random(6);
            $event->slug = $slug;
            $event->save();
            
            $bar->advance();
        }
        
        $bar->finish();
        $this->newLine();
        $this->info("Successfully generated slugs for {$count} events!");
        
        return 0;
    }
}
