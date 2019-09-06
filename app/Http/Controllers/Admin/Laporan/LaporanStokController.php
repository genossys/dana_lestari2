<?php

namespace App\Http\Controllers\Admin\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Master\productModel;
use App\Master\kategoriModel;
use PDF;

class LaporanStokController extends Controller
{
    //
    public function index()
    {
        $kategori = kategoriModel::query()
            ->select('kdKategori', 'namaKategori')
            ->get();
        return view('admin.laporan.stok.page')->with('kategori', $kategori);
    }

    public function search(Request $r)
    {
        $sBykategori = [['tb_product.kdKategori', 'LIKE', '%' . $r->kategori . '%']];
        $sBykode = [['tb_product.kdProduct', 'LIKE', '%' . $r->index . '%']];
        $sBynama = [['tb_product.namaProduct', 'LIKE', '%' . $r->index . '%']];
        $sBydeskripsi = [['tb_product.deskripsi', 'LIKE', '%' . $r->index . '%']];
        $product = productModel::query()
            ->join('tb_kategori', 'tb_product.kdKategori', '=', 'tb_kategori.kdKategori')
            ->join('tb_satuan', 'tb_product.kdSatuan', '=', 'tb_satuan.kdSatuan')
            ->select(
                'tb_product.kdProduct as kdProduct',
                'tb_product.namaProduct as namaProduct',
                'tb_product.kdKategori as kdKategori',
                'tb_kategori.namaKategori as namaKategori',
                'tb_product.kdSatuan as kdSatuan',
                'tb_satuan.namaSatuan as namaSatuan',
                'tb_product.hargaJual as hargaJual',
                'tb_product.diskon as diskon',
                'tb_product.qty as qty',
                'tb_product.deskripsi as deskripsi',
                'tb_product.promo as promo',
                'tb_product.urlFoto as urlFoto'
            )->where($sBykategori)
            ->where(function ($query) use ($sBykode, $sBynama, $sBydeskripsi) {
                $query->where($sBykode)
                    ->orWhere($sBynama)
                    ->orWhere($sBydeskripsi);
            })
            ->get();

        return DataTables::of($product)
            ->addIndexColumn()
            ->addColumn('action', function ($product) {
                return '
                            <a class="btn-sm btn-info details-control" id="btn-detail" href="#"><i class="fa fa-folder-open"></i></a>
                        ';
            })
            ->addColumn('hargaJual', function ($product) {
                return formatuang($product->hargaJual);
            })
            ->addColumn('diskon', function ($product) {
                return formatuang($product->diskon);
            })
            ->addColumn('promo', function ($product) {
                if ($product->promo == 'Y') {
                    return 'Ya';
                } else {
                    return 'Tidak';
                }
            })
            ->rawColumns(['action', 'hargaJual', 'diskon', 'promo'])
            ->make(true);
    }

    public function print(Request $r)
    {
        $kategori = $r->kategori;
        $index   = $r->index;
        $sBykategori = [['tb_product.kdKategori', 'LIKE', '%' . $r->kategori . '%']];
        $sBykode = [['tb_product.kdProduct', 'LIKE', '%' . $r->index . '%']];
        $sBynama = [['tb_product.namaProduct', 'LIKE', '%' . $r->index . '%']];
        $sBydeskripsi = [['tb_product.deskripsi', 'LIKE', '%' . $r->index . '%']];
        $product = productModel::query()
            ->join('tb_kategori', 'tb_product.kdKategori', '=', 'tb_kategori.kdKategori')
            ->join('tb_satuan', 'tb_product.kdSatuan', '=', 'tb_satuan.kdSatuan')
            ->select(
                'tb_product.kdProduct as kdProduct',
                'tb_product.namaProduct as namaProduct',
                'tb_product.kdKategori as kdKategori',
                'tb_kategori.namaKategori as namaKategori',
                'tb_product.kdSatuan as kdSatuan',
                'tb_satuan.namaSatuan as namaSatuan',
                'tb_product.hargaJual as hargaJual',
                'tb_product.diskon as diskon',
                'tb_product.qty as qty',
                'tb_product.deskripsi as deskripsi',
                'tb_product.promo as promo',
                'tb_product.urlFoto as urlFoto'
            )->where($sBykategori)
            ->where(function ($query) use ($sBykode, $sBynama, $sBydeskripsi) {
                $query->where($sBykode)
                    ->orWhere($sBynama)
                    ->orWhere($sBydeskripsi);
            })
            ->get();
        $pdf = PDF::loadview('admin.laporan.stok.report', ['product' => $product]);
        return $pdf->stream('my.pdf', array('Attachment' => 0));
    }
}
