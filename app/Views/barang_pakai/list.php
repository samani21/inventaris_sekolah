<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
<br>
<table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>Nama Barang</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Selesai</th>
                <th>Stok Pinjam</th>
                <th>Stok Selesai</th>
                <th>Ruangan</th>
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
                            <td><?= date('d-m-Y', strtotime($b['tgl_pinjam']))?></td>
                            <td><?php
                                if($b['stok_selesai'] < $b['stok']){
                                    echo '-';
                                }else{
                                   echo date('d-m-Y', strtotime($b['tgl_selesai']));
                                }
                             ?></td>
                            <td><?= $b['stok']?></td>
                            <td><?= $b['stok_selesai']?></td>
                            <td><?= $b['ruangan']?></td>
                                <?php
                                if(session()->get('level') == "Admin"){
                                    ?>
                                    <td>
                                        <a href="<?= base_url('barang_pakai/edit/'.$b['id_barang_peruangan'].'')?>" class="btn btn-warning">Edit</a>
                                        <?php
                                            if($b['stok_selesai'] < $b['stok']){
                                                ?>
                                                <a href="<?= base_url('barang_pakai/selesai/'.$b['id_barang_peruangan'].'')?>" class="btn btn-primary">Selesai</a>
                                                <a href="<?= base_url('barang_pakai/delete/'.$b['id_barang_peruangan'].'')?>" onClick="return confirm('Hapus data')" class="btn btn-danger">Hapus</a>
                                                <?php
                                            }else{

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
<?= $this->endSection() ?>
