@extends('admin.master')

@section('judul')
Detail Pembayaran
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#detail" role="tab" aria-controls="nav-home" aria-selected="true">Detail Penjualan</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#bukti" role="tab" aria-controls="nav-profile" aria-selected="false">Bukti Transfer</a>
                    </div>
                </nav>

                <div class="tab-content" id="nav-tabContent">

                    <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="nav-home-tab" id="detail">
                    <div class="card card-outline card-info">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-3"><h2 class="card-title">Online Shop</h2></div>
                            <div class="col-md-9 text-right">
                                <h5 class="card-title">
                                    Status Konfrimasi : {{$status}}
                                </h5>
                            </div>
                            
                        </div>
                        <div class="row">
                                <div class="col-md-2">No. Transaksi</div>
                                <div class="col-md-9">: {{$transaksi[0]->noTrans}}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Atas Nama</div>
                                <div class="col-md-9">: {{$transaksi[0]->username}}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Alamat</div>
                                <div class="col-md-9">: {{$transaksi[0]->alamat}}</div>
                            </div>
                    </div>
                    <div class="card-body">
                    <h5>Detail Pesanan</h5> 
                        <div class="table-responsive-lg">
                            <table id="example2" class="table table-striped  table-bordered table-hover" cellspacing="0" widtd="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-left">Nama Product</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-right">Harga (Rp.)</th>
                                        <th class="text-right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaksi as $item)
                                        <tr>
                                            <td class="text-center">{{$loop->iteration}}</td>
                                            <td class="text-left">{{$item->namaProduct}}</td>
                                            <td class="text-center">{{$item->qty}}</td>
                                            <td class="text-right">{{formatuang($item->harga)}}</td>
                                            <td class="text-right">{{formatuang($item->subtotal)}}</td>
                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row" style="font-weight: bolder;">
                            <div class="col-md-10 text-right">Sub Total :</div>
                            <div class="col-md-2 text-right" style="padding-right: 30px;"> {{formatuang($subtotal)}}</div>
                        </div>
                        <div class="row" style="font-weight: bolder;">
                            <div class="col-md-10 text-right">Ongkir (JNE) :</div>
                            <div class="col-md-2 text-right" style="padding-right: 30px;"> {{formatuang($ongkir)}}</div>
                        </div>
                        
                        <div class="row" style="font-weight: bolder;">
                            <div class="col-md-10 text-right">Total Belanja :</div>
                            <div class="col-md-2 text-right" style="padding-right: 30px;"> {{formatuang($total)}}</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-right">
                                <a href="/admin/laporan/penjualan/invoice?noTrans={{$transaksi[0]->noTrans}}" target="_blank" id="btnCetak" class="btn btn-primary" style="display: inline-block"><i id="iconbtn" class="fa  fa-print" aria-hidden="true"></i>&nbsp;Cetak Invoice</a>
                        </div>
                    </div>
                </div>

                
                </div>
                <div class="tab-pane fade" role="tabpanel" aria-labelledby="nav-profile-tab" id="bukti">
                    <div class="card">
                        <div class="card-header">
                            Bukti Transfer
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div id="foto" class="col-md-10 text-center">
                                        <img src="{{asset ('/bukti/'.$transaksi[0]->urlBukti)}}" height="500" width="500">
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
</script>
@endsection