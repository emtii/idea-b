<?php declare(strict_types=1);

namespace App\Http\Controllers\Check;

use App\Http\Controllers\Controller;

/**
 * Class CheckController
 * @package App\Http\Controllers\Check
 */
class CheckBaseController extends Controller implements CheckInterface
{
    /**
     * @inheritdoc
     */
    public function entriesExist(array $entries) : bool
    {
        return is_array($entries) && !empty($entries);
    }
}
