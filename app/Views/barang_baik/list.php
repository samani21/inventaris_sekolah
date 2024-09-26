<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
<div>
    <a href="<?= base_url('barang_rusak/tambah') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
</div>
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
        <div class="col-1">
            <button class="btn btn-success" name="status" value="2">Baik</button>
        </div>
        <div class="col-1">
            <button class="btn btn-danger" name="status" value="1">rusak</button>
        </div>
    </div>
</form>
<table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>Nama Barang</th>
                <th>Tanggal Rusak</th>
                <th>Jumlah Rusak</th>
                <th>Jumlah Baik</th>
                <th>Keterangan</th>
                <th>Status</th>
                <?php
                    if(session()->get('level') == "Admin"){
                        ?>
                        <th>Action</th>
                        <?php
                    }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
                $no = 1;
                foreach($dt as $b){
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $b['nama_barang']?></td>
                            <td><?= date('d-m-Y', strtotime($b['tgl_rusak']))?></td>
                            <td><?= $b['stok']?></td>
                            <td><?= $b['stok_baik']?></td>
                            <td><?= $b['keterangan']?></td>
                            <td><?php
                                if($b['status'] == 1 ){
                                    echo "Rusak";
                                }else{
                                    echo "Diperbaiki";
                                }
                            ?></td>
                                <?php
                                if(session()->get('level') == "Admin"){
                                    ?>
                                    
                                    <td>
                                    <?php
                                            if($b['stok_baik'] < $b['stok'] || $b['stok_baik'] > $b['stok']){
                                                ?>
                                                    <a href="<?= base_url('kondisi_barang/tambah/'.$b['id_barang_status'].'')?>" class="btn btn-primary">Perbaiki</a>
                                                
                                        <a href="<?= base_url('kondisi_barang/edit/'.$b['id_barang_status'].'')?>" class="btn btn-warning">Edit</a>
                                        <a href="<?= base_url('kondisi_barang/delete/'.$b['id_barang_status'].'')?>" onClick="return confirm('Hapus data')" class="btn btn-danger">Hapus</a>
                                    
                                                <?php
                                            }
                                        ?>
                                         </td>
                                    <?php
                                }
                                ?>
                        </tr>
                    <?php   
                }
            ?>
        </tbody>
    </table>  
<?= $this->endSection() ?>
