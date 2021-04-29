<?php
session_start();
$koneksi = mysqli_connect("localhost","root","","db_tubessi");
// $koneksi = mysqli_connect("sql310.epizy.com","epiz_27636863","eAB0Ci78ai28T","epiz_27636863_db_tubessi");
if (!isset($_SESSION["pelanggan"])) {
   header("Location: login.php");
   exit;
}
echo "<pre>";
print_r($_SESSION['keranjang']);
print_r($_SESSION['pelanggan']);
echo "</pre>";

if (isset($_POST['checkout'])) {
   $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
   $id_ongkir = $_POST['id_ongkir'];
   $tanggal_pembelian = date("Y-m-d");

   $ongkirku = mysqli_query($koneksi,"SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
   $rows = mysqli_fetch_assoc($ongkirku);
   $nama_kota = $rows['nam_kota'];
   $tarif = $rows['tarif'];
   $total_pembelian = $totalbelanja + $tarif;

   //simpan data
   $ambil = mysqli_query($koneksi,"INSERT INTO pembelian (id_pembelian, id_pelanggan,id_ongkir, tanggal_pembelian, total_pembelian, nama_kota, tarif_ongkir) VALUES
   ('','$id_pelanggan','$id_ongkir','$tanggal_pembelian','$total_pembelian','$nama_kota','$tarif')
   ");

   //ambil id_pembelian
   $id_pembelian_baru = $koneksi->insert_id;

   foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) {
     //duplikat produk
     $ambil_data = mysqli_query($koneksi,"SELECT * FROM produk WHERE id_produk='$id_produk'");
     $pecah_data=mysqli_fetch_assoc($ambil_data);
     $nama = $pecah_data['nama_produk'];
     $harga = $pecah_data['harga_produk'];
     $berat = $pecah_data['berat_produk'];
     $subberat = $pecah_data['berat_produk']*$jumlah;
     $subharga = $pecah_data['harga_produk']*$jumlah;

     $ambil_id = mysqli_query($koneksi,"INSERT INTO pembelian_produk VALUES
                 ('','$id_pembelian_baru','$id_produk','$jumlah','$nama','$harga','$berat','$subberat','$subharga') ");
   }

   //jika sudah bayar kosongkan keranjang
   unset($_SESSION['keranjang']);

   //view ke halaman checkout, untuk melakukan pembayaran
   echo "<script>alert('Pembelian sukses');
         location='nota.php?id=$id_pembelian_baru';
         </script>";
 }

//  ================================
//Get Data Kabupaten
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "http://api.rajaongkir.com/starter/city",
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

// echo "<label>Kota Asal</label><br>";
// echo "<select name='asal' id='asal'>";
// echo "<option>Pilih Kota Asal</option>";
   $data = json_decode($response, true);
   // for ($i=0; $i < count($data['rajaongkir']['results']); $i++) {
   //     echo "<option value='".$data['rajaongkir']['results'][$i]['city_id']."'>".$data['rajaongkir']['results'][$i]['city_name']."</option>";
   // }
echo "</select><br><br><br>";
//Get Data Kabupaten


//-----------------------------------------------------------------------------

//Get Data Provinsi
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
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

// echo "Provinsi Tujuan<br>";
// echo "<select name='provinsi' id='provinsi'>";
// echo "<option>Pilih Provinsi Tujuan</option>";
// $data = json_decode($response, true);
// for ($i=0; $i < count($data['rajaongkir']['results']); $i++) {
//    echo "<option value='".$data['rajaongkir']['results'][$i]['province_id']."'>".$data['rajaongkir']['results'][$i]['province']."</option>";
// }
$data = json_decode($response, true);
$dataprovinsi = $data['rajaongkir']['results'];
echo "</select><br><br>";
//Get Data Provinsi
?>
<pre>
  <?php print_r($_SESSION['pelanggan']); ?>
  <?php print_r($_SESSION['keranjang']); ?>
</pre>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>HITZ COFFEE</title>
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
   <!-- Font Awesome -->
   <link rel="stylesheet" href="style/font/all.css">
   <!-- Style Manual -->
   <link rel="stylesheet" href="style/style.css">
   <!-- Font Import -->
   <style>
      @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800&family=Playfair+Display:wght@400;700&display=swap');
   </style>
</head>
<body>
<!-- Navbar -->
<section class="section-jumbotron">
   <div class="container">
      <nav class="row navbar navbar-expand-lg navbar-light bg-transparent">
         <a href="index.html" class="navbar-brand text-center mx-auto">
            <img src="assets/Logo.png" alt="Logo Nomads">
         </a>
         <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navSM">
            <span class="navbar-toggler-icon"></span>
         </button>
      </nav>
   </div>
   <!-- Akhir Navbar -->
</section>


<!-- Breadcrubms -->
<section class="section-bred">
   <div class="container">
      <div class="row">
         <div class="col">
            <nav aria-label="breadcrumb" class="bg-transparent">
               <ol class="breadcrumb bg-transparent">
                  <li class="breadcrumb-item"><a href="katalog.html">Keranjang</a></li>
                  <li class="breadcrumb-item active">Checkout</li>
               </ol>
            </nav>
         </div>
      </div>
   </div>
</section>
<!-- Akhir Bread -->

<!-- Awal Keranjang -->
<section class="section-cart">
   <div class="container">
      <div class="row">
         <div class="col">
            <div class="col mt-5 text-center">
               <h4>Detail Pemesanan</h4>
               <p>Sesuai yang Anda masukan ya ngab</p>
            </div>
         </div>
      </div>
      <div class="attendee">
         <table class="table table-responsive-sm text-center">
            <thead>
               <tr>
                  <td>
                     No
                  </td>
                  <td>
                     Picture
                  </td>
                  <td>
                     Nama Produk
                  </td>
                  <td>
                     Jumlah
                  </td>
                  <td>
                     Berat
                  </td>
                  <td>
                     Sub Harga
                  </td>
                  <td>
                     Total Harga
                  </td>
               </tr>
            </thead>
            <tbody>
            <?php $no=1;?>
            <?php $totalbelanja = 0?>
            <?php $beratbelanja = 0?>
<?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
<?php $query = mysqli_query($koneksi,"SELECT * FROM produk WHERE id_produk = '$id_produk'");
   $rows = mysqli_fetch_assoc($query);
   $subharga = $rows['harga_produk'] * $jumlah;
   $subberat = $rows['berat_produk'] * $jumlah;
?>
               <tr>
                  <td>
                     <p class="align-items-center"><?= $no; ?></p>
                  </td>
                  <td>
                     <img src="PEMWEB/photo/<?= $rows['gambar_produk'] ?>" height="60">
                  </td>
                  <td class="align-middle">
                     <?= $rows['nama_produk'] ?>
                  </td>
                  <td class="align-middle">
                     <?= $jumlah ?>
                  </td>
                  <td class="align-middle">
                     <?= $rows['berat_produk']; ?>
                  </td>
                  <td class="align-middle">
                     IDR <?= number_format($rows["harga_produk"]); ?>
                  </td>
                  <td class="align-middle">
                     IDR <?= number_format($subharga); ?>
                  </td>
               </tr>
<?php $no++; ?>
<?php $beratbelanja += $subberat?>
<?php $totalbelanja +=$subharga?>
<?php endforeach; ?>
            </tbody>
            <tfoot>
               <tr class="align-middle">
                  <th colspan="6">Total Belanja</th>
                  <th>IDR <?= number_format($totalbelanja) ?></th>
               </tr>
            </tfoot>
         </table>
      </div>
   </div>
</section>
<!-- Akhir Keranjang -->
<div class="container" style="margin-top: 50px;">
   <hr />
</div>

<form method="POST">
<section class="store-cart">
   <div class="container">
      <div class="row" data-aos="fade-up" data-aos-delay="150">
         <div class="col-12">
         </div>
         <div class="col mt-5 text-center">
               <h4>Detail Pemesanan</h4>
               <p>Sesuai yang Anda masukan ya ngab</p>
         </div>
      </div>
      <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
      <div class="col-md-4">
            <div class="form-group">
               <label for="namaPenerima">Nama Penerima</label>
               <input type="text" readonly value="<?= $_SESSION['pelanggan']['nama_pelanggan'] ?>" class="form-control">
            </div>
         </div>
         <div class="col-md-4">
            <div class="form-group">
               <label for="noPenerima">Nomor Penerima</label>
               <input type="text" readonly value="<?= $_SESSION['pelanggan']['nomor_pelanggan'] ?>" class="form-control">
            </div>
         </div>
         <div class="col-md-4">
            <div class="form-group">
               <label for="EPenerima">Email Penerima</label>
               <input type="text" readonly value="<?= $_SESSION['pelanggan']['email_pelanggan'] ?>" class="form-control">
            </div>
         </div>
         <div class="col-md-6">
            <div class="form-group">
            <label for="addressOne">Alamat 1</label>
            <input
               type="text"
               class="form-control"
               id="addressOne"
               aria-describedby="emailHelp"
               name="addressOne"
               placeholder="Jalan Kampung Durian Runtuh"
            />
            </div>
         </div>
         <div class="col-md-6">
            <div class="form-group">
            <label for="addressTwo">Alamat 2</label>
            <input
               type="text"
               class="form-control"
               id="addressTwo"
               aria-describedby="emailHelp"
               name="addressTwo"
               placeholder="Jalan Rusuh Hyung"
            />
            </div>
         </div>
         <div class="col-md-4">
            <div class="form-group">
               <?php

               ?>
            <label for="provinsi">Provinsi</label>
            <select id="provinsi" class="form-control" name="provinsi">
               <option value="">--PILIH PROVINSI</option>
               <?php
                  foreach ($dataprovinsi as $key => $tiap_provinsi) {
                     echo "<option value='".$tiap_provinsi["province_id"]."' id_provinsi='".$tiap_provinsi["province_id"]." '>";
                     echo $tiap_provinsi["province"];
                     echo "</option>";
               }
               ?>
            </select>
            </div>
         </div>
         <div class="col-md-4">
            <div class="form-group">
            <label for="kabupaten">City</label>
            <select name="kabupaten" id="kabupaten" class="form-control">
            </select>
            </div>
         </div>
         <div class="col-md-4">
            <div class="form-group">
            <label for="nama_ekspedisi">Ekspedisi</label>
            <select name="nama_ekspedisi" id="kurir" class="form-control">
            </select>
            </div>
         </div>
         <div class="col-md-6">
         <div class="form-group">
            <label for="paket">Paket Pengiriman</label>
            <select name="paket" id="paket" class="form-control">
            </select>
            </div>
         </div>
         <div class="col-md-6">
            <div class="form-group">
            <label for="mobile">No Telepon</label>
            <input
               type="text"
               class="form-control"
               id="mobile"
               name="mobile"
               placeholder="+628 2020 11111"
            />
            </div>
         </div>
         <input type="text" name="totalberat" value="<?= $beratbelanja ?>">
      </div>
   </div>
</section>
<div class="container" style="margin-top: 50px;">
   <hr />
</div>
<!-- Pembayaran -->
<section class="section-cart">
   <div class="container">
      <div class="row">
         <div class="col mt-5 text-center">
            <h4>Detail Pemesanan</h4>
            <p>Sesuai yang Anda masukan ya ngab</p>
         </div>
      </div>
      <div class="row mb-5 d-flex justify-content-center align-items-center pembayaran">
         <div class="col-12 col-md-3 mb-5 mt-2">
            <a href="" class="btn btn-success px-4 btn-block" name="checkout">
            Checkout Sekarang
            </a>
         </div>
      </div>
   </div>
</section>
</form>
<!-- <?php

   $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
   var_dump($id_pelanggan);
   $tanggal_pembelian = date("Y-m-d");

   $nama_kota = $data['rajaongkir']['results'][$i]['city_id'];
   var_dump($nama_kota);
          $tarif = $tiap_paket["cost"]["0"]["value"];
   var_dump($tarif);
          $total_pembelian = $totalbelanja + $tarif;
   var_dump($total_pembelian);
          //simpan data
          $ambil = mysqli_query($koneksi,"INSERT INTO pembelian (id_pembelian, id_pelanggan, tanggal_pembeliam, total_pembelian, nama_kota, tarif_ongkir) VALUES
          ('','$id_pelanggan','$tanggal_pembelian','$total_pembelian','$nama_kota','$tarif')
          ");

          //ambil id_pembelian
          $id_pembelian_baru = $koneksi->insert_id;

          foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) {
            //duplikat produk
            $ambil_data = mysqli_query($koneksi,"SELECT * FROM produk WHERE id_produk='$id_produk'");
            $pecah_data=mysqli_fetch_assoc($ambil_data);
            $nama = $pecah_data['nama_produk'];
            $harga = $pecah_data['harga_produk'];
            $berat = $pecah_data['berat_produk'];
            $subberat = $pecah_data['berat_produk']*$jumlah;
            $subharga = $pecah_data['harga_produk']*$jumlah;

            $ambil_id = mysqli_query($koneksi,"INSERT INTO pembelian_produk VALUES
                        ('','$id_pembelian_baru','$id_produk','$jumlah','$nama','$harga','$berat','$subberat','$subharga') ");
          }

          //jika sudah bayar kosongkan keranjang
          unset($_SESSION['keranjang']);

          //view ke halaman checkout, untuk melakukan pembayaran
         //  echo "<script>alert('Pembelian sukses');
         //        location='nota.php?id=$id_pembelian_baru';
         //        </script>";

?> -->
<!-- Akhir Pembayaran -->

<!-- Footer -->
<footer class="border-top p-5">
   <div class="container">
      <div class="row justify-content-between">
         <div class="col-1">
            <a href="">
            <img src="assets/Logo.png">
            </a>
         </div>
         <div class="col-4 text-right">
            <a href="">
               <i class="fab fa-facebook fa-2x"></i>
            </a>
            <a href="">
               <i class="fab fa-twitter fa-2x"></i>
            </a>
            <a href="">
               <i class="fab fa-instagram fa-2x"></i>
            </a>
         </div>
      </div>
      <div class="row mt-3 justify-content-between">
         <div class="col-5">
            <p>All Rights Reserved by HITZ COFFEE Copyright 2020.</p>
         </div>
         <div class="col-6">
            <nav class="nav justify-content-end text-uppercase">
            <a class="nav-link active" href="#">Jobs</a>
            <a class="nav-link" href="#">Developer</a>
            <a class="nav-link" href="#">Terms</a>
            <a class="nav-link pr-0" href="#">Privacy Policy</a>
            </nav>
         </div>
      </div>
   </div>
</footer>
<!-- Akhir Footer -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- <script src="js/jquery.min.js"></script> -->
   <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
   <script src="js/all.js"></script>

   <script>
      $(document).ready(function(){
		$('#provinsi').change(function(){

			//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
			var prov = $('#provinsi').val();

      		$.ajax({
            	type : 'GET',
           		url : 'http://localhost/kuliah/Tubes%20Sistem%20Informasi/cek_kabupaten.php',
            	data :  'prov_id=' + prov,
					success: function (data) {

					//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
					$("#kabupaten").html(data);
				}
          	});
		});

      $.ajax({
            type:'POST',
            url : 'dataekspedisi.php',
            success:function(hasil_ekspedisi)
            {
               $("#kurir").html(hasil_ekspedisi);
               console.log(hasil_ekspedisi);
            }
         });
         $("select[name=nama_ekspedisi]").change(function(){
            //mendpatkan data ongkos kirim

            //mendapatkan ejspedisi
            var ekspedisi_terpilih = $("select[name=nama_ekspedisi").val();
            // alert (ekspedisi_terpilih);
            //mendapatkan id distrik yang dipilih pembeli
            var distrik_terpilih = $('#kabupaten').val();
            // alert(distrik_terpilih);
            //mendaaptkan total berat
            var total_berat = $("input[name=totalberat").val();
            // alert(total_berat);
            $.ajax({
               type:'GET',
               url:'datapaket.php',
               data:'ekspedisi='+ekspedisi_terpilih+'&distrik='+distrik_terpilih+'&berat='+total_berat,
               success:function(hasil_paket){
                  console.log(hasil_paket);
                  $("#paket").html(hasil_paket);
               }
            })
         })
         $("#kabupaten").change(function(){
            var prov = $("option:selected").attr(nama_provinsi="nama_provinsi");
            alert(prov);
         })
	});
   </script>
</body>
</html>