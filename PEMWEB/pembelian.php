
<h1>DATA PEMBELIAN</h1>

<table class="table">
    <tr>
        <th>No</th>
        <th>Nama Pelanggan</th>
        <th>Tanggal</th>
        <th>Status Pembelian</th>
        <th>Total</th>
        <th>Aksi</th>
    </tr>
        <?php $i=1; ?>
        <?php $ambil=mysqli_query($koneksi,"SELECT * FROM pembelian INNER JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan");?>
        <?php while($row=mysqli_fetch_assoc($ambil)): ?>
    <tr>
        <td><?= $i; ?></td>
        <td><?= $row["nama_pelanggan"];?></td>
        <td><?= $row["tanggal_pembelian"];?></td>
        <td><?= $row["status_pembelian"];?></td>
        <td><?= $row["total_pembelian"];?></td>
        <td>
            <a href="index.php?halaman=detail&id=<?= $row['id_pembelian']; ?>" class="btn btn-info">DETAIL</a>

            <a href="index.php?halaman=pembayaran&id=<?= $row['id_pembelian']; ?>" class="btn btn-success">PEMBAYARAN</a>

        </td>
    </tr>
        <?php $i++; ?>
    <?php endwhile;?>
</table>