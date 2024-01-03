<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
<div>
    <a href="<?= base_url('barang/tambah') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
</div>
<br>
<table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Satuan</th>
                <th>Action</th>
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
                            <td>
                                <a href="<?= base_url('barang_pakai/tambah/'.$b['id'].'')?>" class="btn btn-primary">Pakai</a>
                                <?php
                                if(session()->get('level') == "Admin"){
                                    ?>
                                        <a href="<?= base_url('barang/edit/'.$b['id'].'')?>" class="btn btn-warning">Edit</a>
                                        <a href="<?= base_url('barang/delete/'.$b['id'].'')?>" onClick="return confirm('Hapus data')" class="btn btn-danger">Hapus</a>

                                    <?php
                                }
                                ?>
                            </td>
                        </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>  
<?= $this->endSection() ?>
