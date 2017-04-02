<?php
declare(strict_types=1);

namespace App\Console\Commands\Check;

use App\Http\Controllers\Check\MissingNotesController;
use Illuminate\Console\Command;

class MissingNotesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    static protected $signature = 'b:check:missing_notes';

    /**
     * The console command description.
     *
     * @var string
     */
    static protected $description = 'Check for empty notes of todays daily time entries.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $missingnotes = new MissingNotesController();
        $missingnotes->run();

        return true;
    }
}
