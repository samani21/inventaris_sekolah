<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
    <div>
        <?php
            if($br['stok_selesai'] == $br['stok']){
                ?>
                    <form action="<?= base_url('barang_pakai/update1/'.$br['id_barang_peruangan'].'')?>" method="post">
            <div>
                <label for="">Nama Barang</label>
                <input type="text" value="<?= $d_barang['nm_barang']?>"class="form-control" required aut autocomplete="off" readonly>
            </div>
            <div>
                <label for="">Tanggal Pinjam</label>
                <input type="date" name="tgl_pinjam" value="<?= $br['tgl_pinjam'] ?>" class="form-control" required readonly>
            </div>
            <div>
                <label for="">Tanggal Selesai</label>
                <input type="date" name="tgl_pinjam" value="<?= $br['tgl_selesai'] ?>" class="form-control" required>
            </div>
            <div>
                <label for="">Ruangan</label>
                <input type="text" name="ruangan"  value="<?= $br['ruangan'] ?>" class="form-control" required readonly autocomplete="off">
            </div>
            <div>
                <label for="">Jumlah Pijam</label>
                <input type="number" name="stok"  value="<?= $br['stok'] ?>" class="form-control" required  autocomplete="off" readonly>
            </div>
            <div>
                <label for="">Jumlah Selesai</label>
                <input type="number" name="stok_selesai"  value="<?= $br['stok_selesai'] ?>" class="form-control" required  autocomplete="off">
            </div>
            <br>
            <div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="reset" class="btn btn-danger">Reset</button>
                <button onclick="goBack()" class="btn btn-warning">Kembali</button>
            </div>
        </form>
                <?php
            }else{
                ?>
                    <form action="<?= base_url('barang_pakai/update/'.$br['id_barang_peruangan'].'')?>" method="post">
            <div>
                <label for="">Nama Barang</label>
                <input type="text" value="<?= $d_barang['nm_barang']?>"class="form-control" required aut autocomplete="off" readonly>
            </div>
            <div>
                <label for="">Tanggal</label>
                <input type="date" name="tgl_pinjam" value="<?= $br['tgl_pinjam'] ?>" class="form-control" required>
            </div>
            <div>
                <label for="">Ruangan</label>
                <input type="text" name="ruangan"  value="<?= $br['ruangan'] ?>" class="form-control" required  autocomplete="off">
            </div>
            <div>
                <label for="">Jumlah</label>
                <input type="number" name="stok"  value="<?= $br['stok'] ?>" class="form-control" required  autocomplete="off">
            </div>
            <br>
            <div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="reset" class="btn btn-danger">Reset</button>
                <button onclick="goBack()" class="btn btn-warning">Kembali</button>
            </div>
        </form>
                <?php
            }
        ?>
    </div>
<script>
    function goBack() {
        window.history.back();
    }
</script>
<?= $this->endSection() ?>