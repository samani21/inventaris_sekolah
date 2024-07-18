<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
<form action="<?= base_url('guru/cetak') ?>" method="post">
    <div class="row">
        <div class="col-2">
            <label for="">Cetak berdasarkan</label>
        </div>
        <div class="col-4">
            <input type="text" class="form-control" name="cari">
        </div>
        <div class="col-4">
            <button class="btn btn-primary">Cetak</button>
        </div>
    </div>
</form>
<br>
<table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>NIP</th>
                <th>Nama</th>
                <th>TTL</th>
                <th>Jenis Kelamin</th>
                <th>Agama</th>
                <th>NO hp</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $no = 1;
                foreach($d_guru as $g){
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $g['nip']?></td>
                            <td><?= $g['nama']?></td>
                            <td><?= $g['tempat']?>, <?= date('d-m-Y', strtotime($g['t_lahir'])) ?></td>
                            <td><?= $g['j_kelamin']?></td>
                            <td><?= $g['agama']?></td>
                            <td><?= $g['no_hp']?></td>
                        </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>  
<?= $this->endSection() ?>
