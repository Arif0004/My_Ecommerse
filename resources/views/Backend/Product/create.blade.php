
@extends('layouts.backend_master')
@section('title', 'Product Create')
@push('css')
<link rel="stylesheet" href="{{ asset('Backend') }}/plugins/summernote/summernote-bs4.min.css">
@endpush
@section('master_content')
<div class="card">
    <div class="card-header ">
        <div class="d-flex justify-content-between">
        <h4 class="card-title">Add New Product</h4>
        <a href="{{ route('admin.product.index') }}" class="btn btn-success btn-sm"><i class="fa fa-angle-left"></i> Back</a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data" id="form">
            @csrf
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="">product Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter product Name" id="name" >
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <span id="customMessage"></span>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="">Category </label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">Select A Category</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="">Sub Category </label>
                      <select name="sub_cat_id" id="sub_cat_id" class="form-control">
                          <option value="">Select A SubCategory</option>

                      </select>
                        @error('sub_cat_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="form-group">
                        <label for="">Color </label>
                        <select name="color_id" id="color_id" class="form-control">
                            <option value="">Select A Color</option>
                            @foreach ($colors as $color)
                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                            @endforeach
                        </select>
                        @error('color_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="form-group">
                        <label for="">Size </label>
                        <select name="size_id" id="size_id" class="form-control">
                            <option value="">Select A Size</option>
                            @foreach ($sizes as $size)
                            <option value="{{ $size->id }}">{{ $size->name }}</option>
                            @endforeach
                        </select>
                        @error('size_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-gorup">
                        <label for="">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-gorup">
                        <label for="">Image</label>
                        <input type="file" name="slider_images[]" id="image" class="form-control" multiple>
                        @error('slider_images')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-gorup">
                        <label for="">Short Description</label>
                        <textarea name="short_des" id="short_des" class="form-control" cols="30" rows="10" placeholder="Enter a short descripton in your psot"></textarea>
                        @error('short_des')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-gorup">
                        <label for="">Long Description</label>
                        <textarea name="long_des" id="long_des" class="form-control" cols="30" rows="10" placeholder="Enter a short descripton in your psot"></textarea>
                        @error('long_des')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-gorup">
                        <label for="">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" placeholder="quantity">
                        @error('quantity')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                   </div>
               <div class="col-md-2">
                <div class="form-gorup">
                    <label for="">Price</label>
                    <input type="text" name="price" id="price" class="form-control" placeholder="Price">
                    @error('price')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
               </div>
               <div class="col-md-2">
                <div class="form-gorup">
                    <label for="">Sell Price</label>
                    <input type="text" name="sell_price" id="sell_price" class="form-control" placeholder="Sell Price">
                    @error('sell_price')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
               </div>
               <div class="col-md-2 align-self-center">
                <div class="form-gorup">
                    <label for="">Featured</label>
                    <input type="checkbox" name="is_featured" id="is_featured" class="">
                </div>
               </div>
            </div>

            <div class="form-gorup">
                <button type="submit" class="form-control btn btn-success btn-block mt-5">Create product</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('script')
<script src="{{ asset('Backend') }}/plugins/summernote/summernote-bs4.min.js"></script>

    <script>
        $('#short_des').summernote();
        $('#long_des').summernote();
        // dependency select

        let category = $$('#category_id');

        category.addEventListener('change',async (e)=>{
            let id = e.currentTarget.value;
            let url = `${base_url}/admin/get-sub-category-by-category/${id}`;
            if(id){
                try{
                    const {data} = await axios.get(url);
                    let html = '';
                    html += '<option value="">Select A Sub Category</option>'
                    data.forEach(element => {
                        html += "<option value="+element.id+">"+ element.name +"</option>"
                    });
                    $$('#sub_cat_id').innerHTML = html
                }catch(err){
                    log(err)
                }
            }else{
                $$('#sub_cat_id').innerHTML = '<option value="">Select A Sub Category</option>'
            }
        })

        // check product exist or not
        // let product = select('#name');
        // let customMessage = select('#customMessage');
        // product.addEventListener('focusout',function(e){
        //     // console.log();
        //     let url = `${base_path}/admin/check-product-exists-or-not/${this.value}`
        //     axios.get(url)
        //     .then(res =>{
        //         if(res.data.flag === 'EXIST'){
        //             customMessage.textContent = 'product Already Exist!';
        //             customMessage.className = 'text-danger';
        //         }else{
        //             customMessage.textContent = "product Doesn't Exist!";
        //             customMessage.className = 'text-success';
        //         }
        //     })
        // })

        $('#form').validate({
        rules: {
            name: {
                required: true
            },
            category_id: {
                required: true
            },
            sub_cat_id: {
                required: true
            },
            color_id: {
                required: true
            },
            size_id: {
                required: true
            },
            image: {
                required: true
            },
            slider_images: {
                required: true
            },
            price: {
                required: true
            },
            sell_price: {
                required: true
            },
            long_des: {
                required: true
            },
            long_des: {
                required: true
            },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid').addClass('is-valid');
        }
    });
    </script>
@endpush
