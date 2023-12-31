<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
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
                <?php
                    if(session()->get('level') == "Admin"){
                        ?>
                        <th>Action</th>
                        <?php
                    }
                ?>
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
                            <td><?= $g['tempat']?>,<?= $g['t_lahir'] ?></td>
                            <td><?= $g['j_kelamin']?></td>
                            <td><?= $g['agama']?></td>
                            <td><?= $g['no_hp']?></td>
                                <?php
                                if(session()->get('level') == "Admin"){
                                    ?>
                                    <td>
                                        <a href="<?= base_url('guru/edit/'.$g['id'].'')?>" class="btn btn-warning">Edit</a>
                                        <a href="<?= base_url('guru/delete/'.$g['id'].'')?>" onClick="return confirm('Hapus data')" class="btn btn-danger">Hapus</a>
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
<?= $this->endSection() ?>
