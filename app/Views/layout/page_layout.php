<?php
  if(!empty(session()->get('id'))){
    ?>
    <!doctype html>
<html lang="en">
  <head>
  	<title>Sidebar 09</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
    <script src="https://kit.fontawesome.com/a284c48079.js" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="<?= base_url() ?>/public/css/style.css">
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
        <style>
            .dropdown-container {
  display: none;
  background-color: #262626;
  padding-left: 8px;
}

        </style>

  </head>
  <body>
		
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-primary">
	        </button>
        </div>
	  		<div class="bg-wrap text-center py-1">
	  			<div class="user-logo">
	  				<div>
                        <img src="<?= base_url() ?>/public/images/<?= session()->get('foto'); ?>" class="img" alt="">
                    </div>
	  				<h3><?= session()->get('username'); ?></h3>
	  			</div>
	  		</div>
        <ul class="list-unstyled components mb-5">
          <li class="<?php if($hover =='Profil'){echo 'active';}?>" <?php if($hover =='Profil'){?> style="background: #17a2b8;" <?php }?> >
            <a href="<?= base_url('dashboard') ?>" style="text-decoration:none"><span class="fa fa-user mr-3"></span> Profil</a>
          </li>
          <li>
          <a href="#" style="text-decoration:none" class="dropdown-btn"><i class="fa-solid fa-list"></i> Data Master 
                <i class="fa fa-caret-down"></i></a>
            <div class="dropdown-container">
                <ul>
                <?php
                        if(session()->get('level') == "Admin"){
                            ?>
                    <li class="<?php if($hover =='Pengguna'){echo 'active';}?>" <?php if($hover =='Pengguna'){?> style="background: #17a2b8;" <?php }?>>
                        <a href="<?= base_url('user') ?>" style="text-decoration:none"><span class="fa fa-user mr-3 notif"></span> Pengguna</a>
                    </li>
                    <li class="<?php if($hover =='Ruangan'){echo 'active';}?>" <?php if($hover =='Ruangan'){?> style="background: #17a2b8;" <?php }?>>
                        <a href="<?= base_url('ruangan') ?>" style="text-decoration:none"><span class="fa fa-user mr-3 notif"></span> Ruangan</a>
                    </li>
                            <?php
                        }
                ?>
                    <li class="<?php if($hover =='Tata Usaha'){echo 'active';}?>" <?php if($hover =='Tata Usaha'){?> style="background: #17a2b8;" <?php }?>>
                        <a href="<?= base_url('tata_usaha') ?>" style="text-decoration:none"><span class="fa fa-address-card mr-3 notif"></span> Data Tata Usaha</a>
                    </li>
                    <li class="<?php if($hover =='Barang'){echo 'active';}?>" <?php if($hover =='Barang'){?> style="background: #17a2b8;" <?php }?>>
                        <a href="<?= base_url('barang') ?>" style="text-decoration:none"><span class="fa fa-boxes-stacked mr-3 notif"></span> Data Barang</a>
                    </li>
                </ul>
            </div>
          </li>
          <li>
          <a href="#" style="text-decoration:none" class="dropdown-btn"><i class="fa-solid fa-list"></i> Barang Peruangan 
                <i class="fa fa-caret-down"></i></a>
            <div class="dropdown-container">
                <ul>
                <?php
                         $db = db_connect();
                         $query = $db->query("SELECT * FROM ruangan ");
                         //you get result as an array in here but fetch your result however you feel to
                         $result = $query->getResultArray();
                ?>
                 <?php
              $no =1;
              foreach($result as $r){
                ?>
     <li class="<?php if($hover =='Ruangan '.$r['nm_ruangan'].''){echo 'active';}?>" <?php if($hover =='Ruangan '.$r['nm_ruangan'].''){?> style="background: #17a2b8;" <?php }?>>
              <a href="<?= base_url('barang_peruangan/'.$r['nm_ruangan'].'') ?>" style="text-decoration:none"><span class="fa fa-truck-ramp-box mr-3 notif"></span> Ruangan <?= $r['nm_ruangan'] ?></a>
          </li>
      <?php
              }
            ?>
                </ul>
            </div>
          </li>
          <li class="<?php if($hover =='Sumber Barang'){echo 'active';}?>" <?php if($hover =='Sumber Barang'){?> style="background: #17a2b8;" <?php }?>>
                        <a href="<?= base_url('sumber_barang') ?>" style="text-decoration:none"><span class="fa fa-box-open mr-3 notif"></span> Sumber Barang</a>
                    </li>
          <?php
                if(session()->get('level') == "Admin"){
                    ?>
                   
                    <li class="<?php if($hover =='Kondisi Barang' || $hover =='Barang Rusak'){echo 'active';}?>" <?php if($hover =='Kondisi Barang' || $hover =='Barang Rusak'){?> style="background: #17a2b8;" <?php }?>>
                        <a href="<?= base_url('kondisi_barang') ?>" style="text-decoration:none"><span class="fa fa-boxes-packing mr-3 notif"></span>Kondisi barang</a>
                    </li>
                    <?php
                }
          ?>
          <li>
          <a href="#" style="text-decoration:none" class="dropdown-btn"><i class="fa-solid fa-info"></i> Laporan 
                <i class="fa fa-caret-down"></i></a>
            <div class="dropdown-container">
                <ul>
                   
                    <li class="<?php if($hover =='Laporan Barang'){echo 'active';}?>" <?php if($hover =='Laporan Barang'){?> style="background: #17a2b8;" <?php }?>>
                        <a href="<?= base_url('barang/laporan_barang') ?>" style="text-decoration:none"><span class="fa fa-boxes-stacked mr-3 notif"></span> Laporan Data Barang</a>
                    </li>
                    <?php
                        if(session()->get('level') == "Admin"){
                            ?>
                                <li class="<?php if($hover =='Laporan Sumber Barang'){echo 'active';}?>" <?php if($hover =='Laporan Sumber Barang'){?> style="background: #17a2b8;" <?php }?>>
                                    <a href="<?= base_url('sumber_barang/laporan_sumber') ?>" style="text-decoration:none"><span class="fa fa-box-open mr-3 notif"></span> Sumber Barang</a>
                                </li>
                                
                            <?php
                        }
                    ?>
                                <li class="<?php if($hover =='Laporan Barang Rusak'){echo 'active';}?>" <?php if($hover =='Laporan Barang Rusak'){?> style="background: #17a2b8;" <?php }?>>
                                    <a href="<?= base_url('barang_rusak/laporan') ?>" style="text-decoration:none"><span class="fa fa-box mr-3 notif"></span> Barang Rusak</a>
                                </li>
                                <li class="<?php if($hover =='Laporan Barang Baik'){echo 'active';}?>" <?php if($hover =='Laporan Barang Baik'){?> style="background: #17a2b8;" <?php }?>>
                                    <a href="<?= base_url('kondisi_barang/laporan') ?>" style="text-decoration:none"><span class="fa fa-boxes-packing mr-3 notif"></span> Barang Baik</a>
                                </li>
                                <li>
                                    <a href="#" style="text-decoration:none" class="dropdown-btn"><i class="fa-solid fa-info"></i> Barang Peruangan 
                                            <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-container">
                                            <ul>
                                            <?php
                                                $db = db_connect();
                                                $query = $db->query("SELECT * FROM ruangan ");
                                                //you get result as an array in here but fetch your result however you feel to
                                                $result = $query->getResultArray();
                                            ?>
                                            <?php
                                                $no =1;
                                                foreach($result as $ru){
                                                    ?>
                                                   <li class="<?php if($hover =='Laporan Barang Ruangan '.$ru['nm_ruangan']){echo 'active';}?>" <?php if($hover =='Laporan Barang Ruangan '.$ru['nm_ruangan']){?> style="background: #17a2b8;" <?php }?>>
                                    <a href="<?= base_url('barang_pakai/laporan_'.$ru['nm_ruangan'].'') ?>" style="text-decoration:none"><span class="fa fa-boxes-packing mr-3 notif"></span> Ruangan <?= $ru['nm_ruangan']?></a>
                                </li>
                                            <?php
                                                }
                                            ?>
                                            </ul>
                                        </div>
                                </li>
                </ul>
            </div>
          </li>
          <li>
            <a href="<?= base_url('/logout') ?>" style="text-decoration:none"><span class="fa fa-sign-out mr-3"></span> Sign Out</a>
          </li>
        </ul>
    	</nav>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5 pt-5">
        
        <h2><?=  $data ?></h2>
        <hr color="blue" width="100%" size="50%">


        <?= $this->renderSection('content') ?>
		</div>

    <script src="<?= base_url()?>/public/js/jquery.min.js "></script>
    <script src="<?= base_url() ?>/public/js/popper.js "></script>
    <script src="<?= base_url() ?>/public/js/bootstrap.min.js "></script>
    <script src="<?= base_url() ?>/public/js/main.js "></script>
    <script>
        new DataTable('#example');
    </script>
    <script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}
