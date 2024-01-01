<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
<div>
    <a href="<?= base_url('barang_masuk/tambah') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
</div>
<br>
<table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>Nama Barang</th>
                <th>Tanggal</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Status</th>
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
                foreach($d_bmp as $b){
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $b['nm_barang']?></td>
                            <td><?= date('d-m-Y', strtotime($b['tgl']))?></td>
                            <td><?= $b['total']?></td>
                            <td><?= $hasil_rupiah = "Rp " . number_format($b['harga'],2,',','.');?></td>
                            <td><?= $b['status']?></td>
                                <?php
                                if(session()->get('level') == "Admin"){
                                    ?>
                                    <td>
                                        <a href="<?= base_url('barang_masuk/edit/'.$b['id_barang_masuk'].'')?>" class="btn btn-warning">Edit</a>
                                        <a href="<?= base_url('barang_masuk/delete/'.$b['id_barang_masuk'].'')?>" onClick="return confirm('Hapus data')" class="btn btn-danger">Hapus</a>
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
