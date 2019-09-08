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
    <div class="report-title text-center">Laporan Penjualan Najwa Collection Online Shop</div>
    <div class="report-periode text-center">{{$periode}}</div>
    <br>
    <table id="example2" class="table table-striped  table-bordered table-hover" cellspacing="0" width="100%">
                <thead>
                    <tr class="text-center">
                        <th class="text-center">#</th>
                        <th class="text-center">No. Transaksi</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Username</th>
                        <th class="text-center">Bank</th>
                        <th class="text-right">Sub Total (Rp.)</th>
                        <th class="text-right">Ongkir (Rp.)</th>
                        <th class="text-right">Total (Rp.)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penjualan as $item)
                        <tr class="text-center">
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->noTrans}}</td>
                            <td>{{$item->tanggal}}</td>
                            <td>{{$item->username}}</td>
                            <td>{{$item->bank}}</td>
                            <td class="text-right">{{formatuang($item->subTotal)}}</td>
                            <td class="text-right">{{formatuang($item->ongkir)}}</td>
                            <td class="text-right">{{formatuang($item->total)}}</td>
                        </tr>
                    @endforeach
                </tbody>
    </table>
    <br>
    <div class="row" style="font-size: 12px; font-weight: 700;">
        <div class="col-xs-9 text-right">Total Penjualan :</div>
        <div class="col-xs-2 text-right">{{formatuang($total)}}</div>
    </div>
    <div class="footer">
        <div class="row">
            <div class="col-xs-4"></div>
            <div class="col-xs-4"></div>
            <div class="col-xs-4 text-center">
                Surakarta, {{date('d-m-Y')}}
            </div>
        </div>
        <div class="row">
            <div class="col-xs-4 text-center">
                Admin
                <br>
                <br>
                <br>
                (................)
            </div>
            <div class="col-xs-4">
            </div>
            <div class="col-xs-4 text-center">
                Pimpinan
                <br>
                <br>
                <br>
                (................)
            </div>
        </div>
    </div>
</body>
</html>