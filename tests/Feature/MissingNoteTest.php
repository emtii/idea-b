<?php declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;
use App\Http\Controllers\Check\MissingNotesController;

class MissingNoteTest extends TestCase
{
    /**
     * Test main method run() has key count.
     * @return bool
     */
    public function testRunHasKeyCount()
    {
        $mn = new MissingNotesController();

        $this->assertArrayHasKey(
            'count',
            $mn->run()
        );
    }

    /**
     * Test main method run() has key failures.
     * @return bool
     */
    public function testRunHasKeyFailures()
    {
        $mn = new MissingNotesController();

        $this->assertArrayHasKey(
            'failures',
            $mn->run()
        );
    }
}
