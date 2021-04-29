<h2>DETAIL PEMBELIAN</h2>
<?php
$cari=$_GET['id'];

$ambil=mysqli_query($koneksi,"SELECT * FROM pembelian INNER JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian=$cari");

$row= mysqli_fetch_assoc($ambil);
?>

<!-- <pre><?php print_r($row); ?></pre> -->


<section class="section-info">
    <div class="row">
        <div class="col-md-4">
            <h5>Pelanggan</h5>
                <div class="form-group">
                    <label for="nama">Nama Pelanggan</label>
                    <input type="text" name="nama_penyetor" class="form-control" readonly value="<?= $row['nama_pelanggan'] ?>">
                </div>
                <div class="form-group">
                    <label for="tanggal">Nomor Pelanggan</label>
                    <input type="text" name="" class="form-control" readonly value="<?= $row['nomor_pelanggan']; ?>" >
                </div>
                <div class="form-group">
                    <label for="nama">Email Pelanggan</label>
                    <input type="text" name="nama_penyetor" class="form-control" readonly value=<?= $row['email_pelanggan']; ?> >
                </div>
                
        </div>
        <div class="col-md-4">
            <h5>Pembelian</h5>
                <div class="form-group">
                    <label for="nama">Tanggal Pembelian</label>
                    <input type="text" name="nama_penyetor" class="form-control" readonly value="<?= $row['tanggal_pembelian']; ?>">
                </div>
                <div class="form-group">
                    <label for="tanggal">Total Belanja</label>
                    <input type="text" name="" class="form-control" readonly value="<?= number_format($subtotal=$row['total_pembelian']-$row['tarif_ongkir']); ?>">
                </div>
                <div class="form-group">
                    <label for="tanggal">Total Pembelian</label>
                    <input type="text" name="" class="form-control" readonly value="<?= number_format($row['total_pembelian']); ?>">
                </div>
                <div class="form-group">
                    <label for="nama">Status Pembelian</label>
                    <input type="text" name="nama_penyetor" class="form-control" readonly value=<?= $row['status_pembelian']; ?> >
                </div>
                <div class="form-group">
                    <label for="nama">Resi Pembelian</label>
                    <input type="text" name="nama_penyetor" class="form-control" readonly value=<?= $row['resi_pengiriman']; ?> >
                </div>
        </div>
        <div class="col-md-4">
            <h5>Pengiriman</h5>
                <div class="form-group">
                    <label for="nama">Nama Provinsi</label>
                    <input type="text" name="nama_penyetor" class="form-control" readonly value="<?= $row['nama_provinsi']; ?>">
                </div>
                <div class="form-group">
                    <label for="tanggal">Nama Kota/Kabupaten</label>
                    <input type="text" name="" class="form-control" readonly value="<?= $row['nama_kota']; ?>">
                </div>
                <div class="form-group">
                    <label for="nama">Alamat 1</label>
                    <input type="text" name="nama_penyetor" class="form-control" readonly value="<?= $row['alamat1']; ?>">
                </div>
                <div class="form-group">
                    <label for="tanggal">Alamat 2</label>
                    <input type="text" name="" class="form-control" readonly value="<?= $row['alamat2']; ?>">
                </div>
                <div class="form-group">
                    <label for="nama">Tarif Ongkos Kirim</label>
                    <input type="text" name="nama_penyetor" class="form-control" readonly value="<?= $row['tarif_ongkir']; ?>">
                </div>
        </div>
    </div>
</section>

<table class="table">
    <tr>
        <th>No</th>
        <th>Nama Produk</th>
        <th>Harga</th>
        <th>Jumlah</th>
        <th>Subtotal</th>
    </tr>
    <?php $i=1;?>
    <?php $ambil=mysqli_query($koneksi,"SELECT * FROM pembelian_produk INNER JOIN produk ON pembelian_produk.id_produk=produk.id_produk WHERE pembelian_produk.id_pembelian=$cari"); ?>
    <?php while($row=mysqli_fetch_assoc($ambil)): ?>
    <tr>
        <td><?= $i; ?></td>
        <td><?= $row['nama_produk']; ?></td>
        <td><?= $row['harga_produk']; ?></td>
        <td><?= $row['jumlah'];?></td>
        <td>
            <?= $row['harga_produk']*$row['jumlah']; ?>
        </td>
    </tr>
    <?php $i++; ?>
    <?php endwhile;?>
</table>

