
@extends('layouts.backend_master')
@section('title', 'Slider')
@section('master_content')

<div class="row pt-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="text-info">Manage Slider</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="catTable">
                    <tr>
                        <th>SL</th>
                        <th>Title</th>
                        <th>Status</th>
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
                <h3 class="text-info">Add Slider</h3>
            </div>
            <div class="card-body">
                <form id="addSliderForm">
                    <div class="form-group">
                        <label for="">Slider Title</label>
                        <input type="text" class="form-control" id="title" placeholder="Enter Slider Title" name="title">
                        <span class="text-danger" id="sliderTitleError"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Slider Image</label>
                        <input name="image" type="file" class="form-control" id="image">
                        <span class="text-danger" id="imageError"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Slider Content</label>
                        <textarea class="form-control" name="content" id="content" cols="30" rows="5"></textarea>
                        <span class="text-danger" id="sliderContentError"></span>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success btn-block">Add New Slider</button>
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
          <h5 class="modal-title" id="exampleModalLabel">View Slider</h5>
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
          <h5 class="modal-title" id="exampleModalLabel">Edit Slider</h5>
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
    const getAllSlider = ()=> {
        axios.get("{{ route('admin.fetch-slider') }}")
        .then((res) => {
            const {data} = res
            table_data_row_(data)
        })
    }
   getAllSlider();
    const table_data_row_ = (items) => {
       let loop =  items.map((item,index) => {
            return `
            <tr>
                <td>${++index}</td>
                <td>${item.title}</td>
                <td>${item.status == 1 ? 'Active' : 'Inactive'}</td>
                <td><img src="{{ asset('${item.image}') }}" width="80px"></td>

                <td class="text-center">
                    <a href="" class="btn btn-sm btn-success" data-id="${item.id}" data-toggle="modal" data-target="#viewModal" id="viewRow"><i class="fa fa-eye"></i></a>
                    <a href="" class="btn btn-sm btn-info" data-id="${item.id}" data-toggle="modal" data-target="#editModal" id="editRow"><i class="fa fa-edit"></i></a>
                    <a href="" id="deleteRow" class="btn btn-sm btn-danger" data-id="${item.id}"><i class="fa fa-trash-alt"></i></a>
                    ${item.status === 0 ? `<a href="" id="activeRow" class="btn btn-sm btn-success" data-id="${item.id}"><i class="fas fa-arrow-circle-up"></i></a>` : `<a href="" id="inactiveRow" class="btn btn-sm btn-warning" data-id="${item.id}"><i class="fas fa-arrow-circle-down"></i></a>`}

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
 $('#addSliderForm').validate({
        rules: {
            title: {
                required: true
            },
            content: {
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
 $('body').on('submit','#addSliderForm',function(e){
    e.preventDefault();
    let title = $('#title');
    let image = $('#image');
    let content = $('#content');
    let sliderTitleError = $('#sliderTitleError');
    let sliderContentError = $('#sliderContentError');
    let imageError = $('#imageError');
    sliderTitleError.text('');
    imageError.text('');
    sliderContentError.text('');
    const data = new FormData();
    data.append('title',title.val());
    data.append('content',content.val());
    data.append('image', document.getElementById('image').files[0]);
    const config = { headers: { 'Content-Type': 'multipart/form-data' } };
    axios.post("{{ route('admin.slider.store') }}",data)
    .then((res) => {
        setSuccessMessage();
        getAllSlider();
        title.val('');
        content.val('')
        image.val(null);
    })
    .catch((err)=>{
       if(err.response.data.errors.title){
        sliderTitleError.text(err.response.data.errors.title[0])
       }
       if(err.response.data.errors.image){
        imageError.text(err.response.data.errors.image[0])
       }
       if(err.response.data.errors.content){
        sliderContentError.text(err.response.data.errors.content[0])
       }
    })
 })

 // delete

$('body').on('click','#deleteRow',function(e){
    e.preventDefault()
    let id = $(this).attr('data-id');
    const url = `${base_url_admin}/slider/${id}`;
    deleteDataWithAlert(url,getAllSlider);
})

// edit
$('body').on('click','#editRow',function(){
    let id = $(this).data('id');
    let url = `${base_url_admin}/slider/${id}`;
    axios.get(url).then(res => {
        let {data} = res;
        let form = $$('#editForm');
        form.innerHTML = `<div class="form-group">
                <label for="">Slider Name</label>
                <input type="text" class="form-control" id="edit_title" value="${data.title}">
                <input type="hidden" id="edit_cat_id" value="${data.id}">
                <span class="text-danger" id="titleEditError"></span>
            </div>
            <div class="form-group">
                        <label for="">Slider Content</label>
                        <textarea class="form-control" name="content" id="edit_content" cols="30" rows="5">${data.content}</textarea>
                        <span class="text-danger" id="sliderEditContentError"></span>
                    </div>
            <div class="form-group">
                <label for="">Slider Image</label>
                <input name="image" type="file" class="form-control" id="editImage">
                <span class="text-danger" id="imageEditError"></span>
                <img src="{{ asset('${data.image}') }}" alt="" width="100px" class="mt-3">
            </div>
            <div class="form-group">
                <button class="btn btn-success btn-block">Update Slider</button>
            </div>
            `
    }).catch(err => {
        console.log(err);
    })
})
// update
$('body').on('submit','#editForm',function(e){
    e.preventDefault()
    let id = $('#edit_cat_id').val();
    //console.log(id)
    let titleEditError = $('#titleEditError');
    titleEditError.text('')
    let url = `${base_url_admin}/slider/${id}`;
    let editImage = $('#editImage');
    let edit_title = $('#edit_title')
    let edit_content = $('#edit_content')
    if(editImage.val()){
        const data = new FormData();
        const config = { headers: { 'Content-Type': 'multipart/form-data' } };
        data.append('image',document.getElementById('editImage').files[0]);
        log(document.getElementById('editImage').files[0])
        sendUpdateAjaxRequest(url,{id:id,content:edit_content.val(),title:edit_title.val(),image:data}).then(res => {
            getAllSlider();
            setSuccessMessage('Data Update Successfully!')
            $('#editModal').modal('toggle')
        })
        .catch(err => {
            if(err.response.data.errors.title){
            titleEditError.text(err.response.data.errors.title[0])
       }
        })
    }else{
        sendUpdateAjaxRequest(url,{id:id,content: edit_content.val(),title:edit_title.val()}).then(res => {
            getAllSlider();
            setSuccessMessage('Data Update Successfully!')
            $('#editModal').modal('toggle')
        })
        .catch(err => {
            if(err.response.data.errors.title){
            titleEditError.text(err.response.data.errors.title[0])
       }
        })
    }
})
const sendUpdateAjaxRequest = (url,data) => {
   // log(data)
    return axios.put(url,data);
}
// View
$('body').on('click','#viewRow',function(){
    let id = $(this).data('id');
    axios.get(`${base_url_admin}/slider/${id}`)
    .then(res=> {
        let {data:slider} = res;

        let viewData = $$('#viewData');
        viewData.innerHTML = `
        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <td>${slider.title}</td>
            </tr>
            <tr>
                <th>Content</th>
                <td>${slider.content}</td>
            </tr>
            <tr>
                <th>Image</th>
                <td><img src="{{ asset('${slider.image}') }}" width="100px" alt=""></td>
            </tr>
        </table>
        `
    });
})

// inActive
$('body').on('click','#inactiveRow',async function(e){
    e.preventDefault();
    let id = $(this).data('id');
    await axios.put(`${base_url_admin}/slider-inactive/${id}`);
    getAllSlider();
    setSuccessMessage('Slider Inactive Successfully!')
})

// ctive
$('body').on('click','#activeRow',async function(e){
    e.preventDefault();
    let id = $(this).data('id');
    await axios.put(`${base_url_admin}/slider-active/${id}`);
    getAllSlider();
    setSuccessMessage('Slider Active Successfully!')
})
</script>
@endpush
