<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
<?php
    if(session()->get('level') == 'Admin'){
        ?>
<div>
    <a href="<?= base_url('sumber_barang/tambah') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
</div>
        <?php
    }
?>
<br>
<form action="" method="get">
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
            <button class="btn btn-primary">Filter</button>
        </div>
    </div>
</form>
<table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Merek Barang</th>
                <th>Tanggal</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $no = 1;
                foreach($d_bmp as $b){
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $b['kode_barang']?></td>
                            <td><?= $b['nm_barang']?></td>
                            <td><?= $b['merek']?></td>
                            <td><?= date('d-m-Y', strtotime($b['tgl']))?></td>
                            <td><?= $b['total']?></td>
                            <td><?= $b['status']?></td>
                            
                            <td>
                            <a href="<?= base_url('barang_pakai/tambah/'.$b['id_barang_masuk'].'')?>" class="btn btn-primary">Pakai</a>
                                
                            <a href="<?= base_url('sumber_barang/edit/'.$b['id_barang_masuk'].'')?>" class="btn btn-warning">Edit</a>
                                        <a href="<?= base_url('sumber_barang/delete/'.$b['id_barang_masuk'].'')?>" onClick="return confirm('Hapus data')" class="btn btn-danger">Hapus</a>
                                       
                                </td>
                        </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>  
<?= $this->endSection() ?>
