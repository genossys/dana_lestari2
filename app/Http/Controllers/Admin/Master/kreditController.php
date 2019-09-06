<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Master\kreditModel;

class kreditController extends Controller
{
    //
    public function index()
    {
        $kota = city();
        return view('umum.kredit')->with(['kota' => $kota]);
    }

    public function add(Request $r)
    {
        try {
            //code...
            $kredit = new kreditModel();
            $kredit->nama = $r->nama;
            $kredit->telp = $r->telp;
            $kredit->email = $r->email;
            $kredit->domisili = $r->domisili;
            $kredit->pekerjaan = $r->pekerjaan;
            $kredit->penghasilan = $r->penghasilan;
            $kredit->jaminan = $r->jaminan;
            $kredit->pinjaman = $r->pinjaman;
            $kredit->confirmed = '0';
            $kredit->save();
            return redirect('/');
        } catch (\Exception $e) {
            //throw $th;
            $exData = explode('(', $e->getMessage());
            return redirect()->back();
        }
    }
}
