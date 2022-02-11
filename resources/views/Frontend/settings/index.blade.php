@extends('layouts.frontend_master')
@section('title','Settings')

@section('frontend_master_content')
<div class="d-flex justify-content-between">
    <h4>Update your Informations</h4>
    <a href="{{ route('password') }}" class="btn btn-sm btn-info">Update Password</a>
</div>
<hr>
<form action="{{ route('settings') }}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{ auth('customer')->id() }}">
    <div class="row">
       <div class="col-md-4">
        <div class="form-group">
            <label for="">Name : </label>
            <input type="text" class="form-control" value="{{ auth('customer')->user()->name }}" name="name">
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
       </div>
       <div class="col-md-4">
        <div class="form-group">
            <label for="">Email : </label>
            <input type="text" class="form-control" value="{{ auth('customer')->user()->email }}" name="email" readonly >
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
       </div>
       <div class="col-md-4">
        <div class="form-group">
            <label for="">Date of Birth : </label>
            <input type="text" class="form-control" value="{{ auth('customer')->user()->date_of_birth ?  auth('customer')->user()->date_of_birth->format('Y-m-d') : '' }}" readonly> <br>
            <input type="date" class="form-control" value="" name="date_of_birth" >
            @error('date_of_birth')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
       </div>
       <div class="col-md-4">
        <div class="form-group">
            <label for="">Phone : </label>
            <input type="text" class="form-control" value="{{ auth('customer')->user()->phone }}" name="phone">
            @error('phone')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
       </div>
       <div class="col-md-4">
        <div class="form-group">
            <label for="">Region : </label>
            <input type="text" class="form-control" value="{{ auth('customer')->user()->region }}" name="region">
            @error('region')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
       </div>
       <div class="col-md-4">
        <div class="form-group">
            <label for="">City : </label>
            <input type="text" class="form-control" value="{{ auth('customer')->user()->city }}" name="city">
            @error('city')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
       </div>
       <div class="col-md-4">
        <div class="form-group">
            <label for="">Address : </label>
            <input type="text" class="form-control" value="{{ auth('customer')->user()->address }}" name="address">
            @error('address')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
       </div>
       <div class="col-md-12">
        <button class="btn btn-block btn-success btn-sm">Update Infomation</button>
       </div>
    </div>
</form>
@stop
