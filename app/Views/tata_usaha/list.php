<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-10">
                    <h5>Tata Usaha & Guru Page</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>TTL</th>
                            <th>Jenis Kelamin</th>
                            <th>Agama</th>
                            <th>NO hp</th>
                            <?php
                            if (session()->get('level') == "Admin") {
                            ?>
                                <th>Action</th>
                            <?php
                            }
                            ?>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>NO</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>TTL</th>
                            <th>Jenis Kelamin</th>
                            <th>Agama</th>
                            <th>NO hp</th>
                            <?php
                            if (session()->get('level') == "Admin") {
                            ?>
                                <th>Action</th>
                            <?php
                            }
                            ?>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($d_guru as $g) {
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $g['nip'] ?></td>
                                <td><?= $g['nama'] ?></td>
                                <td><?= $g['tempat'] ?>, <?= date('d-m-Y', strtotime($g['t_lahir'])) ?></td>
                                <td><?= $g['j_kelamin'] ?></td>
                                <td><?= $g['agama'] ?></td>
                                <td><?= $g['no_hp'] ?></td>
                                <?php
                                if (session()->get('level') == "Admin") {
                                ?>
                                    <td>
                                        <a href="<?= base_url('tata_usaha/edit/' . $g['id'] . '') ?>" class="btn btn-warning">Edit</a>
                                        <a href="<?= base_url('tata_usaha/delete/' . $g['id'] . '') ?>" onClick="return confirm('Hapus data')" class="btn btn-danger">Hapus</a>
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
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>