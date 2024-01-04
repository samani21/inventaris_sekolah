<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
<form action="<?= base_url('barang_pakai/cetak_pakai') ?>" method="post">
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
                <th>Nama Pemakai</th>
                <th>Nama Barang</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Selesai</th>
                <th>Stok Pinjam</th>
                <th>Stok Selesai</th>
                <th>Ruangan</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $no = 1;
                foreach($dt as $b){
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $b['nama']?></td>
                            <td><?= $b['nm_barang']?></td>
                            <td><?= date('d-m-Y', strtotime($b['tgl_pinjam']))?></td>
                            <td><?php
                                if($b['stok_selesai'] < $b['stok']){
                                    echo '-';
                                }else{
                                   echo date('d-m-Y', strtotime($b['tgl_selesai']));
                                }
                             ?></td>
                            <td><?= $b['stok']?></td>
                            <td><?= $b['stok_selesai']?></td>
                            <td><?= $b['ruangan']?></td>
                        </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>  
<?= $this->endSection() ?>
