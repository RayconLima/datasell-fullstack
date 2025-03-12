<?php

namespace Tests\Feature;

use App\Repositories\Contracts\CustomerRepositoryInterface;
use App\DTOs\CustomerDTO;
use App\Models\Customer;
use Tests\TestCase;

class CustomerRepositoryTest extends TestCase
{

    protected CustomerRepositoryInterface $customerRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->customerRepository = $this->app->make(CustomerRepositoryInterface::class);
    }
    
    /** @test */
    public function it_can_create_a_customer()
    {
        $customerDTO = new CustomerDTO(
            name: 'John Doe',
            email: 'johndoe@example.com',
            city: 'New York'
        );

        $customer = $this->customerRepository->store($customerDTO);

        $this->assertDatabaseHas('customers', [
            'name'  => 'John Doe',
            'email' => 'johndoe@example.com',
            'city'  => 'New York',
        ]);

        $this->assertInstanceOf(Customer::class, $customer);
    }

    /** @test */
    public function it_can_retrieve_paginated_customers()
    {
        Customer::factory()->count(20)->create();

        $paginatedCustomers = $this->customerRepository->getAllPaginated(15);

        $this->assertEquals(15, $paginatedCustomers->count());
    }
}
