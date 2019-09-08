<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Master\satuanModel;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;

class satuanController extends Controller
{
    //
    public function index(){
        return view('admin.master.datasatuan');
    }

    public function getDataSatuan(){
        $satuan = satuanModel::query()
            ->select('kdSatuan', 'namaSatuan')
            ->get();

        return DataTables::of($satuan)
            ->addIndexColumn()
            ->addColumn('action', function ($satuan) {
                return '<a class="btn-sm btn-warning" id="btn-edit" href="#" onclick="showEditSatuan(\'' . $satuan->kdSatuan . '\', \'' . $satuan->namaSatuan . '\', event)" ><i class="fa fa-edit"></i></a>
                            <a class="btn-sm btn-danger" id="btn-delete" href="#" onclick="hapus(\'' . $satuan->kdSatuan . '\', event)" ><i class="fa fa-trash"></i></a>
                        ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    private function isValid(Request $r)
    {
        $messages = [
            'required'  => 'Field :attribute Tidak Boleh Kosong',
            'max'       => 'Filed :attribute Maksimal :max',
        ];

        $rules = [
            'kdSatuan' => 'required|max:10',
            'namaSatuan' => 'required|max:255',
        ];

        return Validator::make($r->all(), $rules, $messages);
    }

    public function insert(Request $r){
        if ($this->isValid($r)->fails()) {
            return response()->json([
                'valid' => false,
                'errors' => $this->isValid($r)->errors()->all()
            ]);
        }else {
            try {
                $satuan = new satuanModel();
                $satuan->kdSatuan = $r->kdSatuan;
                $satuan->namaSatuan = $r->namaSatuan;
                $satuan->save();
                return response()->json([
                    'valid' => true,
                    'sqlResponse' => true,
                    'data' => $satuan
                ]);
            } catch (\Throwable $th) {
                return response()->json([
                    'valid' => true,
                    'sqlResponse' => false,
                    'data' => $th
                ]);
            }
        }
        
    }

    public function edit(Request $r)
    {
        if ($this->isValid($r)->fails()) {
            return response()->json([
                'valid' => false,
                'errors' => $this->isValid($r)->errors()->all()
            ]);
        } else {
            try {
                $id = $r->oldkdSatuan;
                $data = [
                    'kdSatuan' => $r->kdSatuan,
                    'namaSatuan' => $r->namaSatuan,
                ];
                satuanModel::query()
                    ->where('kdSatuan', '=', $id)
                    ->update($data);
                return response()
                    ->json([
                        'sqlResponse' => true,
                        'sukses' => $data,
                        'valid' => true,
                    ]);
            } catch (\Throwable $th) {
                return response()->json([
                    'sqlResponse' => false,
                    'data' => $th,
                    'valid' => true,
                ]);
            }
        }
    }

    public function delete(Request $r)
    {
        $id = $r->input('id');
        satuanModel::query()
            ->where('kdSatuan', '=', $id)
            ->delete();;
        return response()->json([
            'sukses' => 'Berhasil Di hapus' . $id,
            'sqlResponse' => true,
        ]);
    }
}
