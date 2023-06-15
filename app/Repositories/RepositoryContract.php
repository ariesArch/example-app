<?php

namespace App\Repositories;

/**
 * Interface RepositoryContract.
 */
interface RepositoryContract
{
    public function all(array $columns = ['*']);
}
