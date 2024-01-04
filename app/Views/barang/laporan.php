<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
<form action="<?= base_url('barang/cetak') ?>" method="post">
    <div class="row">
        <div class="col-2">
            <label for="">Cetak berdasarkan</label>
        </div>
        <div class="col-4">
            <input type="text" class="form-control" name="cari">
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
                <th>Jumlah</th>
                <th>Satuan</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $no = 1;
                foreach($d_barang as $b){
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $b['nm_barang']?></td>
                            <td><?= $b['jumlah']?></td>
                            <td><?= $b['satuan']?></td>
                            </td>
                        </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>  
<?= $this->endSection() ?>
