<?php

namespace App\Mail;

use App\Actions\File;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Queue\ShouldQueue;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class CustomerOrderMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $order;
    public $customer;
    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->customer = auth('customer')->user();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('mail.test')->attach(Storage::url($this->pdfFile));
        return $this->subject('Order Mail')->view('mail.customer_order_mail');
    }
}
