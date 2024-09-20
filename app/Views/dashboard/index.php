<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>

<div class="container">
    <canvas id="myChart" width="400" height="200"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data dari PHP
    var pengaduanData = <?= $pengaduan ?>;
    var izinParkirData = <?= $izinParkir ?>;

    // Buat array kosong untuk bulan
    var labels = [];
    var dataPengaduan = [];
    var dataIzinParkir = [];

    // Isi data pengaduan
    pengaduanData.forEach(function (item) {
        labels.push('Bulan ' + item.bulan);
        dataPengaduan.push(item.jumlah_pengaduan);
    });

    // Isi data izin parkir
    izinParkirData.forEach(function (item) {
        dataIzinParkir.push(item.jumlah_izin);
    });

    // Buat chart
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Jumlah Pengaduan',
                    data: dataPengaduan,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: false
                },
                {
                    label: 'Jumlah Izin Parkir',
                    data: dataIzinParkir,
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 2,
                    fill: false
                }
            ]
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

<?= $this->endSection() ?>
