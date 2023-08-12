<?php

namespace App\Http\Service\Grid\Data;

use Illuminate\Pagination\LengthAwarePaginator;

class Pagination
{

    protected LengthAwarePaginator $query;

    public function getQuery(): LengthAwarePaginator
    {
        return $this->query;
    }

    public function setQuery(LengthAwarePaginator $query): void
    {
        $this->query = $query;
    }

}
