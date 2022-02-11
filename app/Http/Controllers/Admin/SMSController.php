<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Exception;
use Vonage\SMS\Client;
use Illuminate\Http\Request;

class SMSController extends Controller
{
    public function index()
    {
        $customers =  Customer::hasPhoneNumber()->get(['name', 'phone']);
        foreach ($customers as $customer) {
            $client = $customer->name;
            $phone_number = strlen($customer->phone) == 11 ? "+88{$customer->phone}" : $customer->phone;
            $url = config('app.url');
            $app_name = config('app.name');
            $text = "Happy birthday to a very cherished client ({$client}). May you live a trouble-free and perfectly happy life. Visit our site [{$url}]";
            $basic  = new \Vonage\Client\Credentials\Basic("9d68629f", "GBVfpt6FHrIod89Y");
            $client = new \Vonage\Client($basic);
            $response = $client->sms()->send(
                new \Vonage\SMS\Message\SMS($phone_number, $app_name, $text)
            );

            $message = $response->current();

            if ($message->getStatus() == 0) {
                echo "The message was sent successfully\n";
            } else {
                echo "The message failed with status: " . $message->getStatus() . "\n";
            }
        }
    }
}
