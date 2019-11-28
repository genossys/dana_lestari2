@extends('admin.master')

@section('judul')
    Data Pengajuan Deposito
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="text-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Pengajuan Deposito</li>
                    </ol>
            </div>

            <div class="card card-outline card-info">
                <div class="card-header">
                    <div class="float-sm-left">
                        <h3 class="card-title">Data Pengajuan Deposito</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive-lg">
                        <table id="tb-deposito" class="table table-striped  table-bordered table-hover display nowrap" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Pemohon</th>
                                    <th>No. Telp</th>
                                    <th>Email</th>
                                    <th>Domisili</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    Footer
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('/css/datatables/dataTables.bootstrap4.min.css')}}">
<style>
div.dataTables_wrapper {
  
}
</style>
@endsection

@section('script')
<script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
var table;
$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    table = $('#tb-deposito').DataTable({
        lengthMenu: [[5, 10, 15, -1], [5, 10, 15, "All"]],
        autowidth: true,
        serverSide: true,
        processing: false,
        ajax: '/admin/deposito/view',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
            { data: 'nama', name: 'nama' },
            { data: 'telp', name: 'telp' },
            { data: 'email', name: 'email' },
            { data: 'domisili', name: 'domisili' },
            { data: 'action', name: 'action', searchable: false, orderable: false }
        ],
        columnDefs: [
            { targets: [0], width:'10%', orderable: false},
            { targets: [1], width:'35%'},
            { targets: [2], width:'20%'},
            { targets: [3], width:'25%'},
            { targets: [4], width:'25%'},
            { targets: [5], width:'10%', orderable: false},
            {
                targets: [0, 2, 3,5],
                className: 'text-center'
            },
            {
                targets: [1,4],
                className: 'text-left'
            },
        ],
        "scrollX": true
    });

});

</script>
@endsection