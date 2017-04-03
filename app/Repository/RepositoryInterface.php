<?php
declare(strict_types=1);

namespace App\Repository;

interface RepositoryInterface
{
    /**
     * Return string to get all items from api
     * @return string
     */
    public function getAll();

    /**
     * Return string to get single item from api
     * @param $id
     * @return string
     */
    public function getSingle($id);
}
