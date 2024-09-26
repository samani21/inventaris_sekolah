<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
<br>
<table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>Nama Pemakai</th>
                <th>Nama Barang</th>
                <th>Merek Barang</th>
                <th>Tanggal</th>
                <th>Stok</th>
                <th>Dari</th>
                <th>Ruangan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $no = 1;
                foreach($dt as $b){
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $b['nama']?></td>
                            <td><?= $b['nm_barang']?></td>
                            <td><?= $b['merek']?></td>
                            <td><?= date('d-m-Y', strtotime($b['tgl_pinjam']))?></td>
                            <td><?= $b['stok']?></td>
                            <td><?= $b['status']?></td>
                            <td><?= $b['ruangan']?></td>
                            <td>
                                <a href="<?= base_url('barang_pakai/edit/'.$b['id_barang_peruangan'].'')?>" class="btn btn-warning">Edit</a>
                                <?php
                                            if($b['stok_selesai'] < $b['stok']){
                                                ?>
                                                <a href="<?= base_url('barang_pakai/selesai/'.$b['id_barang_peruangan'].'')?>" class="btn btn-primary">Selesai</a>
                                                <a href="<?= base_url('barang_pakai/delete/'.$b['id_barang_peruangan'].'/'.$b['ruangan'])?>" onClick="return confirm('Hapus data')" class="btn btn-danger">Hapus</a>
                                                <?php
                                            }else{

                                            }
                                        ?>
                            </td>
                        </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>  
<?= $this->endSection() ?>
