
@extends('layouts.backend_master')
@section('title', 'Category')
@section('master_content')

<div class="row pt-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="text-info">Manage Category</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="catTable">
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Image</th>
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
                <h3 class="text-info">Add Category</h3>
            </div>
            <div class="card-body">
                <form id="addCategoryForm">
                    <div class="form-group">
                        <label for="">Category Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter Category Name" name="name">
                        <span class="text-danger" id="catError"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Category Image</label>
                        <input name="image" type="file" class="form-control" id="image">
                        <span class="text-danger" id="imageError"></span>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success btn-block">Add New Category</button>
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
          <h5 class="modal-title" id="exampleModalLabel">View Category</h5>
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
          <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
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
 //setSuccessMessage();
    const getAllCategory = ()=> {
        axios.get("{{ route('admin.fetch-category') }}")
        .then((res) => {
            const {data} = res
            table_data_row_(data)
        })
    }
   getAllCategory();
    const table_data_row_ = (items) => {
       let loop =  items.map((item,index) => {
            return `
            <tr>
                <td>${++index}</td>
                <td>${item.name}</td>
                <td><img src="{{ asset('${item.image}') }}" width="80px"></td>
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
  //  $('#catTable').DataTable()

 // store
 $('#addCategoryForm').validate({
        rules: {
            name: {
                required: true
            },
            image :{
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
 $('body').on('submit','#addCategoryForm',function(e){
    e.preventDefault();
    let name = $('#name');
    let image = $('#image');
    let catError = $('#catError');
    let imageError = $('#imageError');
    catError.text('');
    imageError.text('')
    const data = new FormData();
    data.append('name',name.val());
    data.append('image', document.getElementById('image').files[0]);
    const config = { headers: { 'Content-Type': 'multipart/form-data' } };
    axios.post("{{ route('admin.category.store') }}",data)
    .then((res) => {
        setSuccessMessage();
        getAllCategory();
        name.val('');
        image.val(null);
    })
    .catch((err)=>{
       if(err.response.data.errors.name){
           catError.text(err.response.data.errors.name[0])
       }
       if(err.response.data.errors.image){
        imageError.text(err.response.data.errors.image[0])
       }
    })
 })

 // delete

$('body').on('click','#deleteRow',function(e){
    e.preventDefault()
    let slug = $(this).attr('data-id');
    const url = `${base_url_admin}/category/${slug}`;
    deleteDataWithAlert(url,getAllCategory);
})

// edit
$('body').on('click','#editRow',function(){
    let slug = $(this).data('id');
    let url = `${base_url_admin}/category/${slug}`;
    axios.get(url).then(res => {
        let {data} = res;
        let form = $$('#editForm');
        form.innerHTML = `<div class="form-group">
                <label for="">Category Name</label>
                <input type="text" class="form-control" id="edit_name" value="${data.name}">
                <input type="hidden" id="edit_cat_slug" value="${data.slug}">
                <span class="text-danger" id="catEditError"></span>
            </div>
            <div class="form-group">
                <label for="">Category Image</label>
                <input name="image" type="file" class="form-control" id="editImage">
                <span class="text-danger" id="imageEditError"></span>
                <img src="{{ asset('${data.image}') }}" alt="" width="100px" class="mt-3">
            </div>
            <div class="form-group">
                <button class="btn btn-success btn-block">Update Category</button>
            </div>
            `
    }).catch(err => {
        console.log(err);
    })
})
// update
$('body').on('submit','#editForm',function(e){
    e.preventDefault()
    let slug = $('#edit_cat_slug').val();
    let url = `${base_url_admin}/category/${slug}`;
    let editImage = $('#editImage');
    let editName = $('#edit_name')
    if(editImage.val()){
        const data = new FormData();
        const config = { headers: { 'Content-Type': 'multipart/form-data' } };
        data.append('image',document.getElementById('editImage').files[0]);
        log(document.getElementById('editImage').files[0])
        sendUpdateAjaxRequest(url,{name:editName.val(),image:data}).then(res => {
            getAllCategory();
            setSuccessMessage('Data Update Successfully!')
            $('#editModal').modal('toggle')
        })
    }else{
        sendUpdateAjaxRequest(url,{name: editName.val()}).then(res => {
            getAllCategory();
            setSuccessMessage('Data Update Successfully!')
            $('#editModal').modal('toggle')
        })
    }
})
const sendUpdateAjaxRequest = (url,data) => {
    log(data)
    return axios.put(url,data);
}
// View
$('body').on('click','#viewRow',function(){
    let slug = $(this).data('id');
    axios.get(`${base_url_admin}/category/${slug}`)
    .then(res=> {
        let {data:category} = res;
        log(category)

        let viewData = $$('#viewData');
        viewData.innerHTML = `
        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <td>${category.name}</td>
            </tr>
            <tr>
                <th>Image</th>
                <td><img src="{{ asset('${category.image}') }}" width="100px" alt=""></td>
            </tr>
        </table>
        `
    });
})


</script>
@endpush
