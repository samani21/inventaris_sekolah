<?php
if (!empty(session()->get('id'))) {
    if (session()->get('role') == "Admin" || session()->get('role') == "Petugas Parkir") {
        $db = \Config\Database::connect();
        $user_id = session()->get('id');
        $queryGuru = $db->table('pegawai')->where('user_id', $user_id)->get();
        $resultsGuru = $queryGuru->getRowArray();
        if (isset($resultsGuru)) {
?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                <title>Forms - Kaiadmin Bootstrap 5 Admin Dashboard</title>
                <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
                <link rel="icon" href="<?= base_url('public/') ?>assets/img/kaiadmin/favicon.ico" type="image/x-icon" />

                <!-- Fonts and icons -->
                <script src="<?= base_url('public/') ?>assets/js/plugin/webfont/webfont.min.js"></script>
                <script>
                    WebFont.load({
                        google: {
                            families: ["Public Sans:300,400,500,600,700"]
                        },
                        custom: {
                            families: [
                                "Font Awesome 5 Solid",
                                "Font Awesome 5 Regular",
                                "Font Awesome 5 Brands",
                                "simple-line-icons",
                            ],
                            urls: ["<?= base_url('public/') ?>assets/css/fonts.min.css"],
                        },
                        active: function() {
                            sessionStorage.fonts = true;
                        },
                    });
                </script>

                <!-- CSS Files -->
                <link rel="stylesheet" href="<?= base_url('public/') ?>assets/css/bootstrap.min.css" />
                <link rel="stylesheet" href="<?= base_url('public/') ?>assets/css/plugins.min.css" />
                <link rel="stylesheet" href="<?= base_url('public/') ?>assets/css/kaiadmin.min.css" />

                <!-- CSS Just for demo purpose, don't include it in your project -->
                <link rel="stylesheet" href="<?= base_url('public/') ?>assets/css/demo.css" />
            </head>

            <body>
                <div class="wrapper">
                    <!-- Sidebar -->
                    <?= $this->include('partials/sidebar') ?>
                    <!-- End Sidebar -->

                    <div class="main-panel">
                        <div class="main-header">
                            <div class="main-header-logo">
                                <!-- Logo Header -->
                                <div class="logo-header" data-background-color="dark">
                                    <a href="index.html" class="logo">
                                        <img src="<?= base_url('public/') ?>assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20" />
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
                                <!-- End Logo Header -->
                            </div>
                            <!-- Navbar Header -->
                            <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                                <div class="container-fluid">

                                    <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                                        <li class="nav-item topbar-user dropdown hidden-caret">
                                            <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                                                <div class="avatar-sm">
                                                    <img src="<?= base_url() ?>/public/images/<?= session()->get('foto'); ?>" alt="..." class="avatar-img rounded-circle" />
                                                </div>
                                                <span class="profile-username">
                                                    <span class="op-7">Hi,</span>
                                                    <span class="fw-bold"><?= session()->get('username'); ?></span>
                                                </span>
                                            </a>
                                            <ul class="dropdown-menu dropdown-user animated fadeIn">
                                                <div class="dropdown-user-scroll scrollbar-outer">
                                                    <li>
                                                        <div class="user-box">
                                                            <div class="avatar-lg">
                                                                <img src="<?= base_url() ?>/public/images/<?= session()->get('foto'); ?>" alt="image profile" class="avatar-img rounded" />
                                                            </div>
                                                            <div class="u-text">
                                                                <h4><?= session()->get('level'); ?></h4>
                                                                <p class="text-muted"><?= session()->get('email'); ?></p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="dropdown-divider"></div>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="<?= base_url('profil') ?>">Account Setting</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="<?= base_url('logout') ?>">Logout</a>
                                                    </li>
                                                </div>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                            <!-- End Navbar -->
                        </div>

                        <div class="container">
                            <div class="page-inner">
                                <?= $this->renderSection('content') ?>
                            </div>
                        </div>

                    </div>

                </div>
                <script src="<?= base_url('public/') ?>assets/js/core/jquery-3.7.1.min.js"></script>
                <script src="<?= base_url('public/') ?>assets/js/core/popper.min.js"></script>
                <script src="<?= base_url('public/') ?>assets/js/core/bootstrap.min.js"></script>

                <!-- jQuery Scrollbar -->
                <script src="<?= base_url('public/') ?>assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

                <!-- Chart JS -->
                <script src="<?= base_url('public/') ?>assets/js/plugin/chart.js/chart.min.js"></script>

                <!-- jQuery Sparkline -->
                <script src="<?= base_url('public/') ?>assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

                <!-- Chart Circle -->
                <script src="<?= base_url('public/') ?>assets/js/plugin/chart-circle/circles.min.js"></script>

                <!-- Datatables -->
                <script src="<?= base_url('public/') ?>assets/js/plugin/datatables/datatables.min.js"></script>

                <!-- jQuery Vector Maps -->
                <script src="<?= base_url('public/') ?>assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
                <script src="<?= base_url('public/') ?>assets/js/plugin/jsvectormap/world.js"></script>

                <!-- Sweet Alert -->
                <script src="<?= base_url('public/') ?>assets/js/plugin/sweetalert/sweetalert.min.js"></script>

                <!-- Kaiadmin JS -->
                <script src="<?= base_url('public/') ?>assets/js/kaiadmin.min.js"></script>

                <!-- Kaiadmin DEMO methods, don't include it in your project! -->
                <script src="<?= base_url('public/') ?>assets/js/setting-demo.js"></script>
                <script src="<?= base_url('public/') ?>assets/js/demo.js"></script>
                <script>
                    $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
                        type: "line",
                        height: "70",
                        width: "100%",
                        lineWidth: "2",
                        lineColor: "#177dff",
                        fillColor: "rgba(23, 125, 255, 0.14)",
                    });

                    $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
                        type: "line",
                        height: "70",
                        width: "100%",
                        lineWidth: "2",
                        lineColor: "#f3545d",
                        fillColor: "rgba(243, 84, 93, .14)",
                    });

                    $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
                        type: "line",
                        height: "70",
                        width: "100%",
                        lineWidth: "2",
                        lineColor: "#ffa534",
                        fillColor: "rgba(255, 165, 52, .14)",
                    });
                </script>
                <script src="<?= base_url('public/') ?>assets/js/core/jquery-3.7.1.min.js"></script>

                <!-- jQuery Scrollbar -->
                <script src="<?= base_url('public/') ?>assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
                <!-- Datatables -->
                <script src="<?= base_url('public/') ?>assets/js/plugin/datatables/datatables.min.js"></script>
                <!-- Kaiadmin JS -->
                <script src="<?= base_url('public/') ?>assets/js/kaiadmin.min.js"></script>
                <!-- Kaiadmin DEMO methods, don't include it in your project! -->
                <script src="<?= base_url('public/') ?>assets/js/setting-demo2.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    $(document).ready(function() {
                        $("#basic-datatables").DataTable({});
                        <?php
                        if (isset($relasi)) {
                            foreach ($relasi as $index => $r) {
                        ?>
                                $("#relationTable_<?= $r['fieldName'] ?>").DataTable({});
                        <?php
                            }
                        }
                        ?>
                        $("#multi-filter-select").DataTable({
                            pageLength: 5,
                            initComplete: function() {
                                this.api()
                                    .columns()
                                    .every(function() {
                                        var column = this;
                                        var select = $(
                                                '<select class="form-select"><option value=""></option></select>'
                                            )
                                            .appendTo($(column.footer()).empty())
                                            .on("change", function() {
                                                var val = $.fn.dataTable.util.escapeRegex($(this).val());

                                                column
                                                    .search(val ? "^" + val + "$" : "", true, false)
                                                    .draw();
                                            });

                                        column
                                            .data()
                                            .unique()
                                            .sort()
                                            .each(function(d, j) {
                                                select.append(
                                                    '<option value="' + d + '">' + d + "</option>"
                                                );
                                            });
                                    });
                            },
                        });

                        // Add Row
                        $("#add-row").DataTable({
                            pageLength: 5,
                        });

                        var action =
                            '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

                        $("#addRowButton").click(function() {
                            $("#add-row")
                                .dataTable()
                                .fnAddData([
                                    $("#addName").val(),
                                    $("#addPosition").val(),
                                    $("#addOffice").val(),
                                    action,
                                ]);
                            $("#addRowModal").modal("hide");
                        });
                    });
                </script>
                <script>
                    //== Class definition
                    var SweetAlert2Demo = (function() {
                        //== Demos
                        var initDemos = function() {
                            $(document).on('click', '.delete-button', function(e) {
                                e.preventDefault();
                                var deleteUrl = $(this).attr('href');
                                swal({
                                    title: "Are you sure?",
                                    text: "You won't be able to revert this!",
                                    type: "warning",
                                    buttons: {
                                        confirm: {
                                            text: "Yes, delete it!",
                                            className: "btn btn-success",
                                        },
                                        cancel: {
                                            visible: true,
                                            className: "btn btn-danger",
                                        },
                                    },
                                }).then((Delete) => {
                                    if (Delete) {
                                        window.location.href = deleteUrl;
                                    } else {
                                        swal.close();
                                    }
                                });
                            });
                            <?php if (session()->getFlashdata('success')) : ?>
                                swal({
                                    title: "Success!",
                                    text: "<?= session()->getFlashdata('success') ?>",
                                    icon: "success",
                                    buttons: {
                                        confirm: {
                                            className: "btn btn-success",
                                        },
                                    },
                                });
                            <?php endif; ?>
                            <?php if (session()->getFlashdata('failed')) : ?>
                                swal({
                                    title: "Failed!",
                                    text: "<?= session()->getFlashdata('failed') ?>",
                                    icon: "error",
                                    buttons: {
                                        confirm: {
                                            className: "btn btn-danger",
                                        },
                                    },
                                });
                            <?php endif; ?>
                        };

                        return {
                            //== Init
                            init: function() {
                                initDemos();
                            },
                        };
                    })();

                    //== Class Initialization
                    jQuery(document).ready(function() {
                        SweetAlert2Demo.init();
                    });
                </script>
            </body>

            </html>

        <?php
        } else {
        ?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

                <title>Tambah Pegawai</title>
            </head>

            <body>
                <div class="container">
                    <h2 align="center">TAMBAH DATA PETUGAS / PEGAWAI</h2>
                    <hr>
                    <form action="<?= base_url('pegawai/store') ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="user_id" value="<?= session()->get('id'); ?>" class="form-control" required>
                        <div class="row">
                            <div class="col-2">
                                <label for="">NIK</label>
                            </div>
                            <div class="col-8">
                                <input type="text" name="nik" class="form-control" required>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-2">
                                <label for="">Nama</label>
                            </div>
                            <div class="col-8">
                                <input type="text" name="nama" class="form-control" required>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-2">
                                <label for="">TTL</label>
                            </div>
                            <div class="col-4">
                                <input type="text" name="tempat" class="form-control" required>
                            </div>
                            <div class="col-4">
                                <input type="date" name="t_lahir" class="form-control" required>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-2">
                                <label for="">Jenis Kelamin</label>
                            </div>
                            <div class="col-8">
                                <select name="j_kelamin" class="form-control" required id="">
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-2">
                                <label for="">Agama</label>
                            </div>
                            <div class="col-8">
                                <select name="agama" class="form-control" required id="">
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buddha ">Buddha </option>
                                    <option value="Khonghucu">Khonghucu</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-2">
                                <label for="">No Hp</label>
                            </div>
                            <div class="col-8">
                                <input type="text" name="no_hp" class="form-control" required>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-2">
                                <label for="">Alamat</label>
                            </div>
                            <div class="col-8">
                                <input type="text" name="alamat" class="form-control" required>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-2">
                                <label for="">Foto</label>
                            </div>
                            <div class="col-8">
                                <input type="file" name="foto" class="form-control" required>
                            </div>
                        </div>
                        <br>
                        <div>
                            <button class="btn btn-primary" type="submit">Simpan</button>
                            <button class="btn btn-danger" type="reset">Reset</button>
                        </div>
                    </form>
                </div>
            </body>

            </html>
        <?php
        }
    } else {
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <title>Forms - Kaiadmin Bootstrap 5 Admin Dashboard</title>
            <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
            <link rel="icon" href="<?= base_url('public/') ?>assets/img/kaiadmin/favicon.ico" type="image/x-icon" />

            <!-- Fonts and icons -->
            <script src="<?= base_url('public/') ?>assets/js/plugin/webfont/webfont.min.js"></script>
            <script>
                WebFont.load({
                    google: {
                        families: ["Public Sans:300,400,500,600,700"]
                    },
                    custom: {
                        families: [
                            "Font Awesome 5 Solid",
                            "Font Awesome 5 Regular",
                            "Font Awesome 5 Brands",
                            "simple-line-icons",
                        ],
                        urls: ["<?= base_url('public/') ?>assets/css/fonts.min.css"],
                    },
                    active: function() {
                        sessionStorage.fonts = true;
                    },
                });
            </script>

            <!-- CSS Files -->
            <link rel="stylesheet" href="<?= base_url('public/') ?>assets/css/bootstrap.min.css" />
            <link rel="stylesheet" href="<?= base_url('public/') ?>assets/css/plugins.min.css" />
            <link rel="stylesheet" href="<?= base_url('public/') ?>assets/css/kaiadmin.min.css" />

            <!-- CSS Just for demo purpose, don't include it in your project -->
            <link rel="stylesheet" href="<?= base_url('public/') ?>assets/css/demo.css" />
        </head>

        <body>
            <div class="wrapper">
                <!-- Sidebar -->
                <?= $this->include('partials/sidebar') ?>
                <!-- End Sidebar -->

                <div class="main-panel">
                    <div class="main-header">
                        <div class="main-header-logo">
                            <!-- Logo Header -->
                            <div class="logo-header" data-background-color="dark">
                                <a href="index.html" class="logo">
                                    <img src="<?= base_url('public/') ?>assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20" />
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
                            <!-- End Logo Header -->
                        </div>
                        <!-- Navbar Header -->
                        <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                            <div class="container-fluid">

                                <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                                    <li class="nav-item topbar-user dropdown hidden-caret">
                                        <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                                            <div class="avatar-sm">
                                                <img src="<?= base_url() ?>/public/images/<?= session()->get('foto'); ?>" alt="..." class="avatar-img rounded-circle" />
                                            </div>
                                            <span class="profile-username">
                                                <span class="op-7">Hi,</span>
                                                <span class="fw-bold"><?= session()->get('username'); ?></span>
                                            </span>
                                        </a>
                                        <ul class="dropdown-menu dropdown-user animated fadeIn">
                                            <div class="dropdown-user-scroll scrollbar-outer">
                                                <li>
                                                    <div class="user-box">
                                                        <div class="avatar-lg">
                                                            <img src="<?= base_url() ?>/public/images/<?= session()->get('foto'); ?>" alt="image profile" class="avatar-img rounded" />
                                                        </div>
                                                        <div class="u-text">
                                                            <h4><?= session()->get('level'); ?></h4>
                                                            <p class="text-muted"><?= session()->get('email'); ?></p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="dropdown-divider"></div>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="<?= base_url('profil') ?>">Account Setting</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="<?= base_url('logout') ?>">Logout</a>
                                                </li>
                                            </div>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                        <!-- End Navbar -->
                    </div>

                    <div class="container">
                        <div class="page-inner">
                            <?= $this->renderSection('content') ?>
                        </div>
                    </div>

                </div>

            </div>
            <script src="<?= base_url('public/') ?>assets/js/core/jquery-3.7.1.min.js"></script>
            <script src="<?= base_url('public/') ?>assets/js/core/popper.min.js"></script>
            <script src="<?= base_url('public/') ?>assets/js/core/bootstrap.min.js"></script>

            <!-- jQuery Scrollbar -->
            <script src="<?= base_url('public/') ?>assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

            <!-- Chart JS -->
            <script src="<?= base_url('public/') ?>assets/js/plugin/chart.js/chart.min.js"></script>

            <!-- jQuery Sparkline -->
            <script src="<?= base_url('public/') ?>assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

            <!-- Chart Circle -->
            <script src="<?= base_url('public/') ?>assets/js/plugin/chart-circle/circles.min.js"></script>

            <!-- Datatables -->
            <script src="<?= base_url('public/') ?>assets/js/plugin/datatables/datatables.min.js"></script>

            <!-- jQuery Vector Maps -->
            <script src="<?= base_url('public/') ?>assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
            <script src="<?= base_url('public/') ?>assets/js/plugin/jsvectormap/world.js"></script>

            <!-- Sweet Alert -->
            <script src="<?= base_url('public/') ?>assets/js/plugin/sweetalert/sweetalert.min.js"></script>

            <!-- Kaiadmin JS -->
            <script src="<?= base_url('public/') ?>assets/js/kaiadmin.min.js"></script>

            <!-- Kaiadmin DEMO methods, don't include it in your project! -->
            <script src="<?= base_url('public/') ?>assets/js/setting-demo.js"></script>
            <script src="<?= base_url('public/') ?>assets/js/demo.js"></script>
            <script>
                $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
                    type: "line",
                    height: "70",
                    width: "100%",
                    lineWidth: "2",
                    lineColor: "#177dff",
                    fillColor: "rgba(23, 125, 255, 0.14)",
                });

                $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
                    type: "line",
                    height: "70",
                    width: "100%",
                    lineWidth: "2",
                    lineColor: "#f3545d",
                    fillColor: "rgba(243, 84, 93, .14)",
                });

                $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
                    type: "line",
                    height: "70",
                    width: "100%",
                    lineWidth: "2",
                    lineColor: "#ffa534",
                    fillColor: "rgba(255, 165, 52, .14)",
                });
            </script>
            <script src="<?= base_url('public/') ?>assets/js/core/jquery-3.7.1.min.js"></script>

            <!-- jQuery Scrollbar -->
            <script src="<?= base_url('public/') ?>assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
            <!-- Datatables -->
            <script src="<?= base_url('public/') ?>assets/js/plugin/datatables/datatables.min.js"></script>
            <!-- Kaiadmin JS -->
            <script src="<?= base_url('public/') ?>assets/js/kaiadmin.min.js"></script>
            <!-- Kaiadmin DEMO methods, don't include it in your project! -->
            <script src="<?= base_url('public/') ?>assets/js/setting-demo2.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                $(document).ready(function() {
                    $("#basic-datatables").DataTable({});
                    <?php
                    if (isset($relasi)) {
                        foreach ($relasi as $index => $r) {
                    ?>
                            $("#relationTable_<?= $r['fieldName'] ?>").DataTable({});
                    <?php
                        }
                    }
                    ?>
                    $("#multi-filter-select").DataTable({
                        pageLength: 5,
                        initComplete: function() {
                            this.api()
                                .columns()
                                .every(function() {
                                    var column = this;
                                    var select = $(
                                            '<select class="form-select"><option value=""></option></select>'
                                        )
                                        .appendTo($(column.footer()).empty())
                                        .on("change", function() {
                                            var val = $.fn.dataTable.util.escapeRegex($(this).val());

                                            column
                                                .search(val ? "^" + val + "$" : "", true, false)
                                                .draw();
                                        });

                                    column
                                        .data()
                                        .unique()
                                        .sort()
                                        .each(function(d, j) {
                                            select.append(
                                                '<option value="' + d + '">' + d + "</option>"
                                            );
                                        });
                                });
                        },
                    });

                    // Add Row
                    $("#add-row").DataTable({
                        pageLength: 5,
                    });

                    var action =
                        '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

                    $("#addRowButton").click(function() {
                        $("#add-row")
                            .dataTable()
                            .fnAddData([
                                $("#addName").val(),
                                $("#addPosition").val(),
                                $("#addOffice").val(),
                                action,
                            ]);
                        $("#addRowModal").modal("hide");
                    });
                });
            </script>
            <script>
                //== Class definition
                var SweetAlert2Demo = (function() {
                    //== Demos
                    var initDemos = function() {
                        $(document).on('click', '.delete-button', function(e) {
                            e.preventDefault();
                            var deleteUrl = $(this).attr('href');
                            swal({
                                title: "Are you sure?",
                                text: "You won't be able to revert this!",
                                type: "warning",
                                buttons: {
                                    confirm: {
                                        text: "Yes, delete it!",
                                        className: "btn btn-success",
                                    },
                                    cancel: {
                                        visible: true,
                                        className: "btn btn-danger",
                                    },
                                },
                            }).then((Delete) => {
                                if (Delete) {
                                    window.location.href = deleteUrl;
                                } else {
                                    swal.close();
                                }
                            });
                        });
                        <?php if (session()->getFlashdata('success')) : ?>
                            swal({
                                title: "Success!",
                                text: "<?= session()->getFlashdata('success') ?>",
                                icon: "success",
                                buttons: {
                                    confirm: {
                                        className: "btn btn-success",
                                    },
                                },
                            });
                        <?php endif; ?>
                        <?php if (session()->getFlashdata('failed')) : ?>
                            swal({
                                title: "Failed!",
                                text: "<?= session()->getFlashdata('failed') ?>",
                                icon: "error",
                                buttons: {
                                    confirm: {
                                        className: "btn btn-danger",
                                    },
                                },
                            });
                        <?php endif; ?>
                    };

                    return {
                        //== Init
                        init: function() {
                            initDemos();
                        },
                    };
                })();

                //== Class Initialization
                jQuery(document).ready(function() {
                    SweetAlert2Demo.init();
                });
            </script>
        </body>

        </html>

    <?php
    }
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Contoh Form Login</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <style>
            body {
                margin: 0;
                padding: 0;
                background-color: #17a2b8;
                height: 100vh;
            }

            #login .container #login-row #login-column #login-box {
                margin-top: 120px;
                max-width: 600px;
                height: 320px;
                border: 1px solid #9C9C9C;
                background-color: #EAEAEA;
            }

            #login .container #login-row #login-column #login-box #login-form {
                padding: 20px;
            }

            #login .container #login-row #login-column #login-box #login-form #register-link {
                margin-top: -85px;
            }
        </style>
    </head>

    <body>

        <section>
            <div id="login">
                <h3 class="text-center text-white pt-5">LOGIN FORM</h3>
                <div class="container">
                    <div id="login-row" class="row justify-content-center align-items-center">
                        <div id="login-column" class="col-md-6">
                            <div id="login-box" class="col-md-12">
                                <?php if (session()->getFlashdata('msg')) : ?>
                                    <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
                                <?php endif; ?>
                                <form id="login-form" class="form" action="<?= base_url('login') ?>" method="post">
                                    <div class="form-group">
                                        <label for="username" class="text-info">Username:</label><br>
                                        <input type="text" name="username" id="email" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="text-info">Password:</label><br>
                                        <input type="password" name="password" id="password" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="submit" class="btn btn-info btn-md"> LOGIN</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    </body>

    </html>
<?php
}
?>