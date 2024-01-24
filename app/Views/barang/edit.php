<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
    <div>
        <form action="<?= base_url('barang/update/'.$dt['id'].'')?>" method="post">
        <div>
                <label for="">Kode Barang</label>
                <input type="text" name="kode_barang" value="<?= $dt['kode_barang'] ?>" class="form-control" required autofocus>
            </div>
            <div>
                <label for="">Nama Barang</label>
                <input type="text" name="nm_barang" value="<?= $dt['nm_barang'] ?>" class="form-control" required autofocus>
            </div>
            <div>
                <label for="">Satuan</label>
                <select name="satuan" class="form-control" id="" required>
                    <option value="<?= $dt['satuan'] ?>"><?= $dt['satuan'] ?></option>
                    <option value="Unit">Unit</option>
                    <option value="Lusin">Lusin</option>
                    <option value="Liter">Liter</option>
                </select>
            </div>
            <div>
                <label for="">Merek Barang</label>
                <input type="text" name="merek" value="<?= $dt['merek'] ?>" class="form-control" required autofocus>
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