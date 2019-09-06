<?php

function city()
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://x.rajaapi.com/MeP7c5nekWuKjiuReQ9vZn3YV3VcEAWhDm6vYCmcdUQyJASnIOi9ahGskW/m/wilayah/kabupaten?idpropinsi=33",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    $data = json_decode($response, true);
    return $data['data'];
}
