<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Master\productModel;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Master\satuanModel;
use App\Master\kategoriModel;
use Alert;

class productController extends Controller
{
    //
    public function index()
    {
        return view('admin.master.product.page');
    }

    public function showForm()
    {
        $satuan = $this->getDataSatuan();
        $kategori = $this->getDatakategori();
        return view('admin.master.product.form')->with(['satuan' => $satuan, 'kategori' => $kategori]);
    }

    public function store(Request $r)
    {
        $product = productModel::where('kdProduct', '=', $r->id)->firstOrFail();
        $satuan = $this->getDataSatuan();
        $kategori = $this->getDatakategori();
        return view('admin.master.product.update')->with(['satuan' => $satuan, 'kategori' => $kategori, 'product' => $product]);
    }


    private function getDataSatuan()
    {
        $satuan = satuanModel::query()
            ->select('kdSatuan', 'namaSatuan')
            ->get();

        return $satuan;
    }

    private function getDatakategori()
    {
        $kategori = kategoriModel::query()
            ->select('kdKategori', 'namaKategori')
            ->get();

        return $kategori;
    }

    //menampilkan data product
    public function getData()
    {
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
            )
            ->get();

        return DataTables::of($product)
            ->addIndexColumn()
            ->addColumn('action', function ($product) {
                return '<a class="btn-sm btn-warning" id="btn-edit" href="/admin/product/store?id=' . $product->kdProduct . '"><i class="fa fa-edit"></i></a>
                            <a class="btn-sm btn-danger" id="btn-delete" href="#" onclick="hapus(\'' . $product->kdProduct . '\',event)"><i class="fa fa-trash"></i></a>
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

    //validasi form input
    private function isValid(Request $r)
    {
        $messages = [];

        $rules = [
            'kdProduk' => 'required|max:25|unique:tb_product,kdProduct,' . $r->kdProduk . ',kdProduct',
            'namaProduk' => 'required|max:191',
            'hargaProduk' => 'required|numeric',
            'diskon' => 'required|numeric',
            'stok' => 'required|numeric',
            'deskripsi' => 'required',
        ];

        return Validator::make($r->all(), $rules, $messages);
    }

    //menambahkan data baru
    public function add(Request $r)
    {
        if ($this->isValid($r)->fails()) {
            $errors = $this->isValid($r)->errors();
            Alert::error('Gagal Menambahkan Data', 'Ooops');
            return redirect()->back()->withErrors($errors)->withInput();
        } else {
            if ($r->hasFile('gambar')) {
                $upFoto = $r->file('gambar');
                $namaFoto = $r->kdProduk . '.' . $upFoto->getClientOriginalExtension();
                $r->gambar->move(public_path('foto'), $namaFoto);
            } else {
                $namaFoto = '';
            }
            try {
                $product = new productModel;
                $product->kdProduct = $r->kdProduk;
                $product->namaProduct = $r->namaProduk;
                $product->kdKategori = $r->kategori;
                $product->kdSatuan = $r->satuan;
                $product->hargaJual = $r->hargaProduk;
                $product->diskon = $r->diskon;
                $product->qty = $r->stok;
                $product->deskripsi = $r->deskripsi;
                $product->promo = $r->promo;
                $product->urlFoto = $namaFoto;
                $product->save();
                Alert::success('Success', 'Berhasil Menambahkan Data');
                return redirect()->back()->with('sukses', $product->kdProduct);
            } catch (\Exception  $e) {
                $exData = explode('(', $e->getMessage());
                Alert::error('Gagal Merubah Data \n' . $exData[0], 'Ooops');
                return redirect()->back()->withInput();
            }
        }
    }

    //edit data
    public function edit(Request $r)
    {
        if ($this->isValid($r)->fails()) {
            $errors = $this->isValid($r)->errors();
            Alert::error('Gagal Merubah Data', 'Ooops');
            return redirect()->back()->withErrors($errors)->withInput();
        } else {
            try {
                $id = $r->oldkdProduk;
                $data = [
                    'kdProduct' => $r->kdProduk,
                    'namaProduct' => $r->namaProduk,
                    'kdKategori' => $r->kategori,
                    'kdSatuan' => $r->satuan,
                    'hargaJual' => $r->hargaProduk,
                    'diskon' => $r->diskon,
                    'qty' => $r->stok,
                    'deskripsi' => $r->deskripsi,
                    'promo' => $r->promo,
                ];

                if ($r->hasFile('gambar')) {
                    $upFoto = $r->file('gambar');
                    $namaFoto = $r->kdProduk . '.' . $upFoto->getClientOriginalExtension();
                    $r->gambar->move(public_path('foto'), $namaFoto);
                    $data = array_add($data, 'urlFoto', $namaFoto);
                }

                productModel::query()
                    ->where('kdProduct', '=', $id)
                    ->update($data);
                Alert::success('Success', 'Berhasil Merubah Data');
                return redirect('/admin/product');
            } catch (\Exception  $e) {
                $exData = explode('(', $e->getMessage());
                Alert::error('Gagal Merubah Data \n' . $exData[0], 'Ooops');
                return redirect()->back()->withInput();
            }
        }
    }
    //delete data
    public function delete(Request $r)
    {
        $id = $r->input('id');
        try {
            productModel::query()
                ->where('kdProduct', '=', $id)
                ->delete();;
            return response()->json([
                'sukses' => 'Berhasil Di hapus' . $id,
                'sqlResponse' => true,
            ]);
        } catch (\Exception  $e) {
            $exData = explode('(', $e->getMessage());
            return response()->json([
                'gagal' => 'Gagal Menghapus\n',
                'data' =>  $exData[0],
                'sqlResponse' => false,
            ]);
        }
    }
}
