<?php

namespace App\Http\Controllers\Admin\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transaksi\belanjaModel;
use App\Transaksi\KeranjangModel;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use PDF;

class LaporanPenjualanController extends Controller
{
    //
    public function index()
    {
        return view('admin.laporan.penjualan.page');
    }

    public function search(Request $r)
    {
        $sBynotrans = [['tb_belanja.noTrans', 'LIKE', '%' . $r->index . '%']];
        $sByusername = [['username', 'LIKE', '%' . $r->index . '%']];
        $tgl1 = $r->tgl1;
        $tgl2 = $r->tgl2;
        if ($r->tgl1 == '') {
            $tgl1 = Carbon::now()->format('Y-m-d');
        }

        if ($r->tgl2 == '') {
            $tgl2 = Carbon::now()->format('Y-m-d');
        }

        $penjualan = belanjaModel::query()
            ->join('tb_pembayaran', 'tb_belanja.noTrans', '=', 'tb_pembayaran.noTrans')
            ->select('tb_belanja.noTrans', 'username', 'tb_belanja.tanggal', 'subTotal', 'ongkir', 'confirmed', 'tb_belanja.status', 'tb_pembayaran.bank')
            ->selectRaw('(subTotal + ongkir) as total')
            ->where('confirmed', '=', '1')
            ->where('tb_belanja.status', '=', 'Terima')
            ->whereBetween('tb_belanja.tanggal', [$tgl1, $tgl2])
            ->where(function ($query) use ($sByusername, $sBynotrans) {
                $query->where($sByusername)
                    ->orWhere($sBynotrans);
            })
            ->get();
        return DataTables::of($penjualan)
            ->addIndexColumn()
            ->addColumn('detail', function ($pembayaran) {
                return '<a class="btn-sm btn-success" id="btn-detail" href="/admin/laporan/penjualan/detail?noTrans=' . $pembayaran->noTrans . '" target="_blank">Lihat Detail</a>';
            })
            ->addColumn('total', function ($penjualan) {
                return formatuang($penjualan->total);
            })
            ->addColumn('subTotal', function ($penjualan) {
                return formatuang($penjualan->subTotal);
            })
            ->addColumn('ongkir', function ($penjualan) {
                return formatuang($penjualan->ongkir);
            })
            ->rawColumns(['total', 'subTotal', 'ongkir', 'detail'])
            ->make(true);
    }

    public function print(Request $r)
    {
        $sBynotrans = [['tb_belanja.noTrans', 'LIKE', '%' . $r->index . '%']];
        $sByusername = [['username', 'LIKE', '%' . $r->index . '%']];
        $tgl1 = $r->tgl1;
        $tgl2 = $r->tgl2;
        if ($r->tgl1 == '') {
            $tgl1 = Carbon::now()->format('Y-m-d');
        }

        if ($r->tgl2 == '') {
            $tgl2 = Carbon::now()->format('Y-m-d');
        }

        $penjualan = belanjaModel::query()
            ->join('tb_pembayaran', 'tb_belanja.noTrans', '=', 'tb_pembayaran.noTrans')
            ->select('tb_belanja.noTrans', 'username', 'tb_belanja.tanggal', 'subTotal', 'ongkir', 'confirmed', 'tb_belanja.status', 'tb_pembayaran.bank')
            ->selectRaw('(subTotal + ongkir) as total')
            ->where('confirmed', '=', '1')
            ->where('tb_belanja.status', '=', 'Terima')
            ->whereBetween('tb_belanja.tanggal', [$tgl1, $tgl2])
            ->where(function ($query) use ($sByusername, $sBynotrans) {
                $query->where($sByusername)
                    ->orWhere($sBynotrans);
            })
            ->get();
        $total = $penjualan->sum('total');
        $periode = 'Periode Laporan ' . $tgl1 . ' s/d ' . $tgl2;
        $pdf = PDF::loadview('admin.laporan.penjualan.report', ['penjualan' => $penjualan, 'periode' => $periode, 'total' => $total]);
        return $pdf->stream('my.pdf', array('Attachment' => 0));
    }

    public function detail(Request $r)
    {
        $trans = KeranjangModel::query()
            ->join('tb_belanja', 'tb_keranjang.noTrans', '=', 'tb_belanja.noTrans')
            ->join('tb_pembayaran', 'tb_keranjang.noTrans', '=', 'tb_pembayaran.noTrans')
            ->join('tb_product', 'tb_keranjang.kdProduct', '=', 'tb_product.kdProduct')
            ->select(
                'tb_keranjang.noTrans',
                'tb_keranjang.tanggal',
                'tb_keranjang.kdProduct',
                'tb_keranjang.qty',
                'tb_keranjang.harga',
                'tb_keranjang.checkout',
                'tb_belanja.username as username',
                'tb_product.namaProduct as namaProduct',
                'tb_belanja.status as statusbayar',
                'tb_belanja.alamat as alamat',
                'tb_belanja.ongkir as ongkir',
                'tb_pembayaran.urlBukti as urlBukti',
                'tb_pembayaran.status as statuskonfirmasi'
            )
            ->selectRaw('(tb_keranjang.qty * tb_keranjang.harga) as subtotal')
            ->where('tb_keranjang.noTrans', '=', $r->noTrans)
            ->get();
        $subtotal = $trans->sum('subtotal');
        $ongkir = $trans[0]->ongkir;
        $total = $subtotal + $ongkir;
        $status = $trans[0]->statuskonfirmasi;

        return view('admin.laporan.penjualan.detail')->with(['transaksi' => $trans, 'subtotal' => $subtotal, 'ongkir' => $ongkir, 'total' => $total, 'status' => $status]);
    }

    public function invoice(Request $r)
    {
        $trans = KeranjangModel::query()
            ->join('tb_belanja', 'tb_keranjang.noTrans', '=', 'tb_belanja.noTrans')
            ->join('tb_pembayaran', 'tb_keranjang.noTrans', '=', 'tb_pembayaran.noTrans')
            ->join('tb_product', 'tb_keranjang.kdProduct', '=', 'tb_product.kdProduct')
            ->select(
                'tb_keranjang.noTrans',
                'tb_keranjang.tanggal',
                'tb_keranjang.kdProduct',
                'tb_keranjang.qty',
                'tb_keranjang.harga',
                'tb_keranjang.checkout',
                'tb_belanja.username as username',
                'tb_product.namaProduct as namaProduct',
                'tb_belanja.status as statusbayar',
                'tb_belanja.alamat as alamat',
                'tb_belanja.ongkir as ongkir',
                'tb_pembayaran.urlBukti as urlBukti',
                'tb_pembayaran.status as statuskonfirmasi'
            )
            ->selectRaw('(tb_keranjang.qty * tb_keranjang.harga) as subtotal')
            ->where('tb_keranjang.noTrans', '=', $r->noTrans)
            ->get();
        $subtotal = $trans->sum('subtotal');
        $ongkir = $trans[0]->ongkir;
        $total = $subtotal + $ongkir;
        $status = $trans[0]->statuskonfirmasi;

        $pdf = PDF::loadView('admin.laporan.penjualan.nota', ['transaksi' => $trans, 'subtotal' => $subtotal, 'ongkir' => $ongkir, 'total' => $total, 'status' => $status]);
        $pdf->setPaper('A4', 'potrait');
        return $pdf->stream('nota');
    }
}
