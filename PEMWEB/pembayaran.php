<?php
$id_pembelian = $_GET['id'];

$take = mysqli_query($koneksi,"SELECT * FROM pembayaran WHERE id_pembelian='$id_pembelian'");
$results =  mysqli_fetch_assoc($take);

?>

<pre>
    <!-- <?= print_r($row) ?> -->
</pre>

<div class="row">
    <div class="col-md-6">
        <form action="" method="post">
            <div class="form-group">
                <label for="nama">Nama Penyetor</label>
                <input type="text" name="nama_penyetor" class="form-control" readonly value="<?= $results['nama']; ?>">
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal Pembayaran</label>
                <input type="text" name="" class="form-control" readonly value="<?= $results['tanggal']; ?>">
            </div>
            <div class="form-group">
                <label for="nama">Bank Penyetor</label>
                <input type="text" name="nama_penyetor" class="form-control" readonly value="<?= $results['bank']; ?>">
            </div>
            <div class="form-group">
                <label for="nama">Jumlah Pembayaran</label>
                <input type="text" name="nama_penyetor" class="form-control" readonly value="<?= $results['jumlah']; ?>">
            </div>
        </form>
    </div>
    <div class="col-md-6">
        <img src="photo/buktibayar/<?= $results['foto'] ?>" alt="" srcset="" width="100%" height="auto">
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <form action="" method="post">
                <div class="form-group">
                    <label for="resi">No Resi</label>
                    <input type="text" name="resi" class="form-control">
                </div>
            <div class="form-group">
                <label for="status">Status Pembayaran</label>
                <select class="form-control" name="status">
                    <option value="">--PILIH STATUS PEMBAYARAN--</option>
                    <option value="Barang Dikirim">Barang Dikirim</option>
                    <option value="Lunas">Lunas</option>
                    <option value="Batal">Batal</option>
                    <option value="Proses Pengiriman">Proses Pengiriman</option>
                </select>
            </div>
            <button class="btn btn-success px-4 btn-block" name="kirim">
                Kirim
            </button>
        </form>
        <?php
            if (isset($_POST['kirim'])) {
                $resi = $_POST['resi'];
                $status = $_POST['status'];
                $ambil = mysqli_query($koneksi,"UPDATE pembelian SET resi_pengiriman='$resi', status_pembelian='$status' WHERE id_pembelian=$id_pembelian");
                echo "
                <script>
                    alert ('Data pemebelian sudah diperbaharui');
                    document.location.href= 'index.php?halaman=pembelian';
                </script>
            ";
            }
        ?>
    </div>
</div>