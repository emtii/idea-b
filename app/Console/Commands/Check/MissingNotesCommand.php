<?php declare(strict_types=1);

namespace App\Console\Commands\Check;

use App\Http\Controllers\Check\MissingNotesController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class MissingNotesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'b:check:missing_notes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for empty notes of todays daily time entries.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        Log::notice('CHECK > MISSING NOTES - START');

        $missingnotes = new MissingNotesController();
        $result = $missingnotes->run();

        Log::notice('CHECK > MISSING NOTES - END, result:');
        Log::notice(
            'count => ' . $result['count'] .
            'failures => ' . $result['failures']
        );
    }
}
