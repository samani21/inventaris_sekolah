<?php
 $db = db_connect();
 if(session()->get('level') == "Admin"){
  $query = $db->query("SELECT * FROM barang_peruangan JOIN barang_masuk ON barang_masuk.id_barang_masuk = barang_peruangan.id_barang_masuk JOIN barang ON barang.id = barang_masuk.id_barang JOIN guru ON guru.id = barang_peruangan.id_guru WHERE tgl_pinjam BETWEEN '$dari' AND '$sampai' AND ruangan = '$ruangan'");
 //you get result as an array in here but fetch your result however you feel to
 $result = $query->getResultArray();
 }else{
  $id = session()->get('id_guru');
  $query = $db->query("SELECT * FROM barang_peruangan JOIN barang_masuk ON barang_masuk.id_barang_masuk = barang_peruangan.id_barang_masuk JOIN barang ON barang.id = barang_masuk.id_barang JOIN guru ON guru.id = barang_peruangan.id_guru WHERE tgl_pinjam BETWEEN '$dari' AND '$sampai' AND guru.id = $id AND ruangan = '$ruangan'");
 //you get result as an array in here but fetch your result however you feel to
 $result = $query->getResultArray();
 }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body onload="window.print()">
  <table width="100%">
    <tbody>
      <td width="30%">
        <img src="<?= base_url() ?>/public/images/pemko.png" alt="" width="100%" height="80%">
      </td>
      <td width="40%">
        <pre align="center">
<b style="font-size: 10px;">PEMERINTAH KOTA BANJARMASIN
DINAS PENDIDIKAN</b>
<b style="font-size: 15px;">SDN KELAYAN SELATAN 1</b>
<b style="font-size: 10px;">JL.TEMBUS MANTUIL GANG SARTIKA RT.19 No.61</b>
<b style="font-size: 10px;">BANJARMASIN</b>
            </pre>
      </td>
      <td width="30%">
        <img src="<?= base_url() ?>/public/images/sd.png" alt="" width="100%" height="80%">
      </td>
    </tbody>
  </table>
  <hr>
  <div align="center">
    <b align="center">DATA BARANG PAKAI</td></b>
  </div>
  <hr>
<pre>
Laporan barang pada ruangan <?= $ruangan?>

Dari tanggal <?= $dari?> - <?= $sampai?>
</pre>
  <table border="1" style="border-collapse: collapse;" width="100%">
    <thead>
    
                <th>NO</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Merek Barang</th>
                <th>Tanggal</th>
                <th>Stok</th>
                <th>Dari</th>
                <th>Ruangan</th>
                <th>Status</th>
            
    </thead>
    <tbody>
      <?php
              $no =1;
              foreach($result as $b){
                ?>
       <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $b['kode_barang']?></td>
                            <td><?= $b['nm_barang']?></td>
                            <td><?= $b['merek']?></td>
                            <td><?= date('d-m-Y', strtotime($b['tgl_pinjam']))?></td>
                            <td><?= $b['stok']?></td>
                            <td><?= $b['status']?></td>
                            <td><?= $b['ruangan']?></td>
                            <td><?php
                                if($b['status_r'] == 1){
                                    echo "PAKAI";
                                }else{
                                    echo "SELESAI";
                                }
                            ?></td>
                        </tr>
      <?php
              }
            ?>
    </tbody>
  </table>
</body>

</html>