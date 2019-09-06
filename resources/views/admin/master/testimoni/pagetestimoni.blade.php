@extends('admin.master')

@section('judul')
Data Testimoni
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="text-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Testimoni</li>
                    </ol>
                </div>

                <div class="card card-outline card-info">
                    <div class="card-header">
                        <div class="float-sm-left">
                            <h3 class="card-title">Data Testimoni</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive-lg">
                            <table id="example2" class="table table-striped  table-bordered table-hover" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal</th>
                                        <th>Username</th>
                                        <th>Isi Testimoni</th>
                                        <th>Status</th>
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
    
@endsection

@section('script')
    <script>
        var table;
        $(document).ready(function () {
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

            table = $('#example2').DataTable({
            lengthMenu: [[5, 10, 15, -1], [5, 10, 15, "All"]],
            autowidth: true,
            serverSide: true,
            processing: false,
            ajax: '/admin/testimoni/viewtestimoni',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                { data: 'created_at', name: 'created_at' },
                { data: 'username', name: 'username' },
                { data: 'isi', name: 'isi' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', searchable: false, orderable: false }
            ],
            columnDefs: [
                { targets: [0], width:'5%', orderable: false},
                { targets: [1], width:'10%'},
                { targets: [2], width:'10%'},
                { targets: [3], width:'50%'},
                { targets: [4], width:'15%'},
                { targets: [5], width:'10%', orderable: false},
                {
                    targets: [0, 1, 2, 4, 5],
                    className: 'text-center'
                }, 
                {
                    targets: [3],
                    className: 'text-left'
                }
            ],

            })
        });

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
                    deleteProduct(id);
                }
            });
        }
        
        function deleteProduct(id) {
            $.ajax({
                type: 'POST',
                url: '/admin/testimoni/deletetestimoni',
                data: {
                    _method: 'DELETE',
                    _token: $('input[name=_token]').val(),
                    id: id
                },
                success: function (response) {
                    console.log(response);
                    if (response.sqlResponse) {
                        callSwal();
                        table.draw();
                    } else {
                        swal('Ooops','Anda Gagal Menghapus Data\n'+response.data, 'success');
                    }
                },
                error: function (response) {
                    alert(response.responseText);
                }

            });
        }
        
       function callSwal(){
             swal({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Anda Berhasil Menghapus Data',
                    buttons: false,
                    timer: 2000,
                });
        }
    </script>    
@endsection