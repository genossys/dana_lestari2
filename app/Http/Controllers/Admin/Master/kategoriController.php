<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Master\kategoriModel;
use Illuminate\Support\Facades\Validator;
use Alert;

class kategoriController extends Controller
{
    //
    public function index()
    {
        return view('admin.master.kategori.page');
    }

    public function showForm()
    {
        return view('admin.master.kategori.form');
    }

    public function store(Request $r)
    {
        $kategori = kategoriModel::where('kdKategori', '=', $r->id)->firstOrFail();
        return view('admin.master.kategori.update')->with(['kategori' => $kategori]);
    }

    public function getData()
    {
        $kategori = kategoriModel::query()
            ->select('kdKategori', 'namaKategori')
            ->get();

        return DataTables::of($kategori)
            ->addIndexColumn()
            ->addColumn('action', function ($kategori) {
                return '<a class="btn-sm btn-warning" id="btn-edit" href="/admin/kategori/store?id=' . $kategori->kdKategori . '"><i class="fa fa-edit"></i></a>
                 <a class="btn-sm btn-danger" data-toggle="tooltip" title="Hapus Data" id="btn-delete" href="#" onclick="hapus(\'' . $kategori->kdKategori . '\',event)"><i class="fa fa-trash"></i></a>
                 ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    private function isValid(Request $r)
    {
        $messages = [];

        $rules = [
            'kdkategori' => 'required|max:10|unique:tb_kategori,kdKategori,' . $r->kdkategori . ',kdKategori',
            'namakategori' => 'required|max:255',
        ];

        return Validator::make($r->all(), $rules, $messages);
    }

    public function add(Request $r)
    {
        if ($this->isValid($r)->fails()) {
            $errors = $this->isValid($r)->errors();
            Alert::error('Gagal Menambahkan Data', 'Ooops');
            return redirect()->back()->withErrors($errors)->withInput();
        } else {
            try {
                $satuan = new kategoriModel();
                $satuan->kdKategori = $r->kdkategori;
                $satuan->namaKategori = $r->namakategori;
                $satuan->save();
                Alert::success('Success', 'Berhasil Menambahkan Data');
                return redirect()->back();
            } catch (\Exception  $e) {
                $exData = explode('(', $e->getMessage());
                Alert::error('Gagal Menambahkan Data \n' . $exData[0], 'Ooops');
                return redirect()->back()->withInput();
            }
        }
    }

    public function edit(Request $r)
    {
        if ($this->isValid($r)->fails()) {
            $errors = $this->isValid($r)->errors();
            Alert::error('Gagal Merubah Data', 'Ooops');
            return redirect()->back()->withErrors($errors)->withInput();
        } else {
            try {
                $id = $r->oldkdKategori;
                $data = [
                    'kdKategori' => $r->kdkategori,
                    'namaKategori' => $r->namakategori,
                ];

                kategoriModel::query()
                    ->where('kdkategori', '=', $id)
                    ->update($data);
                Alert::success('Success', 'Berhasil Merubah Data');
                return redirect('/admin/kategori');
            } catch (\Exception  $e) {
                $exData = explode('(', $e->getMessage());
                Alert::error('Gagal Merubah Data \n' . $exData[0], 'Ooops');
                return redirect()->back()->withInput();
            }
        }
    }

    public function delete(Request $r)
    {
        $id = $r->input('id');
        try {
            kategoriModel::query()
                ->where('kdkategori', '=', $id)
                ->delete();
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
