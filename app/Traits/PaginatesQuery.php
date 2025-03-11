<?php

namespace App\Traits;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

trait PaginatesQuery
{
    public function paginateRawQuery(string $query, int $perPage): LengthAwarePaginator
    {
        $page = Paginator::resolveCurrentPage();
        $total = count(DB::select($query)); // Obtém o total de registros
        $items = collect(DB::select($query . " LIMIT " . $perPage . " OFFSET " . (($page - 1) * $perPage)));

        return new LengthAwarePaginator(
            $items,
            $total,
            $perPage,
            $page,
            ['path' => Paginator::resolveCurrentPath()]
        );
    }
}
