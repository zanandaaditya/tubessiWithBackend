<h2>DATA PELANGGAN</h2>
<form class="form-inline sm-form form-sm mt-0 ml-2 mb-4 d-flex justify-content-center" method="POST">
    <input class="form-control form-control-sm ml-3 w-10" type="text" placeholder="Cari Pengguna" aria-label="Search" name="keyword" id="keyword" autofocus>
        <button type="submit" class="btn btn-sm" name="cari" id="tombol-cari">
        <i class="fas fa-search"></i>
        </button>
</form>
<table class="table">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Aksi</th>
    </tr>
    <?php
        if(isset($_POST['cari'])){
            $cari = $_POST['keyword'];
            $data = mysqli_query($koneksi,"SELECT * FROM user where nama_user like '%".$cari."%'");
        }else{
            $data = mysqli_query($koneksi,"SELECT * FROM user");
        }
        ?>
    <?php $i=1;?>
    <?php while($row=mysqli_fetch_assoc($data)):?>
    <tr>
        <td><?= $i; ?></td>
        <td><?= $row["nama_user"] ?></td>
        <td>
            <a href="index.php?halaman=hapusUser&id=<?= $row['id_user']; ?>" class="btn btn-danger">HAPUS</a>
        </td>
    </tr>
    <?php $i++; ?>
    <?php endwhile; ?>
</table>