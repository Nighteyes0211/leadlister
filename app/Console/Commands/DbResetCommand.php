<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DbResetCommand extends Command
{

    /**
     * Paths
     *
     * @var array
     */
    protected $paths = [
        'uploads',
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Drop table, run migration, & seed db.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        // Delete storage files
        foreach ($this->paths as $path) {

            File::cleanDirectory('storage/app/public/' . $path);
            File::cleanDirectory('public/storage/' . $path);
            File::cleanDirectory('public/' . $path);
        }


        Artisan::call('db:wipe');
        Artisan::call('migrate');
        Artisan::call('db:seed');

        return Command::SUCCESS;
    }
}
