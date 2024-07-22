<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
    <div>
        <h3 class="fw-bold mb-3">Dashboard</h3>
    </div>
</div>
<?php
if (session()->get('level') == "Siswa") {
?>
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Radar Chart</div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="myNilai"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
} else {
?>
    <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Seluruh Siswa</p>
                                <h4 class="card-title"><?= $jumlahSiSwa ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-info bubble-shadow-small">
                                <i class="fas fa-user-check"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Siswa Aktif Sekarang</p>
                                <h4 class="card-title"><?= $jumlahSiSwaPerkelas ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-success bubble-shadow-small">
                                <i class="fas fa-luggage-cart"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Guru Pengajar</p>
                                <h4 class="card-title"><?= $jumlahGuru ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                <i class="far fa-check-circle"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Tata Usaha</p>
                                <h4 class="card-title"><?= $jumlahTataUsaha ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Line Chart</div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Line Chart</div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="mySiswa"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<?php
if (session()->get('level') == "Siswa") {
?>
    <script>
        const ctxN = document.getElementById('myNilai').getContext('2d');
        new Chart(ctxN, {
            type: 'radar',
            data: {
                labels: [
                    <?php
                    $db = \Config\Database::connect();
                    $query = $db->query('SELECT 
    siswa.id AS siswa_id, 
    siswa.nama, 
    mapel.id AS mapel_id, 
    AVG(nilai.nilai) AS rata_rata_nilai,
    AVG(nilai_ujian.nilai) AS rata_rata_nilai_ujian, 
    AVG(COALESCE(nilai.nilai, 0) + COALESCE(nilai_ujian.nilai, 0)) AS total_rata_rata_nilai,
    mapel.nama_mapel
FROM 
    siswa_perkelas 
JOIN 
    siswa ON siswa.id = siswa_perkelas.id_siswa 
JOIN 
    absen_siswa ON siswa_perkelas.id = absen_siswa.id_siswa_perkelas 
LEFT JOIN 
    nilai ON absen_siswa.id = nilai.id_absen_siswa 
LEFT JOIN 
    nilai_ujian ON absen_siswa.id = nilai_ujian.id_absen_siswa 
JOIN 
    mapel ON absen_siswa.id_mapel = mapel.id WHERE absen_siswa.id_tahun_ajaran = 4
GROUP BY 
    siswa.id, 
    siswa.nama, 
    mapel.id, 
    mapel.nama_mapel
ORDER BY 
    siswa.id');
                    $results = $query->getResultArray();
                    $labels = [];
                    foreach ($results as $br) {
                        $labels[] = '"' . $br['nama_mapel'] . '"';
                    }
                    echo implode(',', $labels);
                    ?>
                ],
                datasets: [{
                    label: 'Total Rata-rata Nilai',
                    data: [
                        <?php
                        $data = [];
                        foreach ($results as $br) {
                            $data[] = $br['total_rata_rata_nilai']; // Sesuaikan dengan field yang ingin Anda gunakan
                        }
                        echo implode(',', $data);
                        ?>
                    ],
                    borderWidth: 1,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    pointBackgroundColor: 'rgba(54, 162, 235, 1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(54, 162, 235, 1)'
                }]
            },
            options: {
                scales: {
                    r: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

<?php
} else {
?>
    <script>
        const ctx = document.getElementById('myChart');
        const ctxs = document.getElementById('mySiswa');


        new Chart(ctx, {
            type: 'line',
            data: {
                labels: [
                    <?php
                    $db = \Config\Database::connect();
                    $query = $db->query('SELECT nama_barang,SUM(barang_masuk.total) as jumlah_barang FROM `barang_masuk` JOIN barang ON barang.id = barang_masuk.id_barang GROUP BY barang.id ORDER BY barang.nama_barang');
                    $results = $query->getResultArray();
                    $labels = [];
                    foreach ($results as $br) {
                        $labels[] = '"' . $br['nama_barang'] . '"';
                    }
                    echo implode(',', $labels);
                    ?>
                ],
                datasets: [{
                    label: '# Barang',
                    data: [
                        <?php
                        $data = [];
                        foreach ($results as $br) {
                            $data[] = $br['jumlah_barang']; // Sesuaikan dengan field yang ingin Anda gunakan
                        }
                        echo implode(',', $data);
                        ?>
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        new Chart(ctxs, {
            type: 'line',
            data: {
                labels: [
                    <?php
                    $db = \Config\Database::connect();
                    $query = $db->query('SELECT COUNT(semester) as jumlah_siswa,tahun,semester FROM `siswa_perkelas` JOIN tahun_ajaran ON tahun_ajaran.id = siswa_perkelas.id_tahun_ajaran GROUP BY semester,tahun,semester');
                    $results = $query->getResultArray();
                    $labels = [];
                    foreach ($results as $br) {
                        $labels[] = '"' . $br['tahun'] . ' Sem ' . $br['semester'] . '"';
                    }
                    echo implode(',', $labels);
                    ?>
                ],
                datasets: [{
                    label: '# Barang',
                    data: [
                        <?php
                        $data = [];
                        foreach ($results as $br) {
                            $data[] = $br['jumlah_siswa']; // Sesuaikan dengan field yang ingin Anda gunakan
                        }
                        echo implode(',', $data);
                        ?>
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

<?php
}
?>

<?= $this->endSection() ?>