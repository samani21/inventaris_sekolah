<?php
 $db = db_connect();
 $query = $db->query("SELECT * FROM barang_masuk JOIN barang ON barang.id = barang_masuk.id_barang WHERE tgl BETWEEN '$dari' AND '$sampai'");
 //you get result as an array in here but fetch your result however you feel to
 $result = $query->getResultArray();

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
    <b align="center">DATA SUMBER BARANG</td></b>
  </div>
  <hr>
<pre>
Laporan Sumber barang dari tanggal <?= $dari ?> - <?= $sampai?>
</pre>
  <table border="1" style="border-collapse: collapse;" width="100%">
    <thead>
      <th>No</th>
      <th>Kode Barang</th>
      <th>Nama Barang</th>
      <th>Merek Barang</th>
      <th>Tanggal</th>
      <th>Satuan</th>
      <th>Jumlah</th>
      <th>Dari</th>
    </thead>
    <tbody>
      <?php
              $no =1;
              foreach($result as $r){
                ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= $r['kode_barang'] ?></td>
        <td><?= $r['nm_barang'] ?></td>
        <td><?= $r['merek'] ?></td>
        <td><?= date('d-m-Y', strtotime($r['tgl'])) ?></td>
        <td><?= $r['satuan'] ?></td>
        <td><?= $r['total'] ?></td>
        <td><?= $r['status'] ?></td>
      </tr>
      <?php
              }
            ?>
    </tbody>
  </table>
</body>

</html>