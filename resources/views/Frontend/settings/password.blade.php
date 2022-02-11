@extends('layouts.frontend_master')
@section('title','Settings')

@section('frontend_master_content')
<div class="d-flex justify-content-between">
    <h4>Update your Password</h4>
    <a href="{{ route('settings') }}" class="btn btn-sm btn-info">Update Information</a>
</div>
<hr>
<form action="{{ route('password') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="">Old Password : </label>
                <input type="password" class="form-control" name="old_pass" placeholder="Old Password">
                @error('old_pass')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="">New Password : </label>
                <input type="password" class="form-control" name="password" placeholder="New Password">
                @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="">Confirm Password : </label>
                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                @error('password_confirmation')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            </div>
        </div>
        <div class="col-md-12">
            <button class="btn btn-block btn-success btn-sm">Update Password</button>
        </div>
    </div>
</form>
@stop
