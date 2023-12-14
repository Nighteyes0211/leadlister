<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class CustomMakeLivewireCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:clivewire {view} {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a livewire component';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {


        $component = "users." . $this->argument('user') . "." . $this->argument('view');
        Artisan::call("make:livewire {$component}");

        $this->info("Component: " . $component);

    }
}
