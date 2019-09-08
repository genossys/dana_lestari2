<?php

namespace App\Http\Controllers\Admin\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transaksi\KeranjangModel;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use PDF;

class LaporanBarangKeluarController extends Controller
{
    //
    public function index()
    {
        return view('admin.laporan.barangkeluar.page');
    }

    public function search(Request $r)
    {
        $sBynotrans = [['tb_keranjang.kdProduct', 'LIKE', '%' . $r->index . '%']];
        $sByusername = [['tb_product.namaProduct', 'LIKE', '%' . $r->index . '%']];
        $tgl1 = $r->tgl1;
        $tgl2 = $r->tgl2;
        if ($r->tgl1 == '') {
            $tgl1 = Carbon::now()->format('Y-m-d');
        }

        if ($r->tgl2 == '') {
            $tgl2 = Carbon::now()->format('Y-m-d');
        }

        $penjualan = KeranjangModel::query()
            ->join('tb_product', 'tb_keranjang.kdProduct', '=', 'tb_product.kdProduct')
            ->select(
                'tb_keranjang.id as id',
                'tb_keranjang.noTrans as notrans',
                'tb_keranjang.tanggal as tanggal',
                'tb_keranjang.username as username',
                'tb_keranjang.kdProduct as kdProduct',
                'tb_product.namaProduct as namaProduct',
                'tb_product.kdSatuan as kdSatuan',
                'tb_keranjang.qty as qty',
                'tb_keranjang.harga as harga',
                'tb_keranjang.checkout as checkout',
                'tb_product.urlFoto as urlFoto'
            )
            ->where('tb_keranjang.checkout', '=', '1')
            ->whereBetween('tanggal', [$tgl1, $tgl2])
            ->where(function ($query) use ($sByusername, $sBynotrans) {
                $query->where($sByusername)
                    ->orWhere($sBynotrans);
            })
            ->get();
        return DataTables::of($penjualan)
            ->addIndexColumn()
            ->make(true);
    }

    public function print(Request $r)
    {
        $sBynotrans = [['tb_keranjang.kdProduct', 'LIKE', '%' . $r->index . '%']];
        $sByusername = [['tb_product.namaProduct', 'LIKE', '%' . $r->index . '%']];
        $tgl1 = $r->tgl1;
        $tgl2 = $r->tgl2;
        if ($r->tgl1 == '') {
            $tgl1 = Carbon::now()->format('Y-m-d');
        }

        if ($r->tgl2 == '') {
            $tgl2 = Carbon::now()->format('Y-m-d');
        }

        $penjualan = KeranjangModel::query()
            ->join('tb_product', 'tb_keranjang.kdProduct', '=', 'tb_product.kdProduct')
            ->select(
                'tb_keranjang.id as id',
                'tb_keranjang.noTrans as notrans',
                'tb_keranjang.tanggal as tanggal',
                'tb_keranjang.username as username',
                'tb_keranjang.kdProduct as kdProduct',
                'tb_product.namaProduct as namaProduct',
                'tb_product.kdSatuan as kdSatuan',
                'tb_keranjang.qty as qty',
                'tb_keranjang.harga as harga',
                'tb_keranjang.checkout as checkout',
                'tb_product.urlFoto as urlFoto'
            )
            ->where('tb_keranjang.checkout', '=', '1')
            ->whereBetween('tanggal', [$tgl1, $tgl2])
            ->where(function ($query) use ($sByusername, $sBynotrans) {
                $query->where($sByusername)
                    ->orWhere($sBynotrans);
            })
            ->get();

        $periode = 'Periode Laporan ' . $tgl1 . ' s/d ' . $tgl2;
        $pdf = PDF::loadview('admin.laporan.barangkeluar.report', ['penjualan' => $penjualan, 'periode' => $periode]);
        return $pdf->stream('my.pdf', array('Attachment' => 0));
    }
}
