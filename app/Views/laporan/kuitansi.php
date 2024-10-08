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
        <b align="center"><?= $data ?></td></b>
    </div>
    <hr>
    <table style="font-size: 16px;">
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

</body>

</html>