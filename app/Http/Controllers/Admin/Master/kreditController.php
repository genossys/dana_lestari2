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
        $token = getToken();
        $kota = city($token);
        return view('umum.kredit')->with(['kota' => $kota]);
    }

    public function adminpage()
    {
        return view('admin.master.kredit.page');
    }
    public function Sukses()
    {
        return view('umum.kreditSukses')->with(['data' => 'Kredit']);
    }

    public function add(Request $r)
    {
        if ($r->pinjaman < 100000000) {
            # code...
            Alert::error('Oops', 'Maaf, Jumlah Pinjaman Anda Kurang dari Jumlah Minimal Pinjaman');
            return redirect()->back();
        } else {
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
                return redirect('/callbackkredit');
            } catch (\Exception $e) {
                $exData = explode('(', $e->getMessage());
                return redirect()->back();
            }
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
                $nohp = $kredit->telp;
                $text = 'Pengajuan Kredit Atas Nama ' . $kredit->nama . ' Telah Kami Konfirmasi dan Akan Segera kami Tindak Lanjuti. Terima Kasih Telah Mengajukan Kredit di BPR LESTARI JATENG';
                return '<a class="btn-sm btn-success" id="btn-edit" href="/admin/kredit/confirm?id=' . $kredit->id . '">Konfirmasi</a>
                 <a class="btn-sm btn-success" id="btn-detail" target="_blank" href="https://api.whatsapp.com/send?phone=' . $nohp . '&text=' . $text . '">Kirim Whatsapp</a>
                 ';
            })
            ->editColumn('pinjaman', function ($kredit) {
                return formatuang($kredit->pinjaman);
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
