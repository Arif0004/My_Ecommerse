
@extends('layouts.backend_master')
@section('title', 'Category')
@section('master_content')
<div class="container">
    <table id="table_id" class="display">
        <thead>
            <tr>
                <th>Column 1</th>
                <th>Column 2</th>
            </tr>
        </thead>
        <tbody>
            {{-- <tr>
                <td>Row 1 Data 1</td>
                <td>Row 1 Data 2</td>
            </tr>
            <tr>
                <td>Row 2 Data 1</td>
                <td>Row 2 Data 2</td>
            </tr> --}}
        </tbody>
    </table>
</div>
@endsection
@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
{{-- <x-Utility.data-table-css/> --}}
@endpush
@push('script')
<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
{{-- <x-Utility.data-table-js/> --}}
<script>
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
                <td class="text-center">
                    <a href="" class="btn btn-sm btn-success" data-id="${item.slug}" data-toggle="modal" data-target="#viewRow"><i class="fa fa-eye"></i></a>
                    <a href="" class="btn btn-sm btn-info" data-id="${item.slug}"><i class="fa fa-edit" data-toggle="modal" data-target="#editRow"></i></a>
                    <a href="" class="btn btn-sm btn-danger" data-id="${item.slug}"><i class="fa fa-trash-alt" data-toggle="modal" data-target="#editRow"></i></a>
                </td>
            </tr>
            `
        });
        loop = loop.join("")
        // let table = $$('#catTable')
        // let tbody = table.querySelector('#catTbody')
        //  tbody.innerHTML = loop
        // table.appendChild(tbody)
        // log(table)
        const tbody = $$('tbody')
        tbody.innerHTML = loop
      //  log(tbody)
     $('#table_id').DataTable()

    }
   $('#table_id').DataTable();
</script>
@endpush
