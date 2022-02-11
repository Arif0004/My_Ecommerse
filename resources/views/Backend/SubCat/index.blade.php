
@extends('layouts.backend_master')
@section('title', 'Sub Category')
@section('master_content')

<div class="row pt-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="text-info">Manage Sub Category</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="catTable">
                    <tr>
                        <th>SL</th>
                        <th>Parent</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                <tbody id="catTbody">
                </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="text-info">Add Sub Category</h3>
            </div>
            <div class="card-body">
                <form id="addSubCategoryForm">
                    <div class="form-group">
                        <label for="">Sub Category Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter Sub Category Name" name="name">
                        <span class="text-danger" id="catError"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Parent Category</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">Select A Category</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger" id="parentError"></span>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success btn-block">Add New Sub Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">View Sub Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="viewData">

        </div>
      </div>
    </div>
  </div>
<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Sub Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" id="editForm">

          </form>
        </div>
      </div>
    </div>
  </div>

@endsection
@push('css')
<x-Utility.data-table-css/>
@endpush
@push('script')
<x-Utility.data-table-js/>
<script>

const getAllSubCategory = ()=> {
        axios.get("{{ route('admin.fetch-sub-category') }}")
        .then((res) => {
            const {data} = res
            table_data_row(data)
        })
    }
   getAllSubCategory();
    const table_data_row = (items) => {
       let loop =  items.map((item,index) => {
            return `
            <tr>
                <td>${++index}</td>
                <td>${item.parent.name}</td>
                <td>${item.name}</td>
                <td class="text-center">
                    <a href="" class="btn btn-sm btn-success" data-id="${item.slug}" data-toggle="modal" data-target="#viewModal" id="viewRow"><i class="fa fa-eye"></i></a>
                    <a href="" class="btn btn-sm btn-info" data-id="${item.slug}" data-toggle="modal" data-target="#editModal" id="editRow"><i class="fa fa-edit"></i></a>
                    <a href="" id="deleteRow" class="btn btn-sm btn-danger" data-id="${item.slug}"><i class="fa fa-trash-alt"></i></a>
                </td>
            </tr>
            `
        });
        loop = loop.join("")
        const tbody = $$('#catTbody')
        tbody.innerHTML = loop
    }
    // $('#catTable').DataTable()

 // store
 $('#addSubCategoryForm').validate({
        rules: {
            name: {
                required: true
            },
            category_id :{
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

    // store
    $('body').on('submit','#addSubCategoryForm',function(e){
    e.preventDefault();
    let name = $('#name');
    let category_id = $('#category_id');
    let catError = $('#catError');
    let parentError = $('#parentError');
    catError.text('');
    parentError.text('')

    axios.post("{{ route('admin.sub-category.store') }}",{
        name: name.val(),
        category_id : category_id.val()
    })
    .then((res) => {
        setSuccessMessage();
        getAllSubCategory();
        name.val('');
        category_id.val('');
    })
    .catch((err)=>{
       if(err.response.data.errors.name){
           catError.text(err.response.data.errors.name[0])
       }
       if(err.response.data.errors.category_id){
        parentError.text(err.response.data.errors.category_id[0])
       }
    })
 })

// delete
 $('body').on('click','#deleteRow',function(e){
    e.preventDefault()
    let slug = $(this).attr('data-id');
    const url = `${base_url_admin}/sub-category/${slug}`;
    deleteDataWithAlert(url,getAllSubCategory);
})
</script>
@endpush
