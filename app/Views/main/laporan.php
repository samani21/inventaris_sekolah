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
            </div>
            <div>
                <?php
                if (isset($hiddenBetween)) {
                ?>
                    <a href="<?= base_url($page . '/cetak') ?>" class="btn btn-success">Cetak</a>
                    <?php
                } else {
                    if (!isset($hiddenCetak)) {
                    ?>
                        <form action="<?= base_url($page . '/cetak') ?>" method="get">
                            <div class="row">
                                <div class="col-5">
                                    <input type="date" class="form-control" name="dari">
                                </div>
                                <div class="col-5">
                                    <input type="date" class="form-control" name="sampai">
                                </div>
                                <div class="col-2">
                                    <button class="btn btn-success" type="submit">Cetak</button>
                                </div>
                            </div>
                        </form>
                <?php
                    }
                }
                ?>
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
                            if (isset($cetakData) || isset($cetak_satuan)) {
                            ?>
                                <th>Cetak</th>
                            <?php
                            } else
                            if (isset($cetakRaport)) {
                            ?>
                                <th>Cetak</th>
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
                            if (isset($cetakData) || isset($cetak_satuan)) {
                            ?>
                                <th>Cetak</th>
                            <?php
                            } else
                            if (isset($cetakRaport)) {
                            ?>
                                <th>Cetak</th>
                            <?php
                            }
                            ?>
                        </tr>
                    </tfoot>
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
                                if (isset($cetakData) || isset($cetak_satuan)) {
                                    if (isset($r['id_user_verifikasi']) > 0 || isset($cetak_satuan)) {
                                    ?>
                                        <td>
                                            <a href="<?= base_url($page . '/cetak_satuan/' . $r['id']) ?>" class="btn btn-warning">Cetak</a>
                                        </td>
                                    <?php
                                    } else {
                                    ?>
                                        <td></td>
                                    <?php
                                    }
                                } else if (isset($cetakRaport)) {
                                    ?>
                                    <td>
                                        <?php
                                        foreach ($rapotSemester as $sem) {
                                        ?>
                                            <a href="<?= base_url($page . '/cetak_satuan/' . $r['id']) . '/' . $sem['id'] ?>" class="btn btn-warning">Raport <?= $sem['semester'] ?></a>
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
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>