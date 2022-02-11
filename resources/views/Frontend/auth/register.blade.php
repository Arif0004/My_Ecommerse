@extends('layouts.frontend_app')

@section('title','Register')

@section('app_content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center text-info">Register</h3>
                    <form action="{{ route('register') }}" class="mt-2" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for=""><b>Name : </b></label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for=""><b>Email : </b></label>
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for=""><b>Image : </b></label>
                            <input type="file" class="form-control" name="image" >
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for=""><b>Date of Birh : </b></label>
                            <input type="date" class="form-control" name="date_of_birth" placeholder="date_of_birth">
                            @error('date_of_birth')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for=""><b>Password : </b></label>
                            <input type="password" class="form-control" name="password" placeholder="password">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for=""><b>Confirm Password : </b></label>
                            <input type="password" class="form-control" name="password_confirmation"  placeholder="Confirm password">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block rounded">Register</button>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('login') }}" class=" btn-link">Login</a>
                            <a href="" class=" btn-link">Forgot Password?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
