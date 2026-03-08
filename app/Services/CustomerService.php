<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class CustomerService
{
    /**
     * Create a new class instance.
     */
    public function create(array $data): Customer
    {
        return DB::transaction(function () use ($data) {
            $data = $this->normalize($data);

            return Customer::create($data);
        });
    }

    public function update(Customer $customer, array $data): Customer
    {
        return DB::transaction(function () use ($customer, $data) {
            $data = $this->normalize($data);
            $customer->update($data);
            return $customer->refresh();
        });
    }

    private function normalize(array $data): array
    {
        $data['name'] = trim($data['name']);
        $data['email'] = strtolower(trim($data['email']));
        $data['address'] = trim($data['address']);

        $data['phone'] = preg_replace('/\D/', '', (string) $data['phone']);

        $data['status'] = (bool) $data['status'];

        return $data;
    }
}
