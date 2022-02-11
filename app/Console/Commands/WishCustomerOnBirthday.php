<?php

namespace App\Console\Commands;

use App\Models\Customer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerBirthdayWishMail;
use Exception;
use Vonage\SMS\Client;

class WishCustomerOnBirthday extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wish:birthday';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command send an email to customers on their birthday.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        # Send SMS to customers
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

        # Send email to customers
        // $customers =  Customer::whereMonth('date_of_birth', today()->format('m'))
        //     ->whereDay('date_of_birth', today()->format('d'))
        //     ->get(['name', 'email', 'id']);

        // foreach ($customers as $customer) {
        //     Mail::to($customer->email)->send(new CustomerBirthdayWishMail($customer));
        // }
    }
}
