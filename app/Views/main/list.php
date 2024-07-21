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
                        } else if (isset($hadir)) {
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
                                        <option value="">--Pilih mapel</option>
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
                                        <option value="">--Pilih penilaian</option>
                                        <option value="Absen">Absen</option>
                                        <option value="Absen dan Nilai">Absen dan Nilai</option>
                                        <option value="Absen dan Ujian">Absen dan Ujian</option>
                                    </select>
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
                            if (isset($ceklist)) {
                            ?>
                                <th>Aktif</th>
                            <?php
                            }
                            ?>
                            <?php
                            foreach ($column as $col) {
                            ?>
                                <th><?= convertColumnName($col) ?></th>
                                <?php
                            }
                            if (isset($hadir)) {
                                if (@$_GET['penilaian'] == "Absen dan Nilai" || @$_GET['penilaian'] == "Absen dan Ujian") {
                                ?>
                                    <th>Nilai</th>
                                <?php
                                }
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
                    </thead>
                    <tfoot>
                        <tr>
                            <th>NO</th>
                            <?php
                            if (isset($ceklist)) {
                            ?>
                                <th>Aktif</th>
                            <?php
                            }
                            ?>
                            <?php
                            foreach ($column as $col) {
                            ?>
                                <th><?= convertColumnName($col) ?></th>
                                <?php
                            }
                            if (isset($hadir)) {
                                if (@$_GET['penilaian'] == "Absen dan Nilai" || @$_GET['penilaian'] == "Absen dan Ujian") {
                                ?>
                                    <th>Nilai</th>
                                <?php
                                }
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
                    if ($row == 1) {
                    } else {
                    ?>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($row as $r) {
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <?php
                                    if (isset($ceklist)) {
                                    ?>
                                        <td>
                                            <?php
                                            if (isset($hadir)) {
                                                if (strtotime($r['tanggal']) == strtotime($_GET['tanggal']) && $r['nama_mapel'] == $_GET['mapel']) {
                                            ?>
                                                    <div class="btn btn-icon btn-round btn btn-outline-secondary btn-sm me-2">
                                                        <i class="fa fa-check"></i>
                                                    </div>
                                                <?php
                                                } else {
                                                ?>
                                                    <a href="<?= base_url($page . '/ceklist/' . $r['id'] . '?mapel=' . $_GET['mapel'] . '&tanggal=' . $_GET['tanggal'] . '&penilaian=' . $_GET['penilaian']) ?>" class="btn btn-icon btn-round btn btn-outline-secondary btn-sm me-2">

                                                    </a>
                                                <?php
                                                }
                                                ?>

                                            <?php
                                            } else {
                                            ?>
                                                <a href="<?= base_url($page . '/ceklist/' . $r['id']) ?>" class="btn btn-icon btn-round btn btn-outline-secondary btn-sm me-2">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                    <?php
                                    }
                                    ?>
                                    <?php

                                    foreach ($column as $cl) {
                                    ?>
                                        <td>
                                            <?php
                                            if ($cl == 'foto') {
                                            ?>
                                                <img src="<?= base_url('public/images/' . $r[$cl]) ?>" width="100px" alt="">
                                                <?php
                                            } else {
                                                if ($cl == "status_pinjam") {
                                                    if ($r[$cl] == 1) {
                                                ?>
                                                        <span class="badge badge-warning">Dipakai</span>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <span class="badge badge-success">Selesai</span>
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
                                    if (isset($hadir)) {
                                    ?>
                                        <?php if (@$_GET['penilaian'] == "Absen dan Nilai" || @$_GET['penilaian'] == "Absen dan Ujian") {
                                            if (strtotime($r['tanggal']) == strtotime($_GET['tanggal']) && $r['nama_mapel'] == $_GET['mapel']) {

                                        ?>
                                                <td>
                                                    <form action="<?= base_url('siswa/nilai/store/' . $r['id_absen_siswa']) ?>" method="post">
                                                        <div class="row">
                                                            <div class="col-5">
                                                                <input type="hidden" name="tanggal" value="<?= $_GET['tanggal'] ?>">
                                                                <input type="hidden" name="mapel" value="<?= $_GET['mapel'] ?>">
                                                                <input type="hidden" name="penilaian" value="<?= $_GET['penilaian'] ?>">
                                                                <input type="text" class="form-control" value="<?php
                                                                                                                $db = \Config\Database::connect();

                                                                                                                if ($_GET['penilaian'] == "Absen dan Nilai") {
                                                                                                                    $query = $db->query('SELECT * FROM nilai');
                                                                                                                } else if ($_GET['penilaian'] == "Absen dan Ujian") {
                                                                                                                    $query = $db->query('SELECT * FROM nilai_ujian');
                                                                                                                }
                                                                                                                $results = $query->getResultArray();
                                                                                                                foreach ($results as $nil) {
                                                                                                                    if ($nil['id_absen_siswa'] == $r['id_absen_siswa']) {
                                                                                                                        echo $nil['nilai'];
                                                                                                                    }
                                                                                                                }
                                                                                                                ?>" name="nilai">
                                                            </div>
                                                            <div class="col-2">
                                                                <button class="btn btn-warning">Save</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </td>
                                            <?php
                                            } else {
                                            ?>
                                                <td></td>
                                            <?php
                                            }
                                            ?>

                                        <?php
                                        } ?>
                                    <?php
                                    }
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
                                                ?>
                                                <a href="<?= base_url($page . '/delete/' . $r['id']) ?>" style="padding: 4px;" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger delete-button" data-id="<?= $r['id'] ?>" data-original-title="Remove"> <i class="fa fa-times"></i></a>

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
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>