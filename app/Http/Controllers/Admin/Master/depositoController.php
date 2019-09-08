<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Master\depositoModel;

class depositoController extends Controller
{
    //
    public function index()
    {
        $token = getToken();
        $kota = city($token);
        return view('umum.deposito')->with(['kota' => $kota]);
    }
    public function add(Request $r)
    {
        try {
            $deposito = new depositoModel();
            $deposito->nama = $r->nama;
            $deposito->telp = $r->telp;
            $deposito->email = $r->email;
            $deposito->domisili = $r->domisili;
            $deposito->confirmed = '0';
            $deposito->save();
            return redirect('/');
        } catch (\Exception $e) {
            $exData = explode('(', $e->getMessage());
            return redirect()->back();
        }
    }
    public function adminpage()
    {
        return view('admin.master.deposito.page');
    }
    public function getData()
    {
        $deposito = depositoModel::query()
            ->select('id', 'nama', 'telp', 'email', 'domisili', 'confirmed')
            ->where('confirmed', '=', '0')
            ->get();

        return DataTables::of($deposito)
            ->addIndexColumn()
            ->addColumn('action', function ($deposito) {
                return '<a class="btn-sm btn-success" id="btn-edit" href="/admin/deposito/confirm?id=' . $deposito->id . '">Konfirmasi</a>
                 <a class="btn-sm btn-success" data-toggle="tooltip" title="Hapus Data" id="btn-delete" href="#">Cetak Form</a>
                 ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function confirm(Request $r)
    {
        try {
            $id = $r->id;
            $data = [
                'confirmed' => '1',
            ];

            depositoModel::query()
                ->where('id', '=', $id)
                ->update($data);
            Alert::success('Success', 'Berhasil Merubah Data');
            return redirect('/admin/deposito');
        } catch (\Exception $e) {
            $exData = explode('(', $e->getMessage());
            Alert::error('Gagal Merubah Data \n' . $exData[0], 'Ooops');
            return redirect()->back()->withInput();
        }
    }
}
