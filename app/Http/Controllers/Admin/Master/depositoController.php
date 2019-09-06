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
        $kota = city();
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
}
