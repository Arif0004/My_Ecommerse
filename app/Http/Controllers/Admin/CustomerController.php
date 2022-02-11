<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    function singleCustomer(Customer $customer)
    {
        return view('Backend.customer.single', [
            'customer' => $customer->load(['orders']),
            'navItem' => 'customer'
        ]);
    }
}
