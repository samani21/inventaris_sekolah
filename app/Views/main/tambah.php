<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
<?php
function transformTableName($tableName)
{
    // Remove 'tb_' and replace '_' with capitalized letter
    $tableName = str_replace('tb_', '', $tableName);
    $tableName = ucwords(str_replace('_', ' ', $tableName));

    return $tableName;
}
?>
<h1><?= transformTableName($data) ?> </h1>
<br>
<div>
    <form action="<?= base_url($page . '/store') ?>" method="post" enctype="multipart/form-data">
        <?php
        foreach ($form as $f) {

            if ($f['type'] == 'text') {
        ?>

                <label for="<?= $f['name'] ?>" class="col-md-3 col-form-label"><?= transformTableName($f['name']) ?></label>
                <input type="text" name="<?= $f['name'] ?>" class="form-control" placeholder="Input <?= transformTableName($f['name']) ?>" required autofocus>

            <?php
            } elseif ($f['type'] == 'enum') {
            ?>

                <label for="<?= $f['name'] ?>" class="col-md-3 col-form-label"><?= transformTableName($f['name']) ?></label>
                <select name="<?= $f['name'] ?>" id="" required placeholder="Input <?= transformTableName($f['name']) ?>" class="form-control">
                    <option>--Pilih <?= $f['name'] ?></option>
                    <?php
                    foreach ($enum[$f['name']] as $en) {
                    ?>
                        <option value="<?= $en ?>"><?= $en ?></option>
                    <?php
                    }
                    ?>
                </select>
            <?php
            } elseif ($f['type'] == 'email') {
            ?>

                <label for="<?= $f['name'] ?>" class="col-md-3 col-form-label"><?= transformTableName($f['name']) ?></label>
                <input type="email" name="<?= $f['name'] ?>" class="form-control" placeholder="Input <?= transformTableName($f['name']) ?>" required autofocus>

            <?php
            } elseif ($f['type'] == 'password') {
            ?>

                <label for="<?= $f['name'] ?>" class="col-md-3 col-form-label"><?= transformTableName($f['name']) ?></label>
                <input type="password" name="<?= $f['name'] ?>" class="form-control" placeholder="Input <?= transformTableName($f['name']) ?>" required autofocus>

            <?php
            } elseif ($f['type'] == 'date') {
            ?>

                <label for="<?= $f['name'] ?>" class="col-md-3 col-form-label"><?= transformTableName($f['name']) ?></label>
                <input type="date" name="<?= $f['name'] ?>" class="form-control" placeholder="Input <?= transformTableName($f['name']) ?>" required autofocus>

            <?php
            } elseif ($f['type'] == 'number') {
            ?>

                <label for="<?= $f['name'] ?>" class="col-md-3 col-form-label"><?= transformTableName($f['name']) ?></label>
                <input type="number" name="<?= $f['name'] ?>" class="form-control" placeholder="Input <?= transformTableName($f['name']) ?>" required autofocus>

            <?php
            } elseif ($f['type'] == 'file') {
            ?>

                <label for="<?= $f['name'] ?>" class="col-md-3 col-form-label"><?= transformTableName($f['name']) ?></label>
                <input type="file" name="<?= $f['name'] ?>" class="form-control" placeholder="Input <?= transformTableName($f['name']) ?>" <?php if(isset($notRequired)){}else{echo "required";}?> autofocus>

            <?php
            }elseif ($f['type'] == 'rupiah') {
                ?>
    
                    <label for="<?= $f['name'] ?>" class="col-md-3 col-form-label"><?= transformTableName($f['name']) ?></label>
                    <input type="text" id="rupiah" class="form-control" placeholder="Rp 0" oninput="formatRupiah(this)" name="<?= $f['name'] ?>">
    
                <?php
                } elseif ($f['type'] == 'relasi') {
            ?>
                <label for="<?= $f['name'] ?>" class="col-md-3 col-form-label"><?= transformTableName($f['name']) ?></label>
                <div class="row">
                    <div class="col-10">
                        <input type="hidden" id="<?= $f['name'] ?>_id" name="<?= $f['name'] ?>">
                        <input type="text" class="form-control input-full" id="<?= $f['name'] ?>" placeholder="Input <?= transformTableName($f['name']) ?>" required autofocus readonly>
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-secondary" onclick="openRelationModal('<?= $f['name'] ?>')">Cari</button>
                    </div>
                </div>
        <?php
            } elseif ($f['type'] == 'textArea') {
                ?>
    
                    <label for="<?= $f['name'] ?>" class="col-md-3 col-form-label"><?= transformTableName($f['name']) ?></label>
                    <textarea name="<?= $f['name'] ?>" class="form-control" placeholder="Input <?= transformTableName($f['name']) ?>" required autofocus></textarea>
    
                <?php
                }
        }
        ?>
        <br>
        <div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="reset" class="btn btn-danger">Reset</button>
            <button onclick="goBack()" class="btn btn-warning">Kembali</button>
        </div>
    </form>
</div>
<?php if (@$relasi) {
    foreach ($relasi as $relation) : ?>
        <div class="modal fade" id="relationModal_<?= $relation['fieldName'] ?>" tabindex="-1" aria-labelledby="relationModalLabel_<?= $relation['fieldName'] ?>" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="relationModalLabel_<?= $relation['fieldName'] ?>">Pilih Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="display table table-striped table-hover" id="relationTable_<?= $relation['fieldName'] ?>">
                        <thead>
                                <tr>
                                    <?php foreach ($relation['columns'] as $column) : ?>
                                        <th><?= $column ?></th>
                                    <?php endforeach; ?>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($relation['rows'] as $row) : ?>
                                    <tr>
                                        <?php foreach ($relation['columns'] as $column) : ?>
                                            <td><?= $row[str_replace(' ', '_', strtolower($column))] ?></td>
                                        <?php endforeach; ?>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" 
                                            onclick="selectData('<?= $row['id'] ?>', 
                                            '<?php foreach ($relation['select'] as $rel) {echo $row[$rel], ' '; }?>', '<?= $relation['fieldName'] ?>')">Select</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
<?php endforeach;
} ?>
<script>
    function goBack() {
        window.history.back();
    }

    function openRelationModal(fieldName) {
        $('#relationModal_' + fieldName).modal('show');
    }

    function selectData(id, displayText, fieldName) {
        $('input[name="' + fieldName + '"]').val(id);
        $('#' + fieldName).val(displayText);
        $('#relationModal_' + fieldName).modal('hide');
    }

    function formatRupiah(input) {
            let value = input.value.replace(/[^,\d]/g, '').toString();
            let split = value.split(',');
            let sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            input.value = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            input.value = 'Rp ' + input.value;
        }
</script>

<?= $this->endSection() ?>