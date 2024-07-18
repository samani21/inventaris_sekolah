<?php
function transformTableNama($tableName)
{
    // Remove 'tb' and replace '_' with capitalized letter
    $tableName = str_replace('tb_', '', $tableName);
    $tableName = ucwords(str_replace('_', ' ', $tableName));

    return $tableName;
}

?>
<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
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
                <li class="nav-item
                <?php
                if ($page == "user" || $page == "barang" || $page == "tata_usaha" || $page == "kelas" || $page == "ruangan") {
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
                            <li class="<?php if ($hover == 'Pengguna') {
                                            echo 'active';
                                        } ?>">
                                <a href="<?= base_url('user') ?>">
                                    <span class="sub-item">User</span>
                                </a>
                            </li>
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
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
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
        </div>
    </div>
</div>