<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <div class="logo-header" data-background-color="dark">
            <a href="<?= base_url('dashboard') ?>" class="logo">
                <p class="text-white">DISHUB BANJARBARU</p>
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
                if (session()->get('role') == "Admin") {
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
                                if (session()->get('role') == "Admin") {
                                ?>
                                    <li class="<?php if ($hover == 'user') {
                                                    echo 'active';
                                                } ?>">
                                        <a href="<?= base_url('user') ?>">
                                            <span class="sub-item">User</span>
                                        </a>
                                    </li>
                                <?php
                                }
                                ?>
                                <li class="<?php if ($hover == 'Pegawai') {
                                                echo 'active';
                                            } ?>">
                                    <a href="<?= base_url('pegawai') ?>">
                                        <span class="sub-item">Pegawai</span>
                                    </a>
                                </li>
                                <li class="<?php if ($hover == 'Petugas Parkir') {
                                                echo 'active';
                                            } ?>">
                                    <a href="<?= base_url('petugas_parkir') ?>">
                                        <span class="sub-item">Petugas Parkir</span>
                                    </a>
                                </li>
                                <li class="<?php if ($hover == 'Tempat Parkir') {
                                                echo 'active';
                                            } ?>">
                                    <a href="<?= base_url('tempat_parkir') ?>">
                                        <span class="sub-item">Tempat Parkir</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                <?php
                }
                ?>
                <li class="nav-item <?php if ($hover == 'Retribusi Parkir') {
                                        echo 'active';
                                    } ?>">
                    <a href="<?= base_url('retribusi_parkir') ?>">
                        <i class="fas fa-car"></i>
                        <p>Retribusi Parkir</p>
                    </a>
                </li>
                <li class="nav-item <?php if ($hover == 'Pengaduan') {
                                        echo 'active';
                                    } ?>">
                    <a href="<?= base_url('pengaduan') ?>">
                        <i class="fas fa-users"></i>
                        <p>Pengaduan</p>
                    </a>
                </li>
                <li class="nav-item <?php if ($hover == 'Izin Parkir') {
                                        echo 'active';
                                    } ?>">
                    <a href="<?= base_url('izin_parkir') ?>">
                        <i class="fas fa-users"></i>
                        <p>Izin Parkir</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>