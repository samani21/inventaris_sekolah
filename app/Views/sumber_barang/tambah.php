<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
    <div>
        <form action="<?= base_url('sumber_barang/store')?>" method="post">
            <div>
                <label for="">Nama Barang</label>
                <select name="id_barang" class="form-control" required autofocus>
                    <option value="">--pilih barang</option>
                <?php
                        foreach($d_barang as $b){
                            ?>
                                <option value="<?= $b['id']?>"><?= $b['kode_barang']?> : <?= $b['nm_barang']?> (<?= $b['merek']?>)</option>
                            <?php
                        }
                    ?>
                </select>
            </div>
            <div>
                <label for="">Tanggal</label>
                <input type="date" name="tgl" value="<?= date('Y-m-d') ?>" class="form-control" required autofocus>
            </div>
            <div>
                <label for="">Jumlah</label>
                <input type="text" name="total" class="form-control" required autofocus>
            </div>
            <div>
                <label for="">Status</label>
                <input type="text" name="status" class="form-control" required autofocus>
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