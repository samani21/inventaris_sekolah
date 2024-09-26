<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-10">
                    <h5>Barang Page</h5>
                </div>
                <div class="col-2">
                    <a href="<?= base_url('barang/tambah') ?>" class="btn btn-secondary">
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
                            <th>Nama Kelas</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>NO</th>
                            <th>Nama Kelas</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($dataRow as $b) {
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $b['nama_kelas'] ?></td>
                                <td><?php
                                    if (session()->get('level') == "Admin") {
                                    ?>
                                        <a href="<?= base_url('barang/edit/' . $b['id_kelas'] . '') ?>" class="btn btn-warning">Edit</a>
                                        <a href="<?= base_url('barang/delete/' . $b['id_kelas'] . '') ?>" onClick="return confirm('Hapus data')" class="btn btn-danger">Hapus</a>

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
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>