<?php

namespace App\Repositories;

use App\DTOs\CustomerDTO;
use App\Repositories\Contracts\CustomerRepositoryInterface;
use App\Traits\PaginatesQuery;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class CustomerRepository implements CustomerRepositoryInterface
{
    use PaginatesQuery;

    public function getAllPaginated(int $perPage): LengthAwarePaginator
    {
        $query = <<<Sql
            select * from customers
        Sql;
        return $this->paginateRawQuery($query, $perPage);
    }

    public function store(CustomerDTO $customer): mixed
    {
        $query = <<<Sql
            INSERT INTO customers (name, email, city) VALUES (?, ?, ?)
        Sql;

        DB::insert($query, [$customer->name, $customer->email, $customer->city]);

        return DB::selectOne(
            "SELECT * FROM customers WHERE email = ? ORDER BY id DESC LIMIT 1",
            [$customer->email]
        );
    }

    public function update(int $id, CustomerDTO $customer): object
    {
        $query = <<<Sql
            UPDATE customers 
            SET name = ?, city = ? 
            WHERE id = ?
        Sql;

        DB::update($query, [$customer->name, $customer->city, $id]);

        return DB::selectOne(
            "SELECT * FROM customers WHERE id = ? LIMIT 1",
            [$id]
        );
    }
}
