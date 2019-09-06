@extends('admin.master')

@section('judul')
Laporan Penjualan
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="text-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;Dashboard</a></li>
                        <li class="breadcrumb-item active">Laporan Penjualan</li>
                    </ol>
                </div>

                <div class="card card-outline card-info">
                    <div class="card-header">
                        <div class="card-title">
                            <div class="row">
                                <div class="col-md-6">Filter</div>
                                <div class="col-md-6 text-right">Laporan Penjualan</div>
                            </div>
                        </div>
                        <hr>
                        <div class="filter-table">
                            <form method="get" action="/admin/laporan/penjualan/print" target="_blank">
                                @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="my-select">Periode Awal</label>
                                        <input class="form-control" type="date" name="tgl1" id="tgl1">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="my-select">Periode Akhir</label>
                                        <input class="form-control" type="date" name="tgl2" id="tgl2">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="my-input">No. Transaksi atau Username</label>
                                        <input id="index" class="form-control" type="text" name="index" placeholder="No. Transaksi atau Username.." onkeyup="search()">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive-lg">
                            <table id="tb-penjualan" class="table table-striped  table-bordered table-hover" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>No. Transaksi</th>
                                        <th>Tanggal</th>
                                        <th>Username</th>
                                        <th>Bank</th>
                                        <th>Sub Total (Rp.)</th>
                                        <th>Ongkir (Rp.)</th>
                                        <th>Total (Rp.)</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="text-right">
                                <button type="submit" id="btnCetak" class="btn btn-success"><i id="iconbtn" class="fa  fa-print" aria-hidden="true"></i>&nbsp;Cetak</button>
                            </form>
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
<script>
var table;
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    table = $('#tb-penjualan').DataTable({
        dom : 'lrtip',
        lengthMenu: [[5, 10, 15, -1], [5, 10, 15, "All"]],
        autowidth: true,
        serverSide: true,
        processing: false,
        ajax: {
            type : 'GET',
            url : '/admin/laporan/penjualan/view',
            'data' : function(d){
                return $.extend(
                    {},
                    d,
                    {
                        'tgl1' : $('#tgl1').val(),
                        'tgl2' : $('#tgl2').val(),
                        'index' : $('#index').val(),
                    }
                );
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
            { data: 'noTrans', name: 'noTrans' },
            { data: 'tanggal', name: 'tanggal' },
            { data: 'username', name: 'username' },
            { data: 'bank', name: 'bank' },
            { data: 'subTotal', name: 'subTotal' },
            { data: 'ongkir', name: 'ongkir' },
            { data: 'total', name: 'total' },
            { data: 'detail', name: 'detail', searchable: false, orderable: false }
        ],
        columnDefs: [
            { targets: [0], width:'5%', orderable: false},
            { targets: [1], width:'10%'},
            { targets: [2], width:'10%'},
            { targets: [3], width:'15%'},
            { targets: [4], width:'15%'},
            { targets: [5], width:'10%'},
            { targets: [6], width:'10%'},
            { targets: [7], width:'10%'},
            { targets: [8], width:'15%', orderable: false},
            {
                targets: [0, 1, 2, 3, 4, 7, 8],
                className: 'text-center'
            }, 
            {
                targets: [5,6],
                className: 'text-right'
            }
        ],

    });

    $('#btnCari').on('click', function (e) { 
        search();
        e.preventDefault();
    });

    $('#status').on('change', function () {
        search();
    });

    $('#tgl1').on('change', function () {
        search();
    });

    $('#tgl2').on('change', function () {
        search();
    });
});
        
    function search() {
        table.ajax.reload();
    }

    function cetak(e) {
        e.preventDefault();
        var kategori = $('#kategori').val();
        var index = $('#index').val();
        window.location.replace('');
    }
    </script>
@endsection