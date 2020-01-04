
<?php include '../koneksi.php';
session_start();

$obat = mysqli_query($config, "SELECT `nm_obat`, `stok` FROM obat where stok <=3 ");
$tanggal = mysqli_query($config, "SELECT * FROM pembelian inner join obat where pembelian.kd_obat=obat.kd_obat and status !='expired '");

?>

<!DOCTYPE html>
<html>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>APOTEK | Sariasih</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <link rel="shortcut icon" href="dist/img/dimas.png" />
  <!-- Bootstrap 3.3.5 -->


  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. -->
     <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
     <!-- iCheck -->
     <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
     <!-- Morris chart -->
     <link rel="stylesheet" href="plugins/morris/morris.css">
     <!-- jvectormap -->
     <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
     <!-- Date Picker -->
     <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
     <!-- Daterange picker -->
     <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
     <!-- bootstrap wysihtml5 - text editor -->
     <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
     <!-- DataTables -->
     <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
      <link rel="stylesheet" href="plugins/select2/css/select2.min.css"/>

      <!-- <!datatables!> -->
      <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/> -->
      <link rel="stylesheet" href="css/buttons.dataTables.min.css"/>


    

      <!-- Ionicons -->
  <link rel="stylesheet" href="plugins/Ionicons/css/ionicons.min.css">







     <script src="Chart.bundle.js"></script>



     <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
     <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
    </head>
    <?php

if ($_SESSION['level'] == 'Admin') {
	echo '<body class="hold-transition skin-red sidebar-mini">';
} elseif ($_SESSION['level'] == 'Karyawan') {
	echo '<body class="hold-transition skin-blue sidebar-mini">';
} elseif ($_SESSION['level'] == 'Apoteker') {
	echo '<body class="hold-transition skin-yellow sidebar-mini">';
}

?>
    <div class="wrapper">




      <header class="main-header">
        <!-- Logo -->
        <a href="<?php $_SERVER[SCRIPT_NAME];?>?page=dashboard" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>A</b>PS</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Apotek</b>Sariasih</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <!-- Notifications: style can be found in dropdown.less -->
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <span class="label label-warning">Stok      </span><i class="fa fa-bell-o"></i>
                  <span class="label label-warning"></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">Pemberitahuan Stok</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li>
                        <a href="#">
                          <i class="">
                            <?php
while ($q = mysqli_fetch_array($obat)) {

	if ($q['stok'] <= 11) {

		?>
                                <script>
                                  $(document).ready(function(){
                                    $('#pesan_sedia').css("color","red");
                                    $('#pesan_sedia').append("<span class='glyphicon glyphicon-asterisk'></span>");
                                  });
                                </script>
                                <?php

		echo "<div style='padding:5px' class='alert alert-warning'><span class='glyphicon glyphicon-info-sign'></span> Stok  <a style='color:red'>" . $q['nm_obat'] . "</a> yang tersisa sudah kurang dari 3 . silahkan pesan lagi !!</div>";
	}

}
?>
                          </i>
                        </a>
                      </li>

                    </ul>
                  </li>
                  <li class="footer"><a href="#">Close</a></li>
                </ul>
              </li>


              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <span class="label label-danger">Expired </span><i class="fa fa-envelope-o""></i>
                  <span class="label label-danger"></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">Pesan Expired Obat</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li>
                        <a href="#">
                          <i class="">

                            <?php
while ($u = mysqli_fetch_array($tanggal)) {
	$masaaktif = "$u[tgl_exp]";
	$sekarang = date("d-m-Y");
	$masaberlaku = strtotime($masaaktif) - strtotime($sekarang);

	if ($masaberlaku / (24 * 60 * 60) < 8) {

		?>
                                <script>
                                  $(document).ready(function(){
                                    $('#pesan_sedia').css("color","red");
                                    $('#pesan_sedia').append("<span class='glyphicon glyphicon-asterisk'></span>");
                                  });
                                </script>
                                <?php
echo "<div style='padding:5px' class='alert alert-danger'><span class='glyphicon glyphicon-info-sign'></span> " . $masaberlaku / (24 * 60 * 60) . " hari lagi   <a style='color:blue'>" . $u['nm_obat'] . "</a>     Masa Berlaku akan Habis!!! !!</div>";
	}

}
?>


                          </i>
                        </a>
                      </li>

                    </ul>
                  </li>
                  <li class="footer"><a href="#">Close</a></li>
                </ul>
              </li>



              <!-- Control Sidebar Toggle Button -->
              <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="dist/img/dimas.png" class="user-image" alt="User Image">
              <span class="hidden-xs">Logout</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p><?php echo $_SESSION['username']; ?></p>


              </li>

              <!-- Menu Footer-->
              <li class="user-footer">

                <div class="pull-right">
                  <a href="#" data-toggle="modal" data-target="#logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>

          </div>
        </nav>
      </header>


<!-- Modal Popup untuk delete -->
<!--
<form action="logout.php" method="POST" target="_blank">
<div class="modal fade small" id="my-log">
  <div class="modal-dialog">
    <div class="modal-content" style="margin-top:100px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" style="text-align:center;">Konfirmasi untuk keluar Aplikasi</h4>
        <h2 class="modal-dialog" style="text-align:center;">Semoga hari anda bahagia</h2>
      </div>
      <div>

      </div>

      <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
        <a href="logout.php" class="btn btn-danger" id="delete_link">Keluar</a>
        <button type="button" class="btn btn-success" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>
</form> -->

 <!-- Modal Logout -->
        <div class="modal fade" id="logout">
          <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-sign-out"> Logout</i></h4>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin logout? </p>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-danger" href="<?php $_SERVER[SCRIPT_NAME];?>?page=logout">Ya, Logout</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                </div>
              </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

