<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>

<div>
    <a href="user/tambah" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
</div>
<br>
<div>
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Email</th>
                <th>Level</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
                foreach($d_user as $us){
                    ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $us['name'] ?></td>
                <td><?= $us['username'] ?></td>
                <td><?= $us['email'] ?></td>
                <td><?= $us['level']?></td>
                <td>
                    <a href="<?= base_url('user/edit/'.$us['id'].'') ?>" class="btn btn-warning">Edit</a>
                    <a href="<?= base_url('user/delete/'.$us['id'].'') ?>" onClick="return confirm('Hapus data')" class="btn btn-danger">Hapus</a>
                </td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>