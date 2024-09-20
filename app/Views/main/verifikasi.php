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
<h1><?= $data ?> </h1>
<br>
<div>
    <form action="<?= base_url($page . '/verifikasi_store/' . $dt['id']) ?>" method="post" enctype="multipart/form-data">
        <?php
        foreach ($formAwal as $f) {

            if ($f['type'] == 'text') {
        ?>

                <label for="<?= $f['name'] ?>" class="col-md-3 col-form-label"><?= transformTableName($f['name']) ?></label>
                <input type="text" name="<?= $f['name'] ?>" value="<?= $dt[$f['name']] ?>" class="form-control" readonly required autofocus>

            <?php
            } elseif ($f['type'] == 'enum') {
            ?>

                <label for="<?= $f['name'] ?>" class="col-md-3 col-form-label"><?= transformTableName($f['name']) ?></label>
                <select name="<?= $f['name'] ?>" id="" required class="form-control" readonly>
                    <option value="<?= $dt[$f['name']] ?>"><?= $dt[$f['name']] ?></option>
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
                <input type="email" name="<?= $f['name'] ?>" value="<?= $dt[$f['name']] ?>" class="form-control" readonly required autofocus>

            <?php
            } elseif ($f['type'] == 'password') {
            ?>

                <label for="<?= $f['name'] ?>" class="col-md-3 col-form-label"><?= transformTableName($f['name']) ?></label>
                <input type="password" name="<?= $f['name'] ?>" placeholder="Jika tidak ganti password kosongkan" readonly class="form-control" autofocus>

            <?php
            } elseif ($f['type'] == 'date') {
            ?>

                <label for="<?= $f['name'] ?>" class="col-md-3 col-form-label"><?= transformTableName($f['name']) ?></label>
                <input type="date" name="<?= $f['name'] ?>" value="<?= $dt[$f['name']] ?>" class="form-control" readonly placeholder="Input <?= transformTableName($f['name']) ?>" required autofocus>

            <?php
            } elseif ($f['type'] == 'number') {
                ?>
    
                    <label for="<?= $f['name'] ?>" class="col-md-3 col-form-label"><?= transformTableName($f['name']) ?></label>
                    <input type="number" name="<?= $f['name'] ?>" value="<?= $dt[$f['name']] ?>" class="form-control" readonly placeholder="Input <?= transformTableName($f['name']) ?>" required autofocus>
    
                <?php
                } elseif ($f['type'] == 'file') {
            ?>

                <label for="<?= $f['name'] ?>" class="col-md-3 col-form-label"><?= transformTableName($f['name']) ?></label>
                <input type="file" name="<?= $f['name'] ?>" class="form-control" placeholder="Input <?= transformTableName($f['name']) ?>" readonly autofocus>

            <?php
            } elseif ($f['type'] == 'textArea') {
                ?>
    
                    <label for="<?= $f['name'] ?>" class="col-md-3 col-form-label"><?= transformTableName($f['name']) ?></label>
                    <textarea name="<?= $f['name'] ?>"  class="form-control" id="" readonly><?= $dt[$f['name']] ?></textarea>
    
                <?php
                } elseif ($f['type'] == 'relasi') {
            ?>
                <label for="<?= $f['name'] ?>" class="col-md-3 col-form-label"><?= transformTableName($f['name']) ?></label>
                <div class="row">
                    <div class="col-12">
                        <input type="hidden" id="<?= $f['name'] ?>_id" value="<?= $dt[$f['name']] ?>" name="<?= $f['name'] ?>">
                        <input type="text" class="form-control input-full" id="<?= $f['name'] ?>" value=" <?php 
                                                foreach ($relasi as $relation){
                                                    if($relation['fieldName'] == $f['name']){
                                                    foreach ($relation['select'] as $rel) {
                                                        echo $dt[$rel], ' '; 
                                                    }
                                                    }
                                                }
                                            ?>"  placeholder="Input <?= transformTableName($f['name']) ?>" required autofocus readonly>
                    </div>
                </div>
        <?php
            }
        }
        foreach ($formVerf as $fv) {

            if ($fv['type'] == 'text') {
        ?>

                <label for="<?= $fv['name'] ?>" class="col-md-3 col-form-label"><?= transformTableName($fv['name']) ?></label>
                <input type="text" name="<?= $fv['name'] ?>" value="<?= @$dtVerf[$fv['name']] ?>" class="form-control"  required autofocus>

            <?php
            } elseif ($fv['type'] == 'enum') {
            ?>

                <label for="<?= $fv['name'] ?>" class="col-md-3 col-form-label"><?= transformTableName($fv['name']) ?></label>
                <select name="<?= $fv['name'] ?>" id="" required class="form-control" >
                    <?php
                    foreach ($enum[$fv['name']] as $en) {
                    ?>
                        <option value="<?= $en ?>"><?= $en ?></option>
                    <?php
                    }
                    ?>
                </select>
            <?php
            } elseif ($fv['type'] == 'email') {
            ?>

                <label for="<?= $fv['name'] ?>" class="col-md-3 col-form-label"><?= transformTableName($fv['name']) ?></label>
                <input type="email" name="<?= $fv['name'] ?>" value="<?= @$dtVerf[$fv['name']] ?>" class="form-control"  required autofocus>

            <?php
            } elseif ($fv['type'] == 'password') {
            ?>

                <label for="<?= $fv['name'] ?>" class="col-md-3 col-form-label"><?= transformTableName($fv['name']) ?></label>
                <input type="password" name="<?= $fv['name'] ?>" placeholder="Jika tidak ganti password kosongkan"  class="form-control" autofocus>

            <?php
            } elseif ($fv['type'] == 'date') {
            ?>

                <label for="<?= $fv['name'] ?>" class="col-md-3 col-form-label"><?= transformTableName($fv['name']) ?></label>
                <input type="date" name="<?= $fv['name'] ?>" value="<?= @$dtVerf[$fv['name']] ?>" class="form-control"  placeholder="Input <?= transformTableName($fv['name']) ?>" required autofocus>

            <?php
            } elseif ($fv['type'] == 'number') {
                ?>
    
                    <label for="<?= $fv['name'] ?>" class="col-md-3 col-form-label"><?= transformTableName($fv['name']) ?></label>
                    <input type="number" name="<?= $fv['name'] ?>" value="<?= @$dtVerf[$fv['name']] ?>" class="form-control"  placeholder="Input <?= transformTableName($fv['name']) ?>" required autofocus>
    
                <?php
                } elseif ($fv['type'] == 'file') {
            ?>

                <label for="<?= $fv['name'] ?>" class="col-md-3 col-form-label"><?= transformTableName($fv['name']) ?></label>
                <input type="file" name="<?= $fv['name'] ?>" value="<?= @$dtVerf[$fv['name']] ?>" class="form-control" placeholder="Input <?= transformTableName($fv['name']) ?>"  autofocus>

            <?php
            } elseif ($fv['type'] == 'textArea') {
                ?>
    
                    <label for="<?= $fv['name'] ?>" class="col-md-3 col-form-label"><?= transformTableName($fv['name']) ?></label>
                    <textarea name="<?= $fv['name'] ?>" class="form-control" id="" ><?= @$dtVerf[$fv['name']] ?></textarea>
    
                <?php
                } elseif ($fv['type'] == 'relasi') {
            ?>
                <label for="<?= $fv['name'] ?>" class="col-md-3 col-form-label"><?= transformTableName($fv['name']) ?></label>
                <div class="row">
                    <div class="col-12">
                        <input type="hidden" id="<?= $fv['name'] ?>_id" name="<?= $fv['name'] ?>" value="<?= @$dtVerf[$fv['name']] ?>">
                        <input type="text" class="form-control input-full" id="<?= $fv['name'] ?>"  value=" <?php 
                                                foreach ($relasi as $relation){
                                                    if($relation['fieldName'] == $fv['name']){
                                                    foreach ($relation['select'] as $rel) {
                                                        echo @$dt[$rel], ' '; 
                                                    }
                                                    }
                                                }
                                            ?>"  placeholder="Input <?= transformTableName($fv['name']) ?>" required autofocus >
                    </div>
                </div>
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
</script>

<?= $this->endSection() ?>