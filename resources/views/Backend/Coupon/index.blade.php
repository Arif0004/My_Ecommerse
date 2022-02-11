
@extends('layouts.backend_master')
@section('title', 'Coupon')
@section('master_content')

<div class="row pt-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="text-info">Manage Coupon</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="catTable">
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Disount</th>
                        <th>Expire Date</th>
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
                <h3 class="text-info">Add Coupon</h3>
            </div>
            <div class="card-body">
                <form id="addCouponForm">
                    <div class="form-group">
                        <label for="">Coupon Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter Coupon Name" name="name">
                        <span class="text-danger" id="catError"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Discount</label>
                        <input type="number" class="form-control" id="discount" name="discount" placeholder="Enter discount in % (ex:5%)">
                        <span class="text-danger" id="discountError"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Expired Date</label>
                        <input type="date" class="form-control" id="expired_date"  name="expired_date">
                        <span class="text-danger" id="dateError"></span>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success btn-block">Add New Coupon</button>
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
          <h5 class="modal-title" id="exampleModalLabel">View Coupon</h5>
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
          <h5 class="modal-title" id="exampleModalLabel">Edit Coupon</h5>
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
    const getAllCoupon = ()=> {
        axios.get("{{ route('admin.fetch-coupon') }}")
        .then((res) => {
            const {data} = res
            table_data_row_(data)
        })
    }
   getAllCoupon();
    const table_data_row_ = (items) => {
       let loop =  items.map((item,index) => {
            return `
            <tr>
                <td>${++index}</td>
                <td>${item.name}</td>
                <td>${item.discount}%</td>
                <td>${item.expired_date}</td>
                <td class="text-center">
                    <a href="" class="btn btn-sm btn-info" data-id="${item.id}" data-toggle="modal" data-target="#editModal" id="editRow"><i class="fa fa-edit"></i></a>
                    <a href="" id="deleteRow" class="btn btn-sm btn-danger" data-id="${item.id}"><i class="fa fa-trash-alt"></i></a>
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
 $('#addCouponForm').validate({
        rules: {
            name: {
                required: true
            },
            expired_date :{
                required: true
            },
            discount :{
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
 $('body').on('submit','#addCouponForm',function(e){
    e.preventDefault();
    let name = $('#name').val();
    let expired_date = $('#expired_date').val();
    let discount = $('#discount').val();

    let dateError = $('#dateError');
    let catError = $('#catError');
    let discountError = $('#imageError');

    catError.text('');
    discountError.text('')
    dateError.text('')

    axios.post("{{ route('admin.coupon.store') }}",{name,discount,expired_date})
    .then((res) => {
        setSuccessMessage();
        getAllCoupon();
        name.val('');
        expired_date.val('');
        discount.val('');
    })
    .catch((err)=>{
       if(err.response.data.errors.name){
           catError.text(err.response.data.errors.name[0])
       }
       if(err.response.data.errors.discount){
        discountError.text(err.response.data.errors.discount[0])
       }
       if(err.response.data.errors.expired_date){
        dateError.text(err.response.data.errors.expired_date[0])
       }
    })
 })

 // delete

$('body').on('click','#deleteRow',function(e){
    e.preventDefault()
    let slug = $(this).attr('data-id');
    const url = `${base_url_admin}/coupon/${slug}`;
    deleteDataWithAlert(url,getAllCoupon);
})

// edit
$('body').on('click','#editRow',function(){
    let id = $(this).data('id');
    let url = `${base_url_admin}/coupon/${id}`;
    axios.get(url).then(res => {
        let {data} = res;
        //console.log(data)
        let form = $$('#editForm');
        form.innerHTML = `<div class="form-group">
                <label for="">Coupon Name</label>
                <input type="text" class="form-control" id="edit_name" value="${data.name}" name="name">
                <input type="hidden" id="edit_cat_id" value="${data.id}">
                <span class="text-danger" id="catEditError"></span>
            </div>
            <div class="form-group">
                        <label for="">Discount</label>
                        <input type="number" class="form-control" id="edit_discount" name="discount" placeholder="Enter discount in % (ex:5%)" value="${data.discount}">
                        <span class="text-danger" id="discountEditError"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Expired Date</label>
                        <input type="date" class="form-control" id="edit_expired_date"  name="expired_date" value="${data.expired_date}">
                        <span class="text-danger" id="dateEditError"></span>
                    </div>
            <div class="form-group">
                <button class="btn btn-success btn-block">Update Coupon</button>
            </div>
            `
    }).catch(err => {
        console.log(err);
    })
})
// update
$('body').on('submit','#editForm',async function(e){
    e.preventDefault()
    let id = $('#edit_cat_id').val();
    let url = `${base_url_admin}/coupon/${id}`;
    let name = $('#edit_name').val();
    let discount = $('#edit_discount').val();
    let expired_date = $('#edit_expired_date').val();
    const data = {name,discount,expired_date};
    let dateEditError = $('#dateEditError');
    let catEditError = $('#catEditError');
    try{
        const response = await axios.put(url,data);
        setSuccessMessage('Data Update Successfully!');
        getAllCoupon()
        $('#editModal').modal('toggle');

    }catch(err){
        if(err.response.data.errors.name){
            catEditError.text(err.response.data.errors.name[0])
       }

       if(err.response.data.errors.expired_date){
        dateEditError.text(err.response.data.errors.expired_date[0])
       }
    }
})

// View
$('body').on('click','#viewRow',function(){
    let slug = $(this).data('id');
    axios.get(`${base_url_admin}/coupon/${slug}`)
    .then(res=> {
        let {data:Coupon} = res;
        log(Coupon)

        let viewData = $$('#viewData');
        viewData.innerHTML = `
        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <td>${Coupon.name}</td>
            </tr>
            <tr>
                <th>Image</th>
                <td><img src="{{ asset('${Coupon.image}') }}" width="100px" alt=""></td>
            </tr>
        </table>
        `
    });
})


</script>
@endpush
