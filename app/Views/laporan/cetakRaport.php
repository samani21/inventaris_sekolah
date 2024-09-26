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
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <th>Nama</th>
            <th>:</th>
            <td><?= $rowSiswa['nama'] ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <th>Kelas</th>
            <th>:</th>
            <td><?= $rowKelas['nama_kelas'] ?></td>
        </tr>
        <tr align="left">
            <th>Tahun</th>
            <th>:</th>
            <td><?= $dt['tahun'] ?></td>
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
        $total = 0;
        $row_count = count($row); // Count the number of rows for average calculation if needed

        foreach ($row as $r) {
        ?>
            <tr align="left">
                <td><?= $no++ ?></td>
                <?php
                foreach ($column as $col) {
                ?>
                    <td><?= htmlspecialchars($r[$col]) ?></td>
                <?php
                }
                ?>
                <td>
                    <?php
                    // Check if the values are set and numeric
                    $nilai_harian = isset($r['nilai_harian']) && is_numeric($r['nilai_harian']) ? $r['nilai_harian'] : 0;
                    $pts = isset($r['pts']) && is_numeric($r['pts']) ? $r['pts'] : 0;
                    $pas = isset($r['pas']) && is_numeric($r['pas']) ? $r['pas'] : 0;

                    // Calculate the average
                    $average = ($nilai_harian + $pts + $pas) / 3;

                    // Output the floored average
                    echo floor($average);

                    // Add to total
                    $total += $average;
                    ?>
                </td>
            </tr>
        <?php
        }
        ?>

        <!-- Optionally, you can calculate the overall average of all rows if needed -->
        <tr align="left">
            <td colspan="<?= count($column) + 1 ?>">Nilai Rata Rata</td>
            <?php
            if ($total != 0) {
            ?>
                <td><?= floor($total / $row_count) ?></td>
            <?php
            }
            ?>
        </tr>
    </table>
    <?php
    if ($dt['semester'] == 2) {
        if ($total != 0) {
            if (floor($total / $row_count) > 60) {
    ?>
                <table>
                    <td>
                        <p style="text-decoration: line-through;">Tidak naik kelas.</p>
                    </td>
                    <td>/</td>
                    <td>
                        <p> naik kelas.</p>
                    </td>
                </table>
            <?php
            } else {
            ?>
                <table>
                    <td>
                        <p>Tidak naik kelas.</p>
                    </td>
                    <td>/</td>
                    <td>
                        <p style="text-decoration: line-through;"> naik kelas.</p>
                    </td>
                </table>
    <?php
            }
        }
    }
    ?>
    <h3>Kehadiran Siswa</h3>
    <table style="font-size: 24px; border-collapse: collapse;" border="1" width="100%">
        <tr>
            <th>Hadir</th>
            <th>Ijin</th>
            <th>Sakit</th>
            <th>Alpa</th>
        </tr>
        <tr>
            <th><?= $rowAbsen['hadir'] ?></th>
            <th><?= $rowAbsen['ijin'] ?></th>
            <th><?= $rowAbsen['sakit'] ?></th>
            <th><?= $rowAbsen['alpa'] ?></th>
        </tr>
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
    </table>
</body>

</html>