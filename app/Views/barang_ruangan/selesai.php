<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
    <div>
        <form action="<?= base_url('barang_pakai/proses/'.$br['id_barang_peruangan'].'')?>" method="post">
            <div>
                <label for="">Nama Barang</label>
                <input type="text" value="<?= $d_barang['nm_barang']?>"class="form-control" required aut autocomplete="off" readonly>
            </div>
            <div>
                <label for="">Ruangan</label>
                <input type="text" name="ruangan"  value="<?= $br['ruangan']?>" class="form-control" required  autocomplete="off" readonly>
            </div>
            <div>
                <label for="">Tanggal</label>
                <input type="date" name="tgl_selesai" value="<?= date('Y-m-d') ?>" class="form-control" required>
            </div>
            <div>
                <label for="">Jumlah</label>
                <input type="text" name="stok_selesai"  class="form-control" required autofocus autocomplete="off">
            </div>
            <br>
            <div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="reset" class="btn btn-danger">Reset</button>
                <button onclick="goBack()" class="btn btn-warning">Kembali</button>
            </div>
        </form>
    </div>
<script>
    function goBack() {
        window.history.back();
    }
</script>
<?= $this->endSection() ?>