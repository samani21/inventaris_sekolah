<?php

$db = \Config\Database::connect();

function transformTableNama($tableName)
{
    // Remove 'tb' and replace '_' with capitalized letter
    $tableName = str_replace('tb_', '', $tableName);
    $tableName = ucwords(str_replace('_', ' ', $tableName));

    return $tableName;
}
$query = $db->query('SELECT * FROM kelas');
$results = $query->getResultArray();
?>
<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <div class="logo-header" data-background-color="dark">
            <a href="<?= base_url('dashboard') ?>" class="logo">
                <p class="text-white">SDN KELAYAN SELATAN 1</p>
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item <?php if ($hover == 'Dashboard') {
                                        echo 'active';
                                    } ?>">
                    <a href="<?= base_url('dashboard') ?>">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <?php
                if (session()->get('level') == "Admin" || session()->get('level') == "Tata Usaha") {
                ?>
                    <li class="nav-item
                <?php
                    if ($page == "user" || $page == "barang" || $page == "mapel" || $page == "tata_usaha" || $page == "kelas" || $page == "ruangan") {
                        echo "active";
                    }
                ?>
                ">
                        <a data-bs-toggle="collapse" href="#master">
                            <i class="fas fa-layer-group"></i>
                            <p>Master</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="master">
                            <ul class="nav nav-collapse">
                                <?php
                                if (session()->get('level') == "Admin") {
                                ?>
                                    <li class="<?php if ($hover == 'Pengguna') {
                                                    echo 'active';
                                                } ?>">
                                        <a href="<?= base_url('user') ?>">
                                            <span class="sub-item">User</span>
                                        </a>
                                    </li>
                                <?php
                                }
                                ?>
                                <li class="<?php if ($hover == 'Barang') {
                                                echo 'active';
                                            } ?>">
                                    <a href="<?= base_url('barang') ?>">
                                        <span class="sub-item">Barang</span>
                                    </a>
                                </li>
                                <li class="<?php if ($hover == 'Tata Usaha') {
                                                echo 'active';
                                            } ?>">
                                    <a href="<?= base_url('tata_usaha') ?>">
                                        <span class="sub-item">Tata Usaha & Guru</span>
                                    </a>
                                </li>
                                <li class="<?php if ($hover == 'Kelas') {
                                                echo 'active';
                                            } ?>">
                                    <a href="<?= base_url('kelas') ?>">
                                        <span class="sub-item">Kelas</span>
                                    </a>
                                </li>
                                <li class="<?php if ($hover == 'Ruangan') {
                                                echo 'active';
                                            } ?>">
                                    <a href="<?= base_url('ruangan') ?>">
                                        <span class="sub-item">Ruangan</span>
                                    </a>
                                </li>
                                <li class="<?php if ($hover == 'Tahun Ajaran') {
                                                echo 'active';
                                            } ?>">
                                    <a href="<?= base_url('tahun_ajaran') ?>">
                                        <span class="sub-item">Tahun Ajaran</span>
                                    </a>
                                </li>
                                <li class="<?php if ($hover == 'Metode') {
                                                echo 'active';
                                            } ?>">
                                    <a href="<?= base_url('metode') ?>">
                                        <span class="sub-item">Metode</span>
                                    </a>
                                </li>
                                <li class="<?php if ($hover == 'Media') {
                                                echo 'active';
                                            } ?>">
                                    <a href="<?= base_url('media') ?>">
                                        <span class="sub-item">Media</span>
                                    </a>
                                </li>
                                <li class="<?php if ($hover == 'Ekstrakurikuler') {
                                                echo 'active';
                                            } ?>">
                                    <a href="<?= base_url('ekskul') ?>">
                                        <span class="sub-item">Ekstrakurikuler</span>
                                    </a>
                                </li>
                                <li class="<?php if ($hover == 'Mapel') {
                                                echo 'active';
                                            } ?>">
                                    <a href="<?= base_url('mapel') ?>">
                                        <span class="sub-item">Mapel</span>
                                    </a>
                                </li>
                                <li class="<?php if ($hover == 'Siswa') {
                                                echo 'active';
                                            } ?>">
                                    <a href="<?= base_url('siswa') ?>">
                                        <span class="sub-item">Siswa</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                <?php
                }
                ?>
                <?php
                if (session()->get('level') == "Admin" || session()->get('level') == "Guru" || session()->get('level') == "Tata Usaha") {
                ?>
                    <?php
                    if (session()->get('level') == "Admin"  || session()->get('level') == "Tata Usaha") {
                    ?>
                        <li class="nav-item 
                <?php
                        if ($page == "sumber_barang" || $page == "barang_baik" || $page == "barang_rusak") {
                            echo "active";
                        }
                ?>">
                            <a data-bs-toggle="collapse" href="#barang">
                                <i class="fa fa-archive"></i>
                                <p>Barang</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="barang">
                                <ul class="nav nav-collapse">
                                    <li class="<?php if ($hover == 'Sumber Barang') {
                                                    echo 'active';
                                                } ?>">
                                        <a href="<?= base_url('sumber_barang') ?>">
                                            <span class="sub-item">Sumber Barang</span>
                                        </a>
                                    </li>
                                    <li class="<?php if ($hover == 'Barang Rusak') {
                                                    echo 'active';
                                                } ?>">
                                        <a href="<?= base_url('barang_rusak') ?>">
                                            <span class="sub-item">Barang Rusak</span>
                                        </a>
                                    </li>
                                    <li class="<?php if ($hover == 'Barang Baik') {
                                                    echo 'active';
                                                } ?>">
                                        <a href="<?= base_url('barang_baik') ?>">
                                            <span class="sub-item">Barang Baik</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    <?php
                    }
                    ?>
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#ruangan">
                            <i class="fa fa-bookmark"></i>
                            <p>barang Peruangan</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="ruangan">
                            <ul class="nav nav-collapse">
                                <?php

                                $query = $db->query('SELECT * FROM ruangan');
                                $results = $query->getResultArray();
                                foreach ($results as $kel) {
                                ?>
                                    <li class="<?php if ($hover == $kel['nm_ruangan']) {
                                                    echo 'active';
                                                } ?>">
                                        <a href="<?= base_url('barang_peruangan/' . str_replace(' ', '_', $kel['nm_ruangan'])) ?>">
                                            <span class="sub-item"><?= $kel['nm_ruangan'] ?></span>
                                        </a>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </li>
                <?php
                }
                ?>
                <?php
                if (session()->get('level') == "Admin" || session()->get('level') == "Guru" || session()->get('level') == "Tata Usaha" || session()->get('level') == "Kepala Sekolah") {
                ?>
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#kinerjaGuru">
                            <i class="fa fa-tasks" aria-hidden="true"></i>
                            <p>Kinerja Guru</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="kinerjaGuru">
                            <ul class="nav nav-collapse">
                                <li class="<?php if ($hover == "Persiapan dan Perancanaan Pembelajaran") {
                                                echo 'active';
                                            } ?>">
                                    <a href="<?= base_url('/perancaan_persiapan_pembelajaran') ?>">
                                        <span class="sub-item">Persiapan dan Perancanaan Pembelajaran</span>
                                    </a>
                                </li>
                                <li class="<?php if ($hover == "Pelaksanaan Pembelajaran") {
                                                echo 'active';
                                            } ?>">
                                    <a href="<?= base_url('/pelaksanaan_pembelajaran') ?>">
                                        <span class="sub-item">Pelaksanaan Pembelajaran</span>
                                    </a>
                                </li>
                                <li class="<?php if ($hover == "Penilaian Guru") {
                                                echo 'active';
                                            } ?>">
                                    <a href="<?= base_url('/penilaian_guru') ?>">
                                        <span class="sub-item">Penilaian Guru</span>
                                    </a>
                                </li>
                                <li class="<?php if ($hover == "Inovasi Guru") {
                                                echo 'active';
                                            } ?>">
                                    <a href="<?= base_url('/inovasi_guru') ?>">
                                        <span class="sub-item">Inovasi Guru</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                <?php
                }
                ?>
                <?php
                if (session()->get('level') == "Admin" || session()->get('level') == "Guru" || session()->get('level') == "Siswa") {
                ?>
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#kelas">
                            <i class="fa fa-server"></i>
                            <p>Absen dan nilai</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="kelas">
                            <ul class="nav nav-collapse">
                                <?php

                                $query = $db->query('SELECT * FROM kelas');
                                $results = $query->getResultArray();
                                foreach ($results as $kel) {
                                ?>
                                    <li class="<?php if ($hover == $kel['nama_kelas']) {
                                                    echo 'active';
                                                } ?>">
                                        <a href="<?= base_url('siswa_perkelas/' . str_replace(' ', '_', $kel['nama_kelas']) . '/absen_nilai') ?>">
                                            <span class="sub-item"><?= $kel['nama_kelas'] ?></span>
                                        </a>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#semester">
                            <i class="fa fa-random" aria-hidden="true"></i>
                            <p>Nilai Semester</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="semester">
                            <ul class="nav nav-collapse">
                                <?php

                                $query = $db->query('SELECT * FROM kelas');
                                $results = $query->getResultArray();
                                foreach ($results as $kel) {
                                ?>
                                    <li class="<?php if ($hover == $kel['nama_kelas']) {
                                                    echo 'active';
                                                } ?>">
                                        <a href="<?= base_url('siswa_perkelas/' . str_replace(' ', '_', $kel['nama_kelas']) . '/ujian') ?>">
                                            <span class="sub-item"><?= $kel['nama_kelas'] ?></span>
                                        </a>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#kegiatan">
                            <i class="fa fa-server"></i>
                            <p>Ekstrakurikuler</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="kegiatan">
                            <ul class="nav nav-collapse">
                                <?php

                                $query = $db->query('SELECT * FROM ekskul');
                                $results = $query->getResultArray();
                                foreach ($results as $kel) {
                                ?>
                                    <li class="<?php if ($hover == $kel['kegiatan']) {
                                                    echo 'active';
                                                } ?>">
                                        <a href="<?= base_url('ekstrakurikuler/' . str_replace(' ', '_', $kel['kegiatan']) . '') ?>">
                                            <span class="sub-item"><?= $kel['kegiatan'] ?></span>
                                        </a>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item <?php if ($hover == 'Bimbingan dan Konseling') {
                                            echo 'active';
                                        } ?>">
                        <a href="<?= base_url('bimbingan_konseling') ?>">
                            <i class="fa fa-puzzle-piece" aria-hidden="true"></i>
                            <p>Bimbingan dan Konseling</p>
                        </a>
                    </li>
                    <?php
                    if (session()->get('level') == "Tata Usaha") {
                    ?>
                        <li class="nav-item <?php if ($hover == 'Prestasi Siswa') {
                                                echo 'active';
                                            } ?>">
                            <a href="<?= base_url('prestasi_siswa') ?>">
                                <i class="fas fa-star"></i>
                                <p>Prestasi Siswa</p>
                            </a>
                        </li>
                    <?php
                    }
                    if (session()->get('level') == "Admin"  || session()->get('level') == "Tata Usaha" || session()->get('level') == "Kepala Sekolah") {
                    ?>
                        <li class="nav-item <?php if ($hover == 'Prestasi Guru') {
                                                echo 'active';
                                            } ?>">
                            <a href="<?= base_url('prestasi_guru') ?>">
                                <i class="fas fa-star"></i>
                                <p>Prestasi Guru</p>
                            </a>
                        </li>
                        <li class="nav-item <?php if ($hover == 'Kinerja Guru') {
                                                echo 'active';
                                            } ?>">
                            <a href="<?= base_url('kinerja_guru') ?>">
                                <i class="fa fa-user"></i>
                                <p>Kinerja Guru</p>
                            </a>
                        </li>
                    <?php
                    }
                    ?>

                <?php
                }
                ?>
                <li class="nav-item <?php if ($hover == 'Jadwal Kelas') {
                                        echo 'active';
                                    } ?>">
                    <a href="<?= base_url('jadwal_kelas') ?>">
                        <i class="fa fa-clock"></i>
                        <p>Jadwal kelas</p>
                    </a>
                </li>
                <?php
                if (session()->get('level') == "Admin" || session()->get('level') == "Guru" || session()->get('level') == "Kepala Sekolah" || session()->get('level') == "Tata Usaha") {
                ?>
                    <li class="nav-item <?php if ($hover == 'Agenda') {
                                            echo 'active';
                                        } ?>">
                        <a href="<?= base_url('agenda') ?>">
                            <i class="fa fa-calendar"></i>
                            <p>Agenda</p>
                        </a>
                    </li>
                <?php
                }
                ?>
                <li class="nav-item <?php if ($hover == 'Sekolah') {
                                        echo 'active';
                                    } ?>">
                    <a href="<?= base_url('sekolah') ?>">
                        <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                        <p>Sekolah</p>
                    </a>
                </li>
                <li class="nav-item 
                <?php
                if ($page == "sumber_barang" || $page == "barang_baik" || $page == "barang_rusak") {
                    echo "active";
                }
                ?>">
                    <a data-bs-toggle="collapse" href="#laporan">
                        <i class="fa fa-info"></i>
                        <p>Laporan</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="laporan">
                        <ul class="nav nav-collapse">
                            <li class="<?php if ($hover == "Persiapan dan Perancanaan Pembelajaran") {
                                            echo 'active';
                                        } ?>">
                                <a href="<?= base_url('perancaan_persiapan_pembelajaran/report') ?>">
                                    <span class="sub-item">Persiapan dan Perancanaan Pembelajaran</span>
                                </a>
                            </li>
                            <li class="<?php if ($hover == "Pelaksanaan Pembelajaran") {
                                            echo 'active';
                                        } ?>">
                                <a href="<?= base_url('pelaksanaan_pembelajaran/report') ?>">
                                    <span class="sub-item">Pelaksanaan Pembelajaran</span>
                                </a>
                            </li>
                            <li class="<?php if ($hover == "Penilaian Guru") {
                                            echo 'active';
                                        } ?>">
                                <a href="<?= base_url('penilaian_guru/report') ?>">
                                    <span class="sub-item">Penilaian Guru</span>
                                </a>
                            </li>
                            <li class="<?php if ($hover == "Inovasi Guru") {
                                            echo 'active';
                                        } ?>">
                                <a href="<?= base_url('inovasi_guru/report') ?>">
                                    <span class="sub-item">Inovasi Guru</span>
                                </a>
                            </li>
                            <li class="<?php if ($hover == "Jadwal Kelas") {
                                            echo 'active';
                                        } ?>">
                                <a href="<?= base_url('jadwal_kelas/report') ?>">
                                    <span class="sub-item">Jadwal Kelas</span>
                                </a>
                            </li>
                            <li class="<?php if ($hover == "Agenad") {
                                            echo 'active';
                                        } ?>">
                                <a href="<?= base_url('agenda/report') ?>">
                                    <span class="sub-item">Agenda</span>
                                </a>
                            </li>
                            <li class="<?php if ($hover == "Bimbingan dan Konseling") {
                                            echo 'active';
                                        } ?>">
                                <a href="<?= base_url('bimbingan_konseling/report') ?>">
                                    <span class="sub-item">Bimbingan dan Konseling</span>
                                </a>
                            </li>
                            <li class="<?php if ($hover == "Prestasi Siswa") {
                                            echo 'active';
                                        } ?>">
                                <a href="<?= base_url('prestasi_siswa/report') ?>">
                                    <span class="sub-item">Prestasi Siswa</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>