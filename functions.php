<?php

$koneksi = mysqli_connect("localhost","root","","db_tubessi");
// $koneksi = mysqli_connect("sql307.epizy.com","epiz_27302184","o5buL10tF8","epiz_27302184_tubessi");
// $koneksi = mysqli_connect("sql202.epizy.com","epiz_27355163","WYHalRNWwPXv","epiz_27355163_db_tubessi");
function query($query){
    global $koneksi;
    $result = mysqli_query($koneksi,$query);
    $row = [];
    while ( $rows = mysqli_fetch_assoc($result) ){
        $row = $rows;
    }
    return $row;
}
function registrasi($data){
    global $koneksi;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($koneksi,$data["password"]);
    $password2 = mysqli_real_escape_string($koneksi,$data["password2"]);
    $email = stripslashes($data["email"]);
    $notel = $data['notelp'];

    //cek username tersedia atau tidak
    $resultu = mysqli_query($koneksi, "SELECT nama_pelanggan FROM pelanggan WHERE nama_pelanggan='$username' ");
    if (mysqli_fetch_assoc($resultu)) {
        echo"
            <script>
                alert('Username sudah digunakan');
            </script>
        ";
        return false;
    }

    $resulte = mysqli_query($koneksi, "SELECT email_pelanggan FROM pelanggan WHERE email_pelanggan='$email' ");
    if (mysqli_fetch_assoc($resulte)) {
        echo"
            <script>
                alert('Email sudah digunakan');
            </script>
        ";
        return false;
    }

    if(empty($username) ){
        echo"
            <script>
                alert('Masukkan Angka atau Huruf');
            </script>
        ";
        return false;
    }

    if(empty($password)){
        echo"
            <script>
                alert('Masukkan Angka atau Huruf');
            </script>
        ";
        return false;
    }

    if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        echo"
            <script>
                alert('Masukkan Angka atau Huruf');
            </script>
        ";
        return false;
    }

    // cek konfirmasi kedua pass
    if ($password !== $password2) {
        echo"
            <script>
                alert('Password tidak sesuai');
            </script>
        ";
        return false;
    }

    //eksripsi pass
    //password_hash untuk eksripsi pass dengan mengacak
    //jangan menggunakan MD5 karena akan bisa dibobol dengan google
    $password = password_hash($password, PASSWORD_DEFAULT);


    //tambahkan user ke db
    mysqli_query($koneksi, "INSERT INTO pelanggan VALUES('', '$email','$password','$username','$notel')");

    return mysqli_affected_rows($koneksi);
}


// function tambah($data){
//     global $koneksi;
//         $id_pem = $data['idpem'];
//         $nama_penyetor = htmlspecialchars($data['nama_penyetor']);
//         $nama_bank = htmlspecialchars($data['namaBank']);
//         $total_produk = htmlspecialchars($data['total_pembayaran']);
//         $tanggal_bukti = date("Y-m-d");

//         $gambar_produk = upload();
//         if (!$gambar_produk) {
//             return false;
//         }

//         $ambil =("INSERT INTO pembayaran VALUES
//                         ('','$id_pem','$nama_penyetor','$nama_bank','$total_produk','$tanggal_bukti','$gambar_produk')");
//         // $ambil = ("UPDATE pembelian SET status_pembelian='Sudah melakukan pembayaran' WHERE id_pembelian=$id_pem");
//         mysqli_query($koneksi,$ambil);

//         return mysqli_affected_rows($koneksi);
// }

// function upload(){
//     $namaFile = $_FILES['bukti_transaksi']['name'];
//     $ukuranFile = $_FILES['bukti_transaksi']['size'];
//     $error = $_FILES['bukti_transaksi']['error'];
//     $lokasi = $_FILES['bukti_transaksi']['tmp_name'];

//     //cek apakah tidak ada gambar diuplad

//     if($error === 4){
//         echo "
//             <script>
//                 alert ('Pilih gambar');
//             </script>
//         ";
//         return false;
//     }

//     //cek gambar / bukan

//     $ekstensiGambarValid = ['jpg','jpeg','png'];
//     //explode = memecah sebuah string menjadi array
//     $ekstensiGambar = explode('.',$namaFile);
//     $ekstensiGambar = strtolower(end($ekstensiGambar));
//     if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
//         echo "
//             <script>
//                 alert ('Coba masukkan gambar dengan format JPG, JPEG, dan PNG');
//             </script>
//         ";
//         return false;
//     }

//     //cek ukuran gambar
//     if($ukuranFile > 1000000){
//         echo "
//             <script>
//                 alert ('Ukuran gambar terlalu besar');
//             </script>
//         ";
//         return false;
//     }

//     //lolos pengecekan
//     $namaFileBaru = uniqid();
//     $namaFileBaru .= '.';
//     $namaFileBaru .= $ekstensiGambar;

//     move_uploaded_file($lokasi, 'PEMWEB/photo/buktibayar/' . $namaFileBaru);

//     return $namaFileBaru;
// }
?>