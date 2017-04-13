<?php declare(strict_types=1);

namespace App\Http\Controllers\Check;

/**
 * Interface CheckInterface
 * @package App\Http\Controllers\Check
 */
interface CheckInterface
{
    /**
     * Check for existing entries.
     * @param array $entries
     * @return bool
     */
    public function entriesExist(array $entries) : bool;
}
