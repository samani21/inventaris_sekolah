<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
<form action="<?= base_url('barang_masuk/cetak_pemerintah') ?>" method="post">
    <div class="row">
        <div class="col-2">
            <label for="">Cetak berdasarkan</label>
        </div>
        <div class="col-2">
            <input type="date" class="form-control" name="dari">
        </div>
        <div class="col-2">
            <input type="date" class="form-control" name="sampai">
        </div>
        <div class="col-4">
            <button class="btn btn-primary">Cetak</button>
        </div>
    </div>
</form>
<br>
<table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>Nama Barang</th>
                <th>Tanggal</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $no = 1;
                foreach($d_bmp as $b){
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $b['nm_barang']?></td>
                            <td><?= date('d-m-Y', strtotime($b['tgl']))?></td>
                            <td><?= $b['total']?></td>
                            <td><?= $hasil_rupiah = "Rp " . number_format($b['harga'],2,',','.');?></td>
                            <td><?= $b['status']?></td>
                        </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>  
<?= $this->endSection() ?>
