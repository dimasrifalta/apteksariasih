
<?php
session_start();
if(empty($_SESSION['username'])){
 echo "<script>window.location='../../login.php';</script>";
}
?>


<?php include 'theme/header.php';


?>



<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $_SESSION['username']; ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> 
          <?php
          if ($_SESSION['level']=='Apoteker') {
            echo"Apoteker";
          } 
          elseif ($_SESSION['level']=='Admin') {
            echo"Admin";
          }

          elseif ($_SESSION['level']=='Karyawan') {
            echo"Kasir";
          }
          

          ?></a>
        </div>
      </div>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">NAVIGASI</li>
        <li class="treeview">
          <a href="<?php $_SERVER[SCRIPT_NAME];?>?page=dashboard">  
           <i class="fa fa-home"></i> <span>Dashboard</span>
         </a>
       </li>
       
       
       <li class="treeview">
        <a href="#">
          <i class="fa fa-table"></i> <span>Master</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li> <a href="<?php $_SERVER[SCRIPT_NAME];?>?page=obat1">
            <i class="fa fa-circle-o"></i> <span>Stok Obat</span>  
          </a></li>
          
        </ul>
      </li>

      <li class="treeview ">
        <a href="#">
          <i class="fa fa-pie-chart"></i> <span>Laporan</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="active"> <a href="<?php $_SERVER[SCRIPT_NAME];?>?page=penjualan&act=view">
            <i class="fa fa-circle-o"></i> <span>Laporan Penjualan</span>  
          </a></li>
          
        </ul>
      </li>
      

      <li class="active">
        <a href="<?php $_SERVER[SCRIPT_NAME];?>?page=pass">  
         <i class="glyphicon glyphicon-briefcase"></i> <span>Ganti Password</span>
       </a>
     </li>





   </ul>


 </section>
 <!-- /.sidebar -->
</aside>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>



    </h1>

  </section>

  <!-- Main content -->
  <section class="content">
   <?php  
    // fungsi untuk menampilkan pesan
    // jika alert = "" (kosong)
    // tampilkan pesan "" (kosong)
   if (empty($_GET['alert'])) {
    echo "";
  } 
    // jika alert = 1
    // tampilkan pesan Gagal "Paswword lama Anda salah"
  elseif ($_GET['alert'] == 1) {
    echo "<div class='alert alert-danger alert-dismissable'>
    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
    <h4>  <i class='icon fa fa-times-circle'></i> Gagal!</h4>
    Password lama Anda tidak sama.
    </div>";
    
  }
    // jika alert = 2
    // tampilkan pesan Gagal "Password baru dan Ulangi password baru tidak cocok"
  elseif ($_GET['alert'] == 2) {
    echo "<div class='alert alert-danger alert-dismissable'>
    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
    <h4>  <i class='icon fa fa-times-circle'></i> Gagal!</h4>
    Password baru dan Ulangi password baru tidak cocok.
    </div>";
  }
    // jika alert = 3
    // tampilkan pesan Sukses "Password berhasil diubah"
  elseif ($_GET['alert'] == 3) {
    echo "<div class='alert alert-success alert-dismissable'>
    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
    <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
    Password berhasil diubah.
    </div>";
  }
  ?>


  <h3><span class="glyphicon glyphicon-briefcase"></span>  Password</h3>


  <div class="box box-warning">
    <div class=box-header with-border>
      <h3 class=box-title>Ganti Password</h3>
    </div>




    <!-- form start -->
    <form class=form-horizontal method=POST enctype=multipart/form-data action=apoteker/ganti_pass/ganti_pass_act.php?sender=pass>
      <div class=box-body>


        <div class=form-group>
          <label for=inputPassword3 class=col-sm-2 control-label>Password Lama</label>
          <div class=col-sm-3>
            <input type=password class=form-control name=pass_lama >
          </div>
        </div>  

        
        <div class=form-group>
          <label for=inputPassword3 class=col-sm-2 control-label>Password Baru</label>
          <div class=col-sm-3>
            <input type=password class=form-control name=pass_baru >
          </div>
        </div>                

        <div class=form-group>
          <label for=inputPassword3 class=col-sm-2 control-label>Lagi Password Baru</label>
          <div class=col-sm-3>
            <input type=password class=form-control name=pass_ulangi >
          </div>
        </div>

        

      </div>
      <!-- /.box-body -->
      <div class=box-footer>
        <button type=submit class='btn btn-default' onclick=self.history.back() >Batal</button>
        <button type='submit' class='btn btn-info pull-right'>Simpan</button>
      </div>
      <!-- /.box-footer -->
    </form>
  </div> 
</section>
</div>


<?php include 'theme/footer.php'; ?>