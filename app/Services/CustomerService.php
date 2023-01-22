<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class CustomerService
{

    /**
     * find or create a new customer
     *
     * @param $customer_phone
     * @param string $customer_name
     * @param $customer_email
     * @return User|Model
     */
    public function findOrCreate($customer_phone, string $customer_name = "", $customer_email = null)
    {
        return User::firstOrCreate(['phone' => $customer_phone, 'type' => 'customer'], [
            'phone' => $customer_phone,
            'type' => "customer",
            'name' => $customer_name,
            'email' => $customer_email
        ]);
    }
}
