<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
<div>
    <a href="<?= base_url('ruangan/tambah') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
</div>
<br>
<table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>Nama Ruangan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $no = 1;
                foreach($ruangan as $b){
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $b['nm_ruangan']?></td>
                            <td>
                                <a href="<?= base_url('ruangan/edit/'.$b['id_ruangan'].'')?>" class="btn btn-warning">Edit</a>
                                <a href="<?= base_url('ruangan/delete/'.$b['id_ruangan'].'')?>" onClick="return confirm('Hapus data')" class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>  
<?= $this->endSection() ?>
