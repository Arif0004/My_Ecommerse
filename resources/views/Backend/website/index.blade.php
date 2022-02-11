
@extends('layouts.backend_master')
@section('title', 'Website Details')
@section('master_content')
<form action="{{ route('admin.website.update', $website->id) }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
<div class="card pt-2">
    <div class="card-header ">
        <div class="d-flex justify-content-between">
        <h4 class="card-title">Website Details</h4>
        <button class="btn btn-success btn-sm"><i class="fa fa-edit"></i> Update Website Information</button>

        </div>
    </div>
        <div class="card-body">
            <table class="table table-hover table-bordered" id="postTable">
                <tr>
                    <th>Title :</th>
                    <td>{{ $website->title }}</td>
                </tr>
                <tr>
                    <th>logo :</th>
                    <td><img width="100px" src="{{ asset($website->logo) }}" alt=""></td>
                    <td> <input type="file" name="logo" class="form-control"></td>
                </tr>
                <tr>
                    <th>Address :</th>
                    <td>{{ $website->address }}</td>
                    <td><input type="text" class="form-control" name="address" value="{{   $website->address }}"></td>
                </tr>
                <tr>
                    <th>Email :</th>
                    <td>{{ $website->email }}</td>
                    <td><input type="text" class="form-control" name="email" value="{{   $website->email }}"></td>
                </tr>
                <tr>
                    <th>Phone :</th>
                    <td>{{ $website->phone }}</td>
                    <td><input type="text" class="form-control" name="phone" value="{{   $website->phone }}"></td>
                </tr>
                <tr>
                    <th>Facebook :</th>
                    <td>{{ $website->fb }}</td>
                    <td><input type="text" class="form-control" name="fb" value="{{$website->fb }}"></td>
                </tr>
                <tr>
                    <th>Twitter :</th>
                    <td>{{ $website->tw }}</td>
                    <td><input type="text" class="form-control" name="tw" value="{{$website->tw }}"></td>
                </tr>
                <tr>
                    <th>Instagram :</th>
                    <td>{{ $website->ins }}</td>
                    <td><input type="text" class="form-control" name="ins" value="{{$website->ins }}"></td>
                </tr>
                <tr>
                    <th>Linkedin :</th>
                    <td>{{ $website->link }}</td>
                    <td><input type="text" class="form-control" name="link" value="{{$website->link }}"></td>
                </tr>
                <tr>
                    <th>Fists Footer :</th>
                    <td>{{ $website->footer_1 }}</td>
                    <td>
                        <textarea class="form-control" name="footer_1" id="" cols="10" rows="5">
                            {{ $website->footer_1 }}
                        </textarea>
                    </td>
                </tr>
                <tr>
                    <th>Second Footer :</th>
                    <td>{{ $website->footer_2 }}</td>
                    <td>
                        <textarea class="form-control" name="footer_2" id="" cols="10" rows="5">
                            {{ $website->footer_2 }}
                        </textarea>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</form>

@endsection

