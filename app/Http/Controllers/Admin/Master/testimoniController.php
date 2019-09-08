<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Master\testimoniModel;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Alert;

class testimoniController extends Controller
{
    //
    public function index(){

        return view ('admin.master.testimoni.pagetestimoni');
    }

    public function getDataTestimoni()
    {
        $testimoni = testimoniModel::query()
            ->select('id','username', 'isi', 'status', 'created_at')
            ->get();

        return DataTables::of($testimoni)
            ->addIndexColumn()
            ->addColumn('action', function ($kategori) {
                return '<a class="btn-sm btn-danger" data-toggle="tooltip" title="Hapus Data" id="btn-delete" href="#" onclick="hapus(\'' . $kategori->id . '\',event)"><i class="fa fa-trash"></i></a>
                 ';
            })
            ->addColumn('status', function ($kategori) {
                if ($kategori->status == '0') {
                return '<a class="btn-sm btn-danger" data-toggle="tooltip" title="Hapus Data" id="btn-delete" href="/admin/testimoni/updatetestimoni/'. $kategori->id.'/'. $kategori->status.'">Tidak Terlihat</a>
                 ';
                }
                return '<a class="btn-sm btn-success" data-toggle="tooltip" title="Hapus Data" id="btn-delete" href="/admin/testimoni/updatetestimoni/' . $kategori->id . '/' . $kategori->status . '">Terlihat</a>
                 ';
                
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    private function isValid(Request $r)
    {
        $messages = [];

        $rules = [
            'username' => 'required',
            'isi' => 'required|max:255',
        ];

        return Validator::make($r->all(), $rules, $messages);
    }
    public function addtestimoni(Request $r){
        if ($this->isValid($r)->fails()) {
            $errors = $this->isValid($r)->errors();
            Alert::error('Gagal Menambahkan Data', 'Ooops');
            return redirect()->back()->withErrors($errors)->withInput();
        } else {
            try {
                $testimoni = new testimoniModel();
                $testimoni->username = $r->username;
                $testimoni->isi = $r->isi;
                $testimoni->save();
                Alert::success('Success', 'Berhasil Menambahkan Testimoni');
                return redirect()->back();
            } catch (\Exception  $e) {
                $exData = explode('(', $e->getMessage());
                Alert::error('Gagal Merubah Data \n' . $exData[0], 'Ooops');
                return redirect()->back()->withInput();
            }
        }
    }

    public function edittestimoni($id, $status){
        try {

            if ($status == '0') {
                $data = [
                    'status' => '1',
                ];
            }else{
                $data = [
                    'status' => '0',
                ];
            }
            testimoniModel::query()
                ->where('id', '=', $id)
                ->update($data);
            Alert::success('Success', 'Berhasil Merubah Data');
            return redirect('/admin/testimoni');
        } catch (\Exception  $e) {
            $exData = explode('(', $e->getMessage());
            Alert::error('Gagal Merubah Data \n' . $exData[0], 'Ooops');
            return redirect()->back()->withInput();
        }
    }

    public function delete(Request $r)
    {
        $id = $r->input('id');
        try {
            testimoniModel::query()
                ->where('id', '=', $id)
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
