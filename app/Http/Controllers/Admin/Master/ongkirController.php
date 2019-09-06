<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Master\ongkirModel;

class ongkirController extends Controller
{
    //
    public function getOngkir(){
        $ongkir = ongkirModel::query()
            ->select('kota', 'biaya')
            ->get();
        
            return response()->json($ongkir);
    }

    public function getBiayaOngkir($kota){
        $biaya = ongkirModel::where('kota','=',$kota)->get();
        // return response()->json(['biaya' => formatuang($biaya[0]->biaya)]);
        return response()->json(['biaya' => $biaya[0]->biaya]);
    }

    public function hargas(Request $r){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=445&destination=".$r->tujuan."&weight=1000&courier=jne",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: c5c2fde4061ad9a9ce3742de90db7974"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $hasil = '';
            if ($err) {
            $hasil =  "cURL Error #:" . $err;
            } else {
                $data = json_decode($response, true);
                $hasil = $data['rajaongkir']['results'][0]['costs'];
                // $hasil = $data['rajaongkir']['results'][0]['costs'][0]['cost'][0]['value'];
            }

            $hasil1 = sizeof($hasil);
            if ($hasil1 > 0) {
                return  response()->json(['harga' => $hasil[0]['cost'][0]['value'], 'tujuan' => $r->tujuan]);
            }else{
                return  response()->json(['harga' => 0, 'tujuan' => $r->tujuan]);
            }
            
        
        
        // return  $tujuan;
        //  echo $asal;
    }
    public function ongkir(){
        $res = city();
        return view('main.ongkir')->with(['res' => $res]);
        // return view('main.ongkir');
    }


}
