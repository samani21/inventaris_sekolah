<?php
 $db = db_connect();
 $query = $db->query("SELECT * FROM barang_masuk JOIN barang ON barang.id = barang_masuk.id_barang WHERE tgl BETWEEN '$dari' AND '$sampai' AND status = 'Pemerintah'");
 //you get result as an array in here but fetch your result however you feel to
 $result = $query->getResultArray();

 $query1 = $db->query("SELECT SUM(harga) as total FROM barang_masuk JOIN barang ON barang.id = barang_masuk.id_barang WHERE tgl BETWEEN '$dari' AND '$sampai' AND status = 'Pemerintah'");
 //you get result as an array in here but fetch your result however you feel to
 $row = $query1->getRow();
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
    <b align="center">DATA BARANG MASUK PEMERINTAH</td></b>
  </div>
  <hr>
  <table border="1" style="border-collapse: collapse;" width="100%">
    <thead>
      <th>No</th>
      <th>Nama Barang</th>
      <th>Tanggal</th>
      <th>Satuan</th>
      <th>Jumlah</th>
      <th>Harga</th>
    </thead>
    <tbody>
      <?php
              $no =1;
              foreach($result as $r){
                ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= $r['nm_barang'] ?></td>
        <td><?= date('d-m-Y', strtotime($r['tgl'])) ?></td>
        <td><?= $r['satuan'] ?></td>
        <td><?= $r['total'] ?></td>
        <td><?= $hasil_rupiah = "Rp " . number_format($r['harga'],2,',','.');?></td>
      </tr>
      <?php
              }
            ?>
        <tr>
            <td colspan="5">Total</td>
            <td><?= $hasil_rupiah = "Rp " . number_format($row->total,2,',','.'); ?></td>
        </tr>
    </tbody>
  </table>
</body>

</html>