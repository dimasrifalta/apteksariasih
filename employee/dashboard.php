<?php
session_start();
if(empty($_SESSION['username'])){
 echo "<script>window.location='../../login.php';</script>";
}
?>
<?php include 'theme/header.php'; ?>

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
        <li class="treeview active">
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
            <li> <a href="<?php $_SERVER[SCRIPT_NAME];?>?page=obat_employee">
                <i class="fa fa-circle-o"></i> <span>Stok Obat</span>  
              </a></li>
             </ul>
        </li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i> <span>Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li> <a href="<?php $_SERVER[SCRIPT_NAME];?>?page=transaksi&act=view">
                <i class="fa fa-circle-o"></i> <span>Penjualan</span>  
              </a></li>
            
             </ul>
        </li>

        <li class="treeview ">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php $_SERVER[SCRIPT_NAME];?>?page=penjualan&act=view"><i class="fa fa-circle-o"></i> Laporan Penjualan</a></li>   
  </ul>
</li>

        <li class="">
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
     
       <i class="fa fa-home icon-title"></i> HOME
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
    
    
    <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
                <span class="info-box-text" >Jumlah Obat terjual hari ini</span>
              <span class="info-box-text" style="
                          font-size: 16px;
                          color: blue;
                          font-family: cursive;
                        ">
        <?php $d1 =mysqli_query($config, "SELECT sum(total_penjualan) as total_penjualan, 
                            sum(harga_penjualan) as harga, sum(itemterjual) as itemterjual FROM penjualan r  
                            join obat p on (r.kd_obat=p.kd_obat)
                            where 
                            tglpenjualan=CURDATE()  ");
          $h1 = mysqli_fetch_array($d1);
          $total1 = number_format($h1['itemterjual'],0,",",".");
          echo " $total1 -Item"; ?>  </span>
      
      
            </div>
      
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
    
    <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box border">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text" >Total Penjualan Hari Ini</span>
              <span class="info-box-number"> <?php $d1 = mysqli_query($config, "SELECT sum(total_penjualan) as total_penjualan, 
                            sum(harga_penjualan) as harga, sum(itemterjual) as itemterjual FROM penjualan r  
                            join obat p on (r.kd_obat=p.kd_obat)
                            where 
                            tglpenjualan=CURDATE()  ");
          $h1 = mysqli_fetch_array($d1);
          $total1 = number_format($h1['total_penjualan'],0,",",".");
          echo "Rp. $total1"; ?>  </span>
            </div>
      
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
      </div>


      <!-- Small boxes (Stat box) -->
   <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div style="background-color:#00c0ef;color:#fff" class="small-box">
          <div class="inner">
            <?php  
            // fungsi query untuk menampilkan data dari tabel obat
            $query = mysqli_query($config, "SELECT COUNT(kd_obat) as jumlah FROM obat")
                                            or die('Ada kesalahan pada query tampil Data Obat: '.mysqli_error($config));

            // tampilkan data
            $data = mysqli_fetch_assoc($query);
            ?>
            <h3><?php echo $data['jumlah']; ?></h3>
            <p>Jumlah Data Obat</p>
          </div>
          <div class="icon">
            <i class="fa fa-folder"></i>
          </div>
          
            <a href="<?php $_SERVER[SCRIPT_NAME];?>?page=obat_employee" class="small-box-footer" title="Lihat Data" data-toggle="tooltip"><i class="fa fa-plus"></i></a>
         
        </div>
      </div><!-- ./col -->

      

      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div style="background-color:#f39c12;color:#fff" class="small-box">
          <div class="inner">
            <?php  
            // fungsi query untuk menampilkan data dari tabel obat
           $query = mysqli_query($config, "SELECT COUNT(nopenjualan) as jumlah FROM penjualan WHERE month(tglpenjualan)='".date('m')."' ")
            or die('Ada kesalahan pada query tampil Data Obat: '.mysqli_error($config));
            // tampilkan data
            $data = mysqli_fetch_assoc($query);
            ?>
            <h3><?php echo $data['jumlah']; ?></h3>
            <p>Laporan Penjualan Obat Bulan Ini</p>
          </div>
          <div class="icon">
            <i class="fa fa-file-text-o"></i>
          </div>
          <a href="<?php $_SERVER[SCRIPT_NAME];?>?page=penjualan&act=view" class="small-box-footer" title="Lihat Laporan" data-toggle="tooltip"><i class="fa fa-print"></i></a>
        </div>
      </div><!-- ./col -->

      

     
<?php include 'theme/footer.php'; ?>