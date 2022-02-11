@extends('layouts.frontend_master')
@section('title','Message')

@section('frontend_master_content')

<div class="message_wrapper" style="height: 70vh;overflow-y:scroll ">
@if ($message->message)
<div class="contai" style="background: teal">
    <img src="https://media.istockphoto.com/vectors/profile-placeholder-image-gray-silhouette-no-photo-vector-id1016744034?k=20&m=1016744034&s=612x612&w=0&h=kjCAwH5GOC3n3YRTHBaLDsLIuF8P3kkAJc9RvfiYWBY=" alt="Avatar" style="width:100%;">
    <p style="color: #fff">{{ $message->message->message}}</p>
    <span class="time-right">{{ $message->message->created_at->format('D-M-Y (h:i:s a)') }}</span>
</div>
@forelse ($message->message->replies as $reply)
@if ($reply->mode == 'customer')
<div class="contai">
    <img src="https://media.istockphoto.com/vectors/profile-placeholder-image-gray-silhouette-no-photo-vector-id1016744034?k=20&m=1016744034&s=612x612&w=0&h=kjCAwH5GOC3n3YRTHBaLDsLIuF8P3kkAJc9RvfiYWBY=" alt="Avatar" style="width:100%;">
    <p>{{ $reply->reply }}</p>
    <span class="time-right">{{ $reply->created_at->format('D-M-Y (h:i:s a)') }}</span>
</div>
@else
<div class="contai darker">
    <img src="https://media.istockphoto.com/vectors/profile-placeholder-image-gray-silhouette-no-photo-vector-id1016744034?k=20&m=1016744034&s=612x612&w=0&h=kjCAwH5GOC3n3YRTHBaLDsLIuF8P3kkAJc9RvfiYWBY=" alt="Avatar" class="right" style="width:100%;">
    <p>{{ $reply->reply }}</p>
    <span class="time-right">{{ $reply->created_at->format('D-M-Y (h:i:s a)') }}</span>
</div>
@endif

@empty

@endforelse
<div class="mt-3">
    <form action="{{ route('reply',$message->message->id) }}" method="POST">
        @csrf
        <textarea name="reply" id="" cols="30" rows="5" class="form-control">

        </textarea>

        <button class="btn btn-success btn-sm mt-3"> Reply </button>
    </form>
</div>
@else
<p>Do you have any Query? Feel free to contact with us <i class="fa fa-smile text-success"></i></p>
<div class="mt-3">
    <form action="{{ route('message') }}" method="POST">
        @csrf
        <textarea name="message" id="" cols="30" rows="5" class="form-control">

        </textarea>

        <button class="btn btn-success btn-sm mt-3">Send </button>
    </form>
</div>

</div>
@endif



@stop

@push('css')
<style>
.contai {
    border: 2px solid #dedede;
    background-color: #f1f1f1;
    border-radius: 5px;
    padding: 10px;
    margin: 10px 0;
  }

  .darker {
    border-color: #ccc;
    background-color: #ddd;
  }

  .contai::after {
    content: "";
    clear: both;
    display: table;
  }

  .contai img {
    float: left;
    max-width: 60px;
    width: 100%;
    margin-right: 20px;
    border-radius: 50%;
  }

  .contai img.right {
    float: right;
    margin-left: 20px;
    margin-right:0;
  }

  .time-right {
    float: right;
    color: #aaa;
  }

  .time-left {
    float: left;
    color: #999;
  }
  </style>
@endpush
