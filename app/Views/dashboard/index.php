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
    <?php
    if (session()->get('level') == "Guru") {
    ?>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Pie Chart Total Penilaian</div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="pieChart" style="width: 100%; height: 100%"></canvas>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } else {
    ?>
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
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Multiple Line Chart Penilaian Kinerja Guru</div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="multipleLineChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
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
} else if (session()->get('level') == "Guru") {
?>
    <script>
        pieChart = document.getElementById("pieChart").getContext("2d");
        var myPieChart = new Chart(pieChart, {
            type: "doughnut",
            data: {
                datasets: [{
                    data: [<?= $perancanaan ?>, <?= $pelaksanaan ?>, <?= $sikap ?>, <?= $inovasi ?>],
                    backgroundColor: ["#1d7af3", "#f3545d", "#fdaf4b", "#3CB371"],
                    borderWidth: 0,
                }, ],
                labels: ["Perancanaan", "Pelaksanaan", "Sikap", 'Inovasi'],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: "bottom",
                    labels: {
                        fontColor: "rgb(154, 154, 154)",
                        fontSize: 11,
                        usePointStyle: true,
                        padding: 20,
                    },
                },
                pieceLabel: {
                    render: "percentage",
                    fontColor: "white",
                    fontSize: 14,
                },
                tooltips: false,
                layout: {
                    padding: {
                        left: 20,
                        right: 20,
                        top: 20,
                        bottom: 20,
                    },
                },
            },
        });
    </script>
<?php
} else {
?>
    <script>
        const ctx = document.getElementById('myChart');
        const ctxs = document.getElementById('mySiswa');
        const ctxg = multipleLineChart = document
            .getElementById("multipleLineChart")
            .getContext("2d");

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
        <?php
        $db = \Config\Database::connect();
        $query = $db->query("SELECT guru.*, users.level FROM guru JOIN users ON users.id = guru.user_id WHERE users.level = 'Guru'");
        $results = $query->getResultArray();

        $labels = [];
        $angkaPerancanaan = [];
        $angkaPelaksanaan = [];
        $angkaSikap = [];
        $angkaInovasi = [];
        foreach ($results as $br) {
            $labels[] = '"' . $br['nama'] . '"';
            $queryCountPerancanaan = $db->query("SELECT * FROM perencanaan_persiapan_pembelajaran WHERE id_guru = " . $br['id'] . " AND id_user_verifikasi > 0 AND id_user_verifikasi IS NOT NULL");
            $angkaPerancanaan[] = count($queryCountPerancanaan->getResultArray());

            $queryCountPelaksanaan = $db->query("SELECT * FROM pelaksanaan_pembelajaran WHERE id_guru = " . $br['id'] . " AND id_user_verifikasi > 0 AND id_user_verifikasi IS NOT NULL");
            $angkaPelaksanaan[] = count($queryCountPelaksanaan->getResultArray());

            $queryCountSikap = $db->query("SELECT * FROM sikap_perilaku_kedisiplinan WHERE id_guru = " . $br['id'] . " AND id_user_verifikasi > 0 AND id_user_verifikasi IS NOT NULL");
            $angkaSikap[] = count($queryCountSikap->getResultArray());

            $queryCountInovasi = $db->query("SELECT * FROM inovasi_guru WHERE id_guru = " . $br['id'] . " AND id_user_verifikasi > 0 AND id_user_verifikasi IS NOT NULL");
            $angkaInovasi[] = count($queryCountInovasi->getResultArray());
        }
        ?>
        new Chart(ctxg, {
            type: "line",
            data: {
                labels: [<?= implode(',', $labels) ?>],
                datasets: [{
                        label: "Perancanaan",
                        borderColor: "#1d7af3",
                        pointBorderColor: "#FFF",
                        pointBackgroundColor: "#1d7af3",
                        pointBorderWidth: 2,
                        pointHoverRadius: 4,
                        pointHoverBorderWidth: 1,
                        pointRadius: 4,
                        backgroundColor: "transparent",
                        fill: true,
                        borderWidth: 2,
                        data: [<?= implode(',', $angkaPerancanaan) ?>],
                    },
                    {
                        label: "Pelaksanaan",
                        borderColor: "#59d05d",
                        pointBorderColor: "#FFF",
                        pointBackgroundColor: "#59d05d",
                        pointBorderWidth: 2,
                        pointHoverRadius: 4,
                        pointHoverBorderWidth: 1,
                        pointRadius: 4,
                        backgroundColor: "transparent",
                        fill: true,
                        borderWidth: 2,
                        data: [<?= implode(',', $angkaPelaksanaan) ?>],
                    },
                    {
                        label: "Sikap",
                        borderColor: "#f3545d",
                        pointBorderColor: "#FFF",
                        pointBackgroundColor: "#f3545d",
                        pointBorderWidth: 2,
                        pointHoverRadius: 4,
                        pointHoverBorderWidth: 1,
                        pointRadius: 4,
                        backgroundColor: "transparent",
                        fill: true,
                        borderWidth: 2,
                        data: [<?= implode(',', $angkaSikap) ?>],
                    },
                    {
                        label: "Inovasi",
                        borderColor: "#DAEE01",
                        pointBorderColor: "#FFF",
                        pointBackgroundColor: "#DAEE01",
                        pointBorderWidth: 2,
                        pointHoverRadius: 4,
                        pointHoverBorderWidth: 1,
                        pointRadius: 4,
                        backgroundColor: "transparent",
                        fill: true,
                        borderWidth: 2,
                        data: [<?= implode(',', $angkaInovasi) ?>],
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: "top",
                },
                tooltips: {
                    bodySpacing: 4,
                    mode: "nearest",
                    intersect: 0,
                    position: "nearest",
                    xPadding: 10,
                    yPadding: 10,
                    caretPadding: 10,
                },
                layout: {
                    padding: {
                        left: 15,
                        right: 15,
                        top: 15,
                        bottom: 15
                    },
                },
            },
        });
    </script>

<?php
}
?>

<?= $this->endSection() ?>