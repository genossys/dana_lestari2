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
   <div class="report-title text-center">Laporan Data Stok Najwa Collection Online Shop</div> 
    <br>
    <table id="example2" class="table table-striped  table-bordered table-hover" cellspacing="0" width="100%">
                <thead>
                    <tr class="text-center">
                        <th class="text-center">#</th>
                        <th class="text-center">Kode Produk</th>
                        <th class="text-center">Nama Produk</th>
                        <th class="text-center">Satuan</th>
                        <th class="text-center">Kategori</th>
                        <th>Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product as $item)
                        <tr class="text-center">
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->kdProduct}}</td>
                            <td class="text-left">{{$item->namaProduct}}</td>
                            <td>{{$item->kdSatuan}}</td>
                            <td>{{$item->namaKategori}}</td>
                            <td>{{$item->qty}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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