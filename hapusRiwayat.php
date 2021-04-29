<?php

$cari=$_GET['id'];

$koneksi = mysqli_connect("localhost","root","","db_tubessi");
// $koneksi = mysqli_connect("sql307.epizy.com","epiz_27302184","o5buL10tF8","epiz_27302184_tubessi");
$hapus = mysqli_query($koneksi,"DELETE FROM pembelian WHERE id_pembelian=$cari");

// $row = mysqli_fetch_assoc($hapus);


if ($hapus==true) {
    echo "
            <script>
                alert ('Data belanja berhasil di batalkan');
                document.location.href= 'riwayat.php';
            </script>
        ";
} else {
    // echo "
    //         <script>
    //             alert ('Data belanja gagal di hapus');
    //             document.location.href= 'riwayat.php';
    //         </script>
    //     ";
}
?>