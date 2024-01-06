<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>

<table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>Nama Barang</th>
                <th>Tanggal</th>
                <th>Jumlah Rusak</th>
                <th>Jumlah Baik</th>
                <th>Keterangan</th>
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
                foreach($dt as $b){
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $b['nm_barang']?></td>
                            <td><?= date('d-m-Y', strtotime($b['tgl_baik']))?></td>
                            <td><?= $b['stok']?></td>
                            <td><?= $b['stok_baik']?></td>
                            <td><?= $b['keterangan']?></td>
                            <td><?php
                                if($b['status'] == 1 ){
                                    echo "Rusak";
                                }else{
                                    echo "Diperbaiki";
                                }
                            ?></td>
                                <?php
                                if(session()->get('level') == "Admin"){
                                    ?>
                                    <td><a href="<?= base_url('barang_baik/edit/'.$b['id_barang_status'].'')?>" class="btn btn-warning">Edit</a>
                                        <a href="<?= base_url('barang_baik/delete/'.$b['id_barang_status'].'')?>" onClick="return confirm('Hapus data')" class="btn btn-danger">Hapus</a>
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
