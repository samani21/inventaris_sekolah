<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
    <div>
        <form action="<?= base_url('barang_pakai/store/'.$d_barang['id'].'')?>" method="post">
            <div>
                <label for="">Nama Barang</label>
                <input type="text" value="<?= $d_barang['nm_barang']?>"class="form-control" required aut autocomplete="off" readonly>
            </div>
            <div>
                <label for="">Tanggal</label>
                <input type="date" name="tgl_pinjam" value="<?= date('Y-m-d') ?>" class="form-control" required>
            </div>
            <div>
                <label for="">Ruangan</label>
                <select name="ruangan" class="form-control" id="" required>
                    <option value="">-pilih</option>
                    <option value="Kelas I">Kelas I</option>
                    <option value="Kelas II">Kelas II</option>
                    <option value="Kelas III">Kelas III</option>
                    <option value="Kelas IV">Kelas IV</option>
                    <option value="Kelas V">Kelas V</option>
                    <option value="Kelas VI">Kelas VI</option>
                    <?php
                        foreach($ruangan as $ru){
                            ?>
                            <option value="<?= $ru['nm_ruangan'] ?>"><?= $ru['nm_ruangan'] ?></option>
                            <?php
                        }
                    ?>
                </select>
            </div>
            <div>
                <label for="">Jumlah</label>
                <input type="text" name="stok"  value="" class="form-control" required  autocomplete="off">
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