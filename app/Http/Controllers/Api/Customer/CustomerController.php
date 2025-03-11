<?php

namespace App\Http\Controllers\Api\Customer;

use App\DTOs\CustomerDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customers\StoreCustomerRequest;
use App\Http\Requests\Customers\UpdateCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Repositories\Contracts\CustomerRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    protected CustomerRepositoryInterface $customerRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        $perPage = $request->get('per_page', 15);
        $customers = $this->customerRepository->getAllPaginated($perPage);

        return CustomerResource::collection($customers);
    }

    public function store(StoreCustomerRequest $request): CustomerResource
    {
        $input = $request->validated();
        $customerDTO = CustomerDTO::fromRequest($input);
        $customer = $this->customerRepository->store($customerDTO);

        return CustomerResource::make($customer);
    }

    public function update(int $id, UpdateCustomerRequest $request): CustomerResource
    {
        $input = $request->validated();
        $customerDTO = CustomerDTO::fromRequest($input);
        $updatedCustomer = $this->customerRepository->update($id, $customerDTO);

        return CustomerResource::make($updatedCustomer);
    }

    public function destroy(Customer $customer): void
    {
        $customer->delete();
    }
}
