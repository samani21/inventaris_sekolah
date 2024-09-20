<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content');

function convertColumnName($columnName)
{
    // Replace underscores with spaces
    $columnName = str_replace('_', ' ', $columnName);
    // Capitalize the first letter of each word
    return ucwords($columnName);
}

?>

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-3">
                    <h5><?= convertColumnName($data) ?> Page</h5>
                </div>
                <div class="col-7">
                    <form action="" method="get">
                        <?php
                        if (isset($between)) {
                        ?>
                            <div class="row">
                                <div class="col-5">
                                    <input type="date" class="form-control" name="dari">
                                </div>
                                <div class="col-5">
                                    <input type="date" class="form-control" name="sampai">
                                </div>
                                <div class="col-2">
                                    <button class="btn btn-success" type="submit">Cari</button>
                                </div>
                            </div>
                        <?php
                        } else if (isset($hadirHarian)) {
                        ?>
                            <div class="row">
                                <div class="col-3">
                                    <input type="date" value="<?php
                                                                if (isset($_GET['tanggal'])) {
                                                                    echo $_GET['tanggal'];
                                                                } else {
                                                                    echo date('Y-m-d');
                                                                }
                                                                ?>" class="form-control" name="tanggal">
                                </div>
                                <div class="col-3">
                                    <select name="mapel" class="form-control" id="" required>
                                        <?php
                                        if (isset($_GET['mapel'])) {
                                        ?>
                                            <option value="<?= $_GET['mapel'] ?>"><?= $_GET['mapel'] ?></option>
                                        <?php
                                        } else {
                                        ?>
                                            <option value="">--Pilih mapel</option>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        foreach ($dtMapel as $mapel) {
                                        ?>
                                            <option value="<?= $mapel['nama_mapel'] ?>"><?= $mapel['nama_mapel'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <select name="penilaian" class="form-control" id="" required>
                                        <?php
                                        if (isset($_GET['penilaian'])) {
                                        ?>
                                            <option value="<?= $_GET['penilaian'] ?>"><?= $_GET['penilaian'] ?></option>
                                        <?php
                                        } else {
                                        ?>
                                            <option value="">--Pilih penilaian</option>
                                        <?php
                                        }
                                        ?>
                                        <option value="Absen">Absen</option>
                                        <option value="Tugas">Tugas</option>
                                        <option value="Kuis">Kuis</option>
                                        <option value="Portofolio dan Proyek">Portofolio dan Proyek</option>
                                        <option value="Ulangan">Ulangan</option>
                                    </select>
                                    <br>
                                </div>
                                <div class="col-4">
                                    <input type="text" name="materi" value="<?= @$_GET['materi'] ?>" class="form-control" id="">
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-success" type="submit">absen</button>
                                </div>
                            </div>
                        <?php
                        } else if (isset($ujian)) {
                        ?>
                            <div class="row">
                                <div class="col-3">
                                    <input type="date" value="<?php
                                                                if (isset($_GET['tanggal'])) {
                                                                    echo $_GET['tanggal'];
                                                                } else {
                                                                    echo date('Y-m-d');
                                                                }
                                                                ?>" class="form-control" name="tanggal">
                                </div>
                                <div class="col-3">
                                    <select name="mapel" class="form-control" id="" required>
                                        <?php
                                        if (isset($_GET['mapel'])) {
                                        ?>
                                            <option value="<?= $_GET['mapel'] ?>"><?= $_GET['mapel'] ?></option>
                                        <?php
                                        } else {
                                        ?>
                                            <option value="">--Pilih mapel</option>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        foreach ($dtMapel as $mapel) {
                                        ?>
                                            <option value="<?= $mapel['nama_mapel'] ?>"><?= $mapel['nama_mapel'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <select name="penilaian" class="form-control" id="" required>
                                        <?php
                                        if (isset($_GET['penilaian'])) {
                                        ?>
                                            <option value="<?= $_GET['penilaian'] ?>"><?= $_GET['penilaian'] ?></option>
                                        <?php
                                        } else {
                                        ?>
                                            <option value="">--Pilih penilaian</option>
                                        <?php
                                        }
                                        ?>
                                        <option value="PTS">PTS</option>
                                        <option value="PAS">PAS</option>
                                    </select>
                                    <br>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-success" type="submit">absen</button>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </form>
                </div>
                <div class="col-2">
                    <?php
                    if (isset($hiddenButtonAdd)) {
                    } else {
                    ?>
                        <a href="<?= base_url('' . $page . '/tambah') ?>" class="btn btn-secondary">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Data
                        </a>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <?php
                            foreach ($column as $col) {
                            ?>
                                <th><?= convertColumnName($col) ?></th>
                            <?php
                            }
                            if (!isset($hiddenButtonAction)) {
                            ?>
                                <th>
                                    action
                                </th>
                            <?php
                            }
                            if (isset($verif)) {
                            ?>
                                <th>
                                    action
                                </th>
                            <?php
                            }

                            ?>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>NO</th>
                            <?php
                            foreach ($column as $col) {
                            ?>
                                <th><?= convertColumnName($col) ?></th>
                            <?php
                            }
                            if (!isset($hiddenButtonAction)) {
                            ?>
                                <th>
                                    action
                                </th>
                            <?php
                            }

                            ?>
                        </tr>
                    </tfoot>
                    <?php
                    ?>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($row as $r) {
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <?php

                                foreach ($column as $cl) {
                                ?>
                                    <td>
                                        <?php
                                        if ($cl == 'foto') {
                                        ?>
                                            <img src="<?= base_url('public/images/' . $r[$cl]) ?>" width="100px" alt="">
                                            <?php
                                        } else if ($cl == 'foto/video') {
                                            if (substr($r['foto/video'], -3) == "mp4" || substr($r['foto/video'], -3) == "mkv") {
                                            ?>
                                                <video width="200" height="200" controls>
                                                    <source src="<?= base_url('public/images/' . $r[$cl]) ?>" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            <?php
                                            } else {
                                            ?>
                                                <img src="<?= base_url('public/images/' . $r[$cl]) ?>" width="100px" alt="">
                                                <?php
                                            }
                                        } else {
                                            if ($cl == 'status') {
                                                if ($r['status'] == 'Proses') {
                                                ?>
                                                    <span class="badge badge-warning">Proses</span>
                                                <?php
                                                } else if ($r['status'] == 'Baru') {
                                                ?>
                                                    <span class="badge badge-warning">Baru</span>
                                                <?php
                                                } else if ($r['status'] == 'Dibayar') {
                                                ?>
                                                    <span class="badge badge-success">Dibayar</span>
                                                <?php
                                                } else if ($r['status'] == 'Selesai') {
                                                ?>
                                                    <span class="badge badge-success">Selesai</span>
                                                <?php
                                                } else if ($r['status'] == 'Aktif') {
                                                ?>
                                                    <span class="badge badge-success">Aktif</span>
                                                <?php
                                                } else if ($r['status'] == 'Tidak Aktif') {
                                                ?>
                                                    <span class="badge badge-danger">Tidak Aktif</span>
                                                <?php
                                                } else if ($r['status'] == 'Dibayar') {
                                                ?>
                                                    <span class="badge badge-success">Dibayar</span>
                                                <?php
                                                } else {
                                                ?>
                                                    <span class="badge badge-danger">Dibayar</span>
                                        <?php
                                                }
                                            } else {
                                                echo $r[$cl];
                                            }
                                        }
                                        ?>
                                    </td>

                                <?php
                                }
                                ?>
                                <?php
                                if (isset($hiddenButtonAction)) {
                                } else {
                                ?>
                                    <?php
                                    if (isset($status)) {
                                        if ($r[$status] == 1) {
                                    ?>
                                            <td>
                                                <?php
                                                if (isset($verifikasi)) {
                                                ?>
                                                    <a href="<?= base_url($page . '/verifikasi/' . $r['id']) ?>" style="padding: 4px;" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-check-circle"></i></i></a>
                                                <?php
                                                }
                                                ?>
                                                <?php
                                                if (!isset($hiddenEdit)) {
                                                ?>
                                                    <a href=" <?= base_url($page . '/edit/' . $r['id']) ?>" style="padding: 4px;" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i></i></a>
                                                <?php
                                                }
                                                ?>
                                                <a href="<?= base_url($page . '/delete/' . $r['id']) ?>" style="padding: 4px;" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger delete-button" data-id="<?= $r['id'] ?>" data-original-title="Remove"> <i class="fa fa-times"></i></a>

                                            </td>
                                        <?php
                                        } else {
                                        ?>
                                            <td></td>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <td>
                                            <?php
                                            if (isset($verifikasi)) {
                                            ?>
                                                <a href="<?= base_url($page . '/verifikasi/' . $r['id']) ?>" style="padding: 4px;" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-check-circle"></i></i></a>
                                            <?php
                                            }
                                            ?>
                                            <?php
                                            if (!isset($hiddenEdit)) {
                                            ?>
                                                <a href=" <?= base_url($page . '/edit/' . $r['id']) ?>" style="padding: 4px;" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i></i></a>
                                            <?php
                                            }
                                            if (!isset($hiddenDelete)) {
                                            ?>

                                                <a href="<?= base_url($page . '/delete/' . $r['id']) ?>" style="padding: 4px;" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger delete-button" data-id="<?= $r['id'] ?>" data-original-title="Remove"> <i class="fa fa-times"></i></a>
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
                            }
                    ?>
                    </tbody>
                    <?php
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>