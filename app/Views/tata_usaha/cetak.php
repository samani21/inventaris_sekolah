<?php
 $db = db_connect();
 $query = $db->query("SELECT * FROM guru WHERE nip LIKE '%".$cari."%' OR nama LIKE '%".$cari."%' OR wakel LIKE '%".$cari."%'");
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
    <b align="center">DATA GURU</td></b>
  </div>
  <hr>
  <table border="1" style="border-collapse: collapse;" width="100%">
    <thead>
      <th>No</th>
      <th>NIP</th>
      <th>Nama</th>
      <th>TTL</th>
      <th>Jenis Kelamin</th>
      <th>Agama</th>
      <th>NO hp</th>
      <th>wakel</th>
    </thead>
    <tbody>
      <?php
              $no =1;
              foreach($result as $r){
                ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= $r['nip'] ?></td>
        <td><?= $r['nama'] ?></td>
        <td><?= $r['tempat'] ?>, <?= $r['t_lahir'] ?></td>
        <td><?= $r['j_kelamin'] ?></td>
        <td><?= $r['agama'] ?></td>
        <td><?= $r['no_hp'] ?></td>
        <td><?= $r['wakel'] ?></td>
      </tr>
      <?php
              }
            ?>
    </tbody>
  </table>
</body>

</html>