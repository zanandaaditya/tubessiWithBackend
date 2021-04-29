<?php

//simulasi GIF
//usleep(500000);
require '../functions.php';
$keyword = $_GET["keyword"];

$query = "SELECT * FROM user
                WHERE
            nama_produl LIKE '%$keyword%' OR
            berat_produk LIKE '%$keyword%' OR
            harga_produk LIKE '%$keyword%'
            ";




?>
<table class="table table-responsive">
    <thead>
        <tr>
            <td>No</td>
            <td>Nama</td>
            <td>Harga</td>
            <td>Berat</td>
            <td>Foto</td>
            <td>Deskripsi</td>
            <td>Aksi</td>
        </tr>
    </thead>
    <tbody>
        <?php $i=1; ?>
        <?php $ambil=mysqli_query($koneksi,$query);?>
        <?php while($row=mysqli_fetch_assoc($ambil)):?>

        <tr>
            <td><?= $i; ?></td>
            <td><?= $row["nama_produk"] ?></td>
            <td><?= $row["harga_produk"] ?></td>
            <td><?= $row["berat_produk"] ?></td>
            <td><img src="photo/<?= $row["gambar_produk"] ?>" alt="" width="100"></td>
            <td><?= $row["deskripsi_produk"]?></td>
            <td>
                <a href="index.php?halaman=hapusProduk&id=<?= $row['id_produk']; ?>" name="hapusProduk" class="btn btn-danger">HAPUS</a>
                <a href="index.php?halaman=ubahProduk&id=<?= $row['id_produk']; ?>" name="ubahProduk"  class="btn btn-warning">UBAH</a>
            </td>
        </tr>
        <?php $i++;?>
        <?php endwhile; ?>
    </tbody>
</table>
          <tr>
            <th>ID</th>
            <th>Picture</th>
            <th>Name</th>
            <th>NIM</th>
            <th>Jurusan</th>
            <th>Email</th>
            <th>Aksi</th>
          </tr>

          <?php $i=1; ?>
          <?php foreach ($mahasiswa as $row) : ?>
            <tr>
            <td class="align-middle">
              <?= $i; ?>
            </td>
            <td>
              <img class="rounded-circle" src="img/<?= $row["gambar"]; ?>" alt="" srcset="">
            </td>
            <td class="align-middle">
              <?= $row["nama"]; ?>
            </td>
            <td class="align-middle">
              <?= $row["nim"]; ?>
            </td>
            <td class="align-middle">
              <?= $row["jurusan"]; ?>
            </td>
            <td class="align-middle">
              <?= $row["email"]; ?>
            </td>
            <td class="align-middle">
              <a href="ubah.php?id=<?= $row["id"];?>">
                <button type="button" class="btn btn-sm btn-warning" style="color: white;"><i
                  class="fas fa-pen"></i></button></a>
              <a href="hapus.php?id=<?= $row["id"];?>" onclick="return confirm('Apakah Anda yakin menghapusnya?')";>
                <button type="button" class="btn btn-sm" style="background-color: #EAEAEF; color: white;"><i
                  class="fas fa-minus-circle"></i></button></a>
            </td>
          </tr>
          <?php $i++; ?>
          <?php endforeach; ?>

        </table>