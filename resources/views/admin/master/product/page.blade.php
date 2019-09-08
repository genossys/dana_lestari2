@extends('admin.master')

@section('judul')
Data Produk
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="text-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Produk</li>
                    </ol>
                </div>

                <div class="card card-outline card-info">
                    <div class="card-header">
                        <div class="float-sm-left">
                            <h3 class="card-title">Data Produk</h3>
                        </div>
                        <div class="float-sm-right">
                            <a class="btn btn-primary btn-sm box-tools" href="/admin/product/newproduct">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Produk Baru
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        
                        <div class="table-responsive-lg">
                            <table id="tb-product" class="table table-striped  table-bordered table-hover" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kode Produk</th>
                                        <th>Nama Produk</th>
                                        <th>Satuan</th>
                                        <th>Diskon (%)</th>
                                        <th>Harga (Rp.)</th>
                                        <th>Stok</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('/css/datatables/dataTables.bootstrap4.min.css')}}">     
@endsection

@section('script')
<script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/handlebars/handlebars.js') }}"></script>
<script id="details-template" type="text/x-handlebars-templatel">
@verbatim
<div class="row">
    <div id="foto" class="col-sm-2 text-center">
                    <img src="/foto/{{ 'urlFoto' }}" height="100" width="100">
        </div>
        <div id="detail" class="col-sm-10">
        <table class="table table-light">
            <tbody>
                <tr>
                    <td>Kategori</td>
                    <td>:</td>

                    <td>{{ 'namaKategori' }}</td>

                </tr>
                <tr>
                    <td>Deskripsi</td>
                    <td>:</td>
                    <td>{{ 'deskripsi' }}</td>
                </tr>
                <tr>
                    <td>Status Promo</td>
                    <td>:</td>
                    <td>{{ 'promo' }}</td>
                </tr>
            </tbody>
        </table>
        </div>

</div>

@endverbatim
</script>
<script>
var table;
$(document).ready(function () {
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
var template = Handlebars.compile($("#details-template").html());

    table = $('#tb-product').DataTable({
    lengthMenu: [[5, 10, 15, -1], [5, 10, 15, "All"]],
    autowidth: true,
    serverSide: true,
    processing: false,
    ajax: '/admin/product/view',
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
        { data: 'kdProduct', name: 'kdProduct' },
        { data: 'namaProduct', name: 'namaProduct' },
        { data: 'namaSatuan', name: 'namaSatuan' },
        { data: 'diskon', name: 'diskon' },
        { data: 'hargaJual', name: 'hargaJual' },
        { data: 'qty', name: 'qty' },
        { data: 'action', name: 'action', searchable: false, orderable: false }
    ],
    columnDefs: [
        { targets: [0], width:'5%', orderable: false},
        { targets: [1], width:'10%'},
        { targets: [2], width:'30%'},
        { targets: [3], width:'10%'},
        { targets: [4], width:'10%'},
        { targets: [5], width:'10%'},
        { targets: [6], width:'10%'},
        { targets: [7], width:'15%', orderable: false},
        {
            targets: [0, 1, 3, 6, 7],
            className: 'text-center'
        }, 
        {
            targets: [4,5],
            className: 'text-right'
        }
    ],

}).columns.adjust();

    $('#tb-product tbody').on('click', 'td a.details-control', function (e) {

        var tr = $(this).closest('tr');
        var row = table.row(tr);

        if (row.child.isShown()) {
            row.child.hide();
            tr.removeClass('shown');
        } else {
            row.child(
                template(row.data())
            ).show();
            tr.addClass('shown');
        }
        e.preventDefault();
    });
});


function destroy(id) {
    $.ajax({
        type: 'POST',
        url: '/admin/product/delete',
        data: {
            _method: 'DELETE',
            _token: $('input[name=_token]').val(),
            id: id
        },
        success: function (response) {
            console.log(response);
            if (response.sqlResponse) {
                swalSukses('Anda Berhasil Menghapus Data');
                table.draw();
            } else {
                swal('Ooops','Anda Gagal Menghapus Data\n'+response.data, 'error');
            }
        },
        error: function (response) {
            alert(response.responseText);
        }

    });
}

function swalSukses(text){
    swal({
        icon: 'success',
        title: 'Berhasil',
        text: text,
        buttons: false,
        timer: 2000,
    });
}

function hapus(id, e) {
    e.preventDefault();
    swal({
    dangerMode: true,
    icon: 'warning',
    title: 'Konfirmasi',
    text: 'Apa Anda Yakin ingin Menghapus Data '+id+' ?',
    buttons: {
        cancel: 'Batal',
            confirm: 'Hapus'
    },
    }).then(function(isConfirm){
        if (isConfirm) {
            destroy(id);
        }
    });
}
</script>
@endsection