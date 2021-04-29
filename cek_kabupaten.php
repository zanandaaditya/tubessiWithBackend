<?php

$provinsi_id = $_GET['prov_id'];

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "http://api.rajaongkir.com/starter/city?province=$provinsi_id",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "key: 3c71bb81ca4b9ad04795db59659ab752"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  //echo $response;
}
echo "<option value=''>--Pilih Kota/Kabupaten--</option>";
$data = json_decode($response, true);
for ($i=0; $i < count($data['rajaongkir']['results']); $i++) {
    echo "<option
    id_distrik='".$data['rajaongkir']['results'][$i]['city_id']."'
    nama_provinsi='".$data['rajaongkir']['results'][$i]['province']."'
    nama_distrik='".$data['rajaongkir']['results'][$i]['city_name']."'
    tipe_distrik='".$data['rajaongkir']['results'][$i]['type']."'
    kode_distrik='".$data['rajaongkir']['results'][$i]['postal_code']."'
    >".$data['rajaongkir']['results'][$i]['city_name']."</option>";
}

?>