<?php
function convertColumnName($columnName)
{
    // Replace underscores with spaces
    $columnName = str_replace('_', ' ', $columnName);
    // Capitalize the first letter of each word
    return ucwords($columnName);
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
    <div>
        <table width="100%" style="height: 100%;">
            <tbody>
                <td width=" 30%">
                    <img src="<?= base_url() ?>/public/images/pemko.png" alt="" width="100%" height="80%">
                </td>
                <td width="40%">
                    <pre align="center">
<b style="font-size: 20px;">PEMERINTAH KOTA BANJARMASIN
DINAS PENDIDIKAN</b>
<b style="font-size: 30px;">SDN KELAYAN SELATAN 1</b>
<b style="font-size: 20px;">JL.TEMBUS MANTUIL GANG SARTIKA RT.19 No.61</b>
<b style="font-size: 20px;">BANJARMASIN</b>
            </pre>
                </td>
                <td width="30%">
                    <img src="<?= base_url() ?>/public/images/sd.png" alt="" width="100%" height="80%">
                </td>
            </tbody>
        </table>
    </div>
    <hr>
    <div align="center">
        <b align="center" style="font-size: 30px;"><?= $data ?></td></b>
    </div>
    <hr>
    <table>
        <tr align="left">
            <th>NIS</th>
            <th>:</th>
            <td><?= $rowSiswa['nis'] ?></td>
        </tr>
        <tr align="left">
            <th>Nama</th>
            <th>:</th>
            <td><?= $rowSiswa['nama'] ?></td>
        </tr>
        <tr align="left">
            <th>Kelas</th>
            <th>:</th>
            <td><?= $rowKelas['nama_kelas'] ?></td>
        </tr>
        <tr align="left">
            <th>Tahun</th>
            <th>:</th>
            <td><?= $dt['tahun'] ?></td>
        </tr>
        <tr align="left">
            <th>Semester</th>
            <th>:</th>
            <td><?= $dt['semester'] ?></td>
        </tr>
    </table>

    <h3>Nilai Akademik</h3>
    <table style="font-size: 24px; border-collapse: collapse;" border="1" width="100%">
        <tr>
            <th>NO</th>
            <th>Mapel</th>
            <th>Nilai</th>
        </tr>
        <?php
        $no = 1;
        foreach ($row as $r) {
        ?>
            <tr align="left">
                <td><?= $no++ ?></td>
                <?php
                foreach ($column as $col) {
                ?>
                    <td><?= $r[$col] ?></td>
                <?php
                }
                ?>
                <td><?= floor(($r['nilai_harian'] + $r['pts'] + $r['pas']) / 3) ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
    <h3>Ekstrakurikuler</h3>
    <table style="font-size: 24px; border-collapse: collapse;" border="1" width="100%">
        <tr>
            <th>NO</th>
            <th>Kegiatan Ekstrakurikuler</th>
        </tr>
        <?php
        $noE = 1;
        foreach ($rowEkskul as $r) {
        ?>
            <tr align="left">
                <td><?= $noE++ ?></td>
                <td><?= $r['kegiatan'] ?></td>
            </tr>
        <?php
        }
        ?>
</body>

</html>