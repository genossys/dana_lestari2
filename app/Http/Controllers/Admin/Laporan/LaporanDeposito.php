<?php

namespace App\Http\Controllers\Admin\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Master\depositoModel;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use PDF;

class LaporanDeposito extends Controller
{
    //
    public function index(){
        return view('admin.laporan.Deposito.page');
    }

    public function search (Request $r){
        $sBynotrans = [['nama', 'LIKE', '%' . $r->index . '%']];
        $sByusername = [['domisili', 'LIKE', '%' . $r->index . '%']];
        $tgl1 = $r->tgl1;
        $tgl2 = $r->tgl2;
        if ($r->tgl1 == '') {
            $tgl1 = Carbon::now()->format('Y-m-d');
        }

        if ($r->tgl2 == '') {
            $tgl2 = Carbon::now()->format('Y-m-d');
        }

        $deposito = depositoModel::query()
            ->select('id', 'nama', 'telp', 'email', 'domisili', 'confirmed')
            ->whereBetween('created_at', [$tgl1 .' 00:00:00', $tgl2 .' 23:59:59'])
            ->where('confirmed', '=', '1')
            ->where(function ($query) use ($sByusername, $sBynotrans) {
                $query->where($sByusername)
                    ->orWhere($sBynotrans);
            })
            ->get();
        
            return DataTables::of($deposito)
            ->addIndexColumn()
            ->make(true);
    }

    public function print(Request $r) {
        $sBynotrans = [['nama', 'LIKE', '%' . $r->index . '%']];
        $sByusername = [['domisili', 'LIKE', '%' . $r->index . '%']];
        $tgl1 = $r->tgl1;
        $tgl2 = $r->tgl2;
        if ($r->tgl1 == '') {
            $tgl1 = Carbon::now()->format('Y-m-d');
        }

        if ($r->tgl2 == '') {
            $tgl2 = Carbon::now()->format('Y-m-d');
        }

        $deposito = depositoModel::query()
        ->select('id', 'nama', 'telp', 'email', 'domisili', 'confirmed')
        ->whereBetween('created_at', [$tgl1 .' 00:00:00', $tgl2 .' 23:59:59'])
        ->where('confirmed', '=', '1')
        ->where(function ($query) use ($sByusername, $sBynotrans) {
            $query->where($sByusername)
                ->orWhere($sBynotrans);
        })
        ->get();
        
            $periode = 'Periode Laporan ' . $tgl1 . ' s/d ' . $tgl2;
            $pdf = PDF::loadview('admin.laporan.Deposito.report', ['deposito' => $deposito, 'periode' => $periode]);
            return $pdf->stream('my.pdf', array('Attachment' => 0));
    }
}
