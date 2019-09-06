<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Master\kreditModel;
use Yajra\DataTables\DataTables;
use Alert;

class kreditController extends Controller
{
    //
    public function index()
    {
        $kota = city();
        return view('umum.kredit')->with(['kota' => $kota]);
    }

    public function adminpage()
    {
        return view('admin.master.kredit.page');
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
            $exData = explode('(', $e->getMessage());
            return redirect()->back();
        }
    }

    public function getData()
    {
        $kredit = kreditModel::query()
            ->select('id', 'nama', 'telp', 'email', 'domisili', 'pekerjaan', 'penghasilan', 'jaminan', 'pinjaman', 'confirmed')
            ->where('confirmed', '=', '0')
            ->get();

        return DataTables::of($kredit)
            ->addIndexColumn()
            ->addColumn('action', function ($kredit) {
                return '<a class="btn-sm btn-success" id="btn-edit" href="/admin/kredit/confirm?id=' . $kredit->id . '">Konfirmasi</a>
                 <a class="btn-sm btn-success" data-toggle="tooltip" title="Hapus Data" id="btn-delete" href="#">Cetak Form</a>
                 ';
            })
            ->editColumn('pinjaman', function ($kredit) {
                if ($kredit->pinjaman > 5000000000) {
                    return 'Di Atas 5 Milyar';
                }
                return formatuang($kredit->pinjaman);
            })
            ->editColumn('penghasilan', function ($kredit) {
                return formatuang($kredit->penghasilan);
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

            kreditModel::query()
                ->where('id', '=', $id)
                ->update($data);
            Alert::success('Success', 'Berhasil Merubah Data');
            return redirect('/admin/kredit');
        } catch (\Exception $e) {
            $exData = explode('(', $e->getMessage());
            Alert::error('Gagal Merubah Data \n' . $exData[0], 'Ooops');
            return redirect()->back()->withInput();
        }
    }
}
