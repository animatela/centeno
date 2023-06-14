<?php

namespace Idat\Centeno\Workshop\Repositories;

use App\Models\Workshop\Customer;
use Idat\Centeno\Workshop\Commands\Customers\CreateNewCustomer;
use Idat\Centeno\Workshop\Commands\Customers\DeleteCustomer;
use Idat\Centeno\Workshop\Commands\Customers\DestroyCustomer;
use Idat\Centeno\Workshop\Commands\Customers\FindCustomer;
use Idat\Centeno\Workshop\Commands\Customers\FindCustomerByUserId;
use Idat\Centeno\Workshop\Commands\Customers\UpdateCustomer;
use Idat\Centeno\Workshop\Objects\Customers\ExistingCustomer;
use Idat\Centeno\Workshop\Objects\Customers\NewCustomer;
use Illuminate\Database\Eloquent\Model;

final class CustomerService
{
    public function __construct(
        private readonly CreateNewCustomer $createNewCustomer,
        private readonly FindCustomer $findCustomer,
        private readonly FindCustomerByUserId $findCustomerByUserId,
        private readonly UpdateCustomer $updateCustomer,
        private readonly DeleteCustomer $deleteCustomer,
        private readonly DestroyCustomer $destroyCustomer,
    ) {}

    public function new(array $payload): NewCustomer
    {
        return NewCustomer::from($payload);
    }

    public function create(array $payload): Model|Customer
    {
        return $this->createNewCustomer->handle(
            NewCustomer::from($payload),
        );
    }

    public function find(int $id): Model|Customer
    {
        return $this->findCustomer->handle($id);
    }

    public function findByUserId(int $userId): Model|Customer|null
    {
        return $this->findCustomerByUserId->handle($userId);
    }

    public function update(string $id, array $payload): int
    {
        return $this->updateCustomer->handle(
            $id,
            ExistingCustomer::from($payload),
        );
    }

    public function delete(int $id): int
    {
        return $this->deleteCustomer->handle(
            $id
        );
    }

    public function forceDelete(int $id): int
    {
        return $this->destroyCustomer->handle(
            $id
        );
    }
}
