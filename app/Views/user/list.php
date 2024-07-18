<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-10">
                    <h5>User Page</h5>
                </div>
                <div class="col-2">
                    <a href="user/tambah" class="btn btn-secondary">
                        <span class="btn-label">
                            <i class="fa fa-plus"></i>
                        </span>
                        Data
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover">
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
                    <tfoot>
                        <tr>
                            <th>NO</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Level</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($d_user as $us) {
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $us['name'] ?></td>
                                <td><?= $us['username'] ?></td>
                                <td><?= $us['email'] ?></td>
                                <td><?= $us['level'] ?></td>
                                <td>
                                    <a href="<?= base_url('user/edit/' . $us['id'] . '') ?>" class="btn btn-warning">Edit</a>
                                    <a href="<?= base_url('user/delete/' . $us['id'] . '') ?>" onClick="return confirm('Hapus data')" class="btn btn-danger">Hapus</a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>