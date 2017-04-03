<?php
declare(strict_types=1);

namespace App\Console\Commands\Check;

use App\Http\Controllers\Check\MissingNotesController;
use App\Http\Controllers\Check\MissingTimeEntriesController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class MissingTimeEntries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'b:check:missing_timeentries';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for less than 4 hours booked today.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Log::info('CHECK > MISSING TIME ENTRIES - START');

        $missingts = new MissingTimeEntriesController();
        $missingts->run();

        Log::info('CHECK > MISSING TIME ENTRIES - END');

        return true;
    }
}
