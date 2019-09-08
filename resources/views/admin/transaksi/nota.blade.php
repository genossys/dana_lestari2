<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap3.min.css">
    <title>Document</title>
    <style>
       
        .report-title{
            font-size: 14px;
            font-weight: bolder;
        }
        .report-periode{
            font-size: 11px;
        }
        .footer{
            position: fixed;
            bottom: 0cm;
            right: 0cm;
            height: 2cm;
        }
       
        body{
            font-size: 10px;
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>
<body>
    <div class="report-title text-right">Nota Penjualan</div>
    <br>
    <div class="row">
        <div class="col-xs-2">No. Transaksi</div>
        <div class="col-xs-10">: {{$transaksi[0]->noTrans}}</div>
    </div>
    <div class="row">
        <div class="col-xs-2">Tgl. Transaksi</div>
        <div class="col-xs-10">: {{$transaksi[0]->tanggal}}</div>
    </div>
    <div class="row">
        <div class="col-xs-2">Atas nama</div>
        <div class="col-xs-10">: {{$transaksi[0]->username}}</div>
    </div>
    <div class="row">
        <div class="col-xs-2">Alamat Pengiriman</div>
        <div class="col-xs-10">: {{$transaksi[0]->alamat}}</div>
    </div>
    <br>
    <table id="example2" class="table table-striped  table-bordered table-hover" cellspacing="0" width="100%">
                <thead>
                    <tr class="text-center">
                        <th class="text-center">#</th>
                        <th class="text-center">Nama Produk</th>
                        <th class="text-center">Harga</th>
                        <th class="text-center">Qty</th>
                        <th>Total (Rp.)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksi as $item)
                        <tr class="text-center">
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->namaProduct}}</td>
                            <td class="text-right">{{formatuang($item->harga)}}</td>
                            <td>{{$item->qty}}</td>
                            <td class="text-right">{{formatuang($item->subtotal)}}</td>
                        </tr>
                    @endforeach
                </tbody>
    </table>
    <br>
    <div class="row" style="font-size: 12px; font-weight: 700;">
        <div class="col-xs-9 text-right">Sub Total :</div>
        <div class="col-xs-2 text-right">{{formatuang($subtotal)}}</div>
    </div>
    <div class="row" style="font-size: 12px; font-weight: 700;">
        <div class="col-xs-9 text-right">Ongkir (JNE) :</div>
        <div class="col-xs-2 text-right">{{formatuang($ongkir)}}</div>
    </div>
    <div class="row" style="font-size: 12px; font-weight: 700;">
        <div class="col-xs-9 text-right">Total :</div>
        <div class="col-xs-2 text-right">{{formatuang($total)}}</div>
    </div>
    <div class="footer">
        <div class="row">
            <div class="col-xs-4"></div>
            <div class="col-xs-4"></div>
            <div class="col-xs-3 text-center">
                Surakarta, {{date('d-m-Y')}}
            </div>
        </div>
        <div class="row">
            <div class="col-xs-4">
                Customer
                <br>
                <br>
                <br>
                ({{$transaksi[0]->username}})
            </div>
            <div class="col-xs-4">
            </div>
            <div class="col-xs-3 text-center">
                Admin
                <br>
                <br>
                <br>
                (................)
            </div>
        </div>
    </div>
</body>
</html>