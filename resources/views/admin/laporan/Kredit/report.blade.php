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
   <div class="report-title text-center">Laporan Pengajuan Kredit BPR LESTARI JATENG</div> 
   <div class="report-periode text-center">{{$periode}}</div>
    <br>
    <table id="example2" class="table table-striped  table-bordered table-hover" cellspacing="0" width="100%">
                <thead>
                    <tr class="text-center">
                        <th class="text-center">#</th>
                        <th>Nama Pemohon</th>
                        <th class="text-center">No. Telp</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Domisili</th>
                        <th class="text-center">Pekerjaan</th>
                        <th class="text-right">Penghasilan</th>
                        <th class="text-center">Jaminan</th>
                        <th class="text-right">Pinjaman</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kredit as $item)
                        <tr class="text-center">
                            <td>{{$loop->iteration}}</td>
                            <td class="text-left">{{$item->nama}}</td>
                            <td>{{$item->telp}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->domisili}}</td>
                            <td>{{$item->pekerjaan}}</td>
                            <td class="text-right">{{$item->penghasilan}}</td>
                            <td>{{$item->jaminan}}</td>
                            <td class="text-right">{{formatuang($item->pinjaman)}}</td>
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