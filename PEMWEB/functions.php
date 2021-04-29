<?php
$koneksi = mysqli_connect("localhost","root","","db_tubessi");
// $koneksi = mysqli_connect("sql310.epizy.com","epiz_27636863","eAB0Ci78ai28T","epiz_27636863_db_tubessi");
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
function tambah($data){
    global $koneksi;

        $nama_produk = htmlspecialchars($data['nama_produk']);
        $harga_produk = htmlspecialchars($data['harga_produk']);
        $berat_produk = htmlspecialchars($data['berat_produk']);
        $deskripsi_produk = htmlspecialchars($data['deskripsi_produk']);

        $gambar_produk = upload();
        if (!$gambar_produk) {
            return false;
        }

        $ambil ="INSERT INTO produk VALUES
                        ('','$nama_produk','$harga_produk','$berat_produk','$gambar_produk','$deskripsi_produk')";

        mysqli_query($koneksi,$ambil);

        return mysqli_affected_rows($koneksi);
}


function upload(){
    $namaFile = $_FILES['gambar_produk']['name'];
    $ukuranFile = $_FILES['gambar_produk']['size'];
    $error = $_FILES['gambar_produk']['error'];
    $lokasi = $_FILES['gambar_produk']['tmp_name'];

    //cek apakah tidak ada gambar diuplad

    if($error === 4){
        echo "
            <script>
                alert ('Pilih gambar');
                document.location.href= 'index.php?halaman=produk';
            </script>
        ";
        return false;
    }

    //cek gambar / bukan

    $ekstensiGambarValid = ['jpg','jpeg','png'];
    //explode = memecah sebuah string menjadi array
    $ekstensiGambar = explode('.',$namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
        echo "
            <script>
                alert ('Coba masukkan gambar dengan format JPG, JPEG, dan PNG');
                document.location.href= 'index.php?halaman=produk';
            </script>
        ";
        return false;
    }

    //cek ukuran gambar
    if($ukuranFile > 1000000){
        echo "
            <script>
                alert ('Ukuran gambar terlalu besar');
                document.location.href= 'index.php?halaman=produk';
            </script>
        ";
        return false;
    }

    //lolos pengecekan
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($lokasi, 'photo/' . $namaFileBaru);

    return $namaFileBaru;
}

function ubah($data){
    global $koneksi;
    //fungsi htmlspecialchars agar di field ketika user mengetik script html maka tidak akan dijalankan
    $id = $data["id"];
    $nama_produk = htmlspecialchars($data['nama_produk']);
    $harga_produk = htmlspecialchars($data['harga_produk']);
    $berat_produk = htmlspecialchars($data['berat_produk']);
    $deskripsi_produk = htmlspecialchars($data['deskripsi_produk']);
    $gambarLama = htmlspecialchars($data["gambarLama"]);
    //cek apakah gamarb baru atau tydack
    if($_FILES['gambar_produk']['error'] === 4){
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }


    $query = "UPDATE produk SET
                nama_produk='$nama_produk',
                harga_produk='$harga_produk',
                berat_produk='$berat_produk',
                gambar_produk='$gambar',
                deskripsi_produk='$deskripsi_produk'
                WHERE id_produk=$id;
                    ";

    mysqli_query($koneksi,$query);

    return mysqli_affected_rows($koneksi);
}


function registrasi($data){
    global $koneksi;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($koneksi,$data["password"]);
    $password2 = mysqli_real_escape_string($koneksi,$data["password2"]);

    //cek username tersedia atau tidak
    $result = mysqli_query($koneksi, "SELECT nama_user FROM user WHERE nama_user='$username' ");
    if (mysqli_fetch_assoc($result)) {
        echo"
            <script>
                alert('Username sudah digunakan');
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
                alert('Yang Anda inputkan bukan angka atau Huruf');
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
    mysqli_query($koneksi, "INSERT INTO user VALUES('', '$username','$password')");

    return mysqli_affected_rows($koneksi);
}

function cari($keyword){
    $query = "SELECT * FROM produk
                WHERE
                nama_produk LIKE '%$keyword%' OR
                harga_produk LIKE '%$keyword%'
                ";
    return query($query);
}
?>