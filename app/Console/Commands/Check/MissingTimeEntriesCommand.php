<?php declare(strict_types=1);

namespace App\Console\Commands\Check;

use App\Http\Controllers\Check\MissingTimeEntriesController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class MissingTimeEntriesCommand extends Command
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
    protected $description = 'Check every existing harvest user for missing timeentries today.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        Log::notice('CHECK > MISSING TIMEENTRIES - START');

        $missingte = new MissingTimeEntriesController();
        $result = $missingte->run();

        Log::notice('CHECK > MISSING TIMEENTRIES - END, result:');
        Log::notice(
            'count => ' . $result['count'] .
            ' failures => ' . $result['failures']
        );
    }
}
