<h2>DATA PELANGGAN</h2>

<table class="table">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Telepon</th>
        <th>Aksi</th>
    </tr>
    <?php $i=1;?>
    <?php $ambil=mysqli_query($koneksi,"SELECT * FROM pelanggan");?>
    <?php while($row=mysqli_fetch_assoc($ambil)):?>
    <tr>
        <td><?= $i; ?></td>
        <td><?= $row["nama_pelanggan"] ?></td>
        <td><?= $row["email_pelanggan"] ?></td>
        <td><?= $row["nomor_pelanggan"] ?></td>
        <td>
            <a href="" class="btn btn-danger">HAPUS</a>
        </td>
    </tr>
    <?php $i++; ?>
    <?php endwhile; ?>
</table>