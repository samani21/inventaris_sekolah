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
                    <h5><?= $data ?> Page</h5>
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
                                        <a href="<?= base_url($page . '/ceklist/' . $r['id']) ?>" class="btn btn-icon btn-round btn btn-outline-secondary btn-sm me-2">
                                            <?php
                                            if ($r[$ceklist]) {
                                            ?>
                                                <i class="fa fa-check"></i>
                                            <?php
                                            }
                                            ?>
                                        </a>
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
                                            echo $r[$cl];
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
                                    <td>
                                        <?php
                                        if (isset($verifikasi)) {
                                        ?>
                                            <a href="<?= base_url($page . '/verifikasi/' . $r['id']) ?>" style="padding: 4px;" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-check-circle"></i></i></a>
                                        <?php
                                        }
                                        ?>
                                        <a href=" <?= base_url($page . '/edit/' . $r['id']) ?>" style="padding: 4px;" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i></i></a>
                                        <a href="<?= base_url($page . '/delete/' . $r['id']) ?>" style="padding: 4px;" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger delete-button" data-id="<?= $r['id'] ?>" data-original-title="Remove"> <i class="fa fa-times"></i></a>

                                    </td>
                            </tr>
                    <?php
                                }
                            }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>