</script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">
<script>
$(function(){

    <?php if(session()->has("success")) { ?>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '<?= session("success") ?>'
        })
    <?php } ?>
});
</script>

<script>
$(function(){

    <?php if(session()->has("error")) { ?>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '<?= session("error") ?>'
        })
    <?php } ?>
});
</script>

<script>
$(function(){

    <?php if(session()->has("warning")) { ?>
        Swal.fire({
            icon: 'warning',
            title: 'Great!',
            text: '<?= session("warning") ?>'
        })
    <?php } ?>
});
</script>

<script>
$(function(){

    <?php if(session()->has("info")) { ?>
        Swal.fire({
            icon: 'info',
            title: 'Hi!',
            text: '<?= session("info") ?>'
        })
    <?php } ?>
});
</script>
  </body>
</html>

    <?php
  }else{
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
                            <?php if(session()->getFlashdata('msg')):?>
                                <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
                            <?php endif;?>
                                <form id="login-form" class="form" action="<?= base_url('login') ?>" method="post">
                                    <div class="form-group">
                                        <label for="username" class="text-info">Username:</label><br>
                                        <input type="text" name="username" id="email" class="form-control" required >
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="text-info">Password:</label><br>
                                        <input type="password" name="password" id="password" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="submit" class="btn btn-info btn-md" > LOGIN</button>
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


