<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
    <div>
        <form action="<?= base_url('kondisi_barang/store/'.$dt['id_barang_status'].'')?>" method="post">
            <div>
                <label for="">Nama Barang</label>
                <input type="text" name="id_barang" list="barang"  value="<?= $dt_barang['nm_barang']?>"class="form-control" required aut autocomplete="off" readonly>
                <datalist id="barang">
                    <?php
                        foreach($d_barang as $b){
                            ?>
                                <option value="<?php
                                    if($b['id'] < 10){
                                        echo "000".$b['id'];
                                    }else if($b['id'] < 100){
                                        echo "00".$b['id'];
                                    }
                                    else if($b['id'] < 1000){
                                        echo "0".$b['id'];
                                    }else if($b['id'] < 1000){
                                        echo $b['id'];
                                    }
                                ?>, <?= $b['nm_barang']?>"></option>
                            <?php
                        }
                    ?>
                </datalist>
            </div>
            <div>
                <label for="">Tanggal</label>
                <input type="date" name="tgl_rusak" value="<?= $dt['tgl_rusak'] ?>" class="form-control" required readonly>
            </div>
            <div>
                <label for="">Jumlah Rusak</label>
                <input type="text"  value="<?= $dt['stok'] ?>" class="form-control" required readonly>
            </div>
            <div>
                <label for="">Keterangan</label>
                <textarea class="form-control" name="keterangan" id="floatingTextarea2" style="height: 100px" readonly><?= $dt['keterangan'] ?></textarea>
            </div>
            <div>
                <label for="">Jumlah Baik</label>
                <input type="text" name="stok_baik" value="<?= $dt['stok'] ?>" class="form-control" required autofocus>
            </div>
            <div>
                <label for="">Tanggal</label>
                <input type="date" name="tgl_baik" value="<?= date('Y-m-d') ?>" class="form-control" required>
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