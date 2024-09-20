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
                    <img src="<?= base_url() ?>/public/images/banjarbaru.png" alt="" width="80%" height="80%">
                </td>
                <td width="40%">
                    <pre align="center">
<b style="font-size: 15px;">PEMERINTAH KOTA BANJARBARU</b>
<b style="font-size: 30px;">DINAS PERHUBUNGAN</b>
<b style="font-size: 15px;">UNIT PELAYANAN TEKNIS PENGELOLAAN PERPARKIRAN</b>
<b style="font-size: 12px;">ALAMAT : JL.Jendral Sudirman No 3 Telp/Fax (0511)6749304 Banjarbaru 70713</b>
            </pre>
                </td>
                <td width="30%">
                    <img src="<?= base_url() ?>/public/images/dishub.png" alt="" width="80%" height="80%">
                </td>
            </tbody>
        </table>
    </div>
    <hr>
    <div align="center">
        <b align="center" style="font-size: 30px;"><?= $data ?></td></b>
    </div>
    <hr>
    <table style="font-size: 24px;">
        <?php
        foreach ($column as $col) {
        ?>
            <tr align="left">
                <th>
                    <h4><?= convertColumnName($col) ?></h4>
                </th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th>:</th>
                <td>
                    <p><?= $row[$col] ?></p>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
    <br><br><br>
    <pre style="font-size: 24px;">
                                                    Banjarmasin, <?= $row['tanggal']; ?>







                                                                                                        

                                                    <?= $ttd['nama'] ?>

                                                    <?= $ttd['nik'] ?>
    </pre>
</body>

</html>