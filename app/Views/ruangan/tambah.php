<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
    <div>
        <form action="<?= base_url('ruangan/store')?>" method="post">
            <div>
                <label for="">Nama Ruangan</label>
                <input type="text" name="nm_ruangan" class="form-control" required autofocus>
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