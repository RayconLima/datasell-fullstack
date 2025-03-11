<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\DTOs\CustomerDTO;

interface CustomerRepositoryInterface
{
    public function getAllPaginated(int $perPage): LengthAwarePaginator;
    public function store(CustomerDTO $dto): mixed;
    public function update(int $id, CustomerDTO $dto): mixed;
}
