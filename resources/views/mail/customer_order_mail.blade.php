<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Document</title>
      <style>
         .row{
         float: left;
         width: 100%
         }
         .col-50{
         width: 48%;
         float: left;
         }
         .text-right{
         text-align: right;
         }
         .text-left{
         text-align: left;
         }
         .text-center{
         text-align: center;
         }
         table{
         border: 1px solid teal;
         width: 100%;
         }
         th,td{
         padding: 5px;
         }
         th{
         text-align: left
         }
         .signture{
             display: inline-block;
             padding-top: 10px;
             border-top: 1px solid #000;
         }
         .col-70{
             width: 68%;
             float: left;
         }
         .col-30{
             width: 29%;
             float: left;
         }
         .col-40{
             width: 39%;
             float: left;
         }
         .m-auto{
             margin: 0 auto;
         }
         body{
             font-family: Arial, Helvetica, sans-serif
         }
      </style>
   </head>
   <body>
       <p>Dear {{ $customer->name }}, Thanks for Order.</p>
       <div class="row" style="margin-bottom: 30px">
           <div class="col-40">
                <span><b>AR Shop</b></span> <br>
                <span>Address : Mohakhali,Dhaka</span> <br>
                <span>Phone : +8801754100439</span> <br>
                <span>Date : {{ now()->format('Y-m-d h:i:s a') }}</span> <br>
           </div>
            <div class="col-30 text-center">
                <h2 class="text-left">Invoice Details</h2>
            </div>
            <div class="col-30">

            </div>
       </div>
      <table border="1">
         <tr>
            <th>Order ID</th>
            <td>{{ $order->unique_id }}</td>
            <th>Date</th>
            <td>{{ $order->created_at->format('Y-m-d') }}</td>
         </tr>
         <tr>
            <th>Status</th>
            <td>Pending</td>
            <th>Payment Method</th>
            <td>{{ $order->payment->method }}</td>
         </tr>
         <tr>
            @if ($order->payment->method === 'bksh')
            <th>Transction ID</th>
            <td>{{ $order->payment->trans_id }}</td>
            @endif
            @if ($order->payment->coupon)
            <th>Coupon</th>
            <td>{{ $order->payment->coupon }}</td>
            <th>Discount</th>
            <td>{{ $order->payment->discount }}%</td>
            @endif
         </tr>
         <tr>
            <th>Total Amount</th>
            <td>${{ $order->payment->total_amnt }}</td>
            <th>Amount</th>
            <td>${{ $order->payment->amount }}</td>
         </tr>
         <tr>
            <th colspan="4" class="text-center">
               <h6 class="text-center">Customer Details</h6>
            </th>
         </tr>
         <tr>
            <th>Name</th>
            <td>{{ $order->customer->name }}</td>
            <th>Email</th>
            <td>{{ $order->customer->email }}</td>
         </tr>
         <tr>
            <th>Phone</th>
            <td>{{ $order->customer->phone }}</td>
            <th>Region</th>
            <td>{{ $order->customer->region }}</td>
         </tr>
         <tr>
            <th>City</th>
            <td>{{ $order->customer->city }}</td>
            <th>Address</th>
            <td>{{ $order->customer->address }}</td>
         </tr>
         <tr>
            <th colspan="4" class="text-center">
               <h6 class="text-center">Shipping Address</h6>
            </th>
         </tr>
         <tr>
            <th>Name</th>
            <td>{{ $order->shipping->name }}</td>
            <th>Email</th>
            <td>{{ $order->shipping->email }}</td>
         </tr>
         <tr>
            <th>Phone</th>
            <td>{{ $order->shipping->phone }}</td>
            <th>Region</th>
            <td>{{ $order->shipping->region }}</td>
         </tr>
         <tr>
            <th>City</th>
            <td>{{ $order->shipping->city }}</td>
            <th>Address</th>
            <td>{{ $order->shipping->address }}</td>
         </tr>
         <tr>
            <th>Remark</th>
            <td colspan="3">{{ $order->shipping->remark }}</td>
         </tr>
         <tr>
            <th colspan="4" class="text-center">
               <h6 class="text-center">Products</h6>
            </th>
         </tr>
      </table>
      <table border="1">
         <tr>
            <th>SL</th>
            <th>Name</th>
            <th>Price</th>
            <th >Quantity</th>
            <th>Total</th>
         </tr>
         @php
         $total = 0;
         $quantity = 0;
         @endphp
         @foreach ($order->products as $product)
         <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $product->product->name }}</td>
            <td>$ {{ $product->product->info->sell_price }}</td>
            <td>{{ $product->quantity }}</td>
            <td>$ {{ $product->quantity * $product->product->info->sell_price  }}</td>
         </tr>
         @php
         $total  += $product->quantity * $product->product->info->sell_price;
         $quantity += $product->quantity;
         $discount = calculateDiscount($total,$order->payment->discount);
         $shipping = $quantity * 10;
         @endphp
         @endforeach
         </tr>
         <tr>
            <th colspan="3"></th>
            <th>Total</th>
            <td>$ {{ $total }}</td>
         </tr>
         <tr>
            <th colspan="3"></th>
            <th>Discount</th>
            <td>- $ {{$discount }}</th>
         </tr>
         <tr>
            <th colspan="3"></th>
            <th>Shipping</th>
            <td>$ {{$shipping }}</th>
         </tr>
         <tr>
            <th colspan="3"></th>
            <th>Grand Total</th>
            <td>$ {{ ($total - $discount) + $shipping}}</td>
         </tr>
      </table>
      <div class="row" style="margin-top:35px">
          <div class="col-50 text-left">
              <span class="signture">Customer Signture</span>
          </div>
          {{-- <div class="col-50 text-right">
              <span>{{ auth('admin')->user()->name }}</span> <br>
            <span class="signture">Admin Signture</span>
            <br><br>
            <span class="signture">Delivery Signture</span>
          </div> --}}
      </div>
   </body>
</html>
