<?php

namespace App\Console\Commands;

use App\Models\Facilty;
use Illuminate\Console\Command;

class DeleteFacilityWithNonStatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:facility';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes facilites that don\'t hanve status';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Facilty::available()->doesntHave('statuses')->softDelete();
    }
}
