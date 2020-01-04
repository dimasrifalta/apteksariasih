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
        <li class="">
          <a href="<?php $_SERVER[SCRIPT_NAME];?>?page=dashboard">  
           <i class="fa fa-home"></i> <span>Dashboard</span>
         </a>
       </li>
       
       
       <li class="treeview active">
        <a href="#">
          <i class="fa fa-table"></i> <span>Master</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="active"> <a href="<?php $_SERVER[SCRIPT_NAME];?>?page=obat1">
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

     <li class="">
      <a href="<?php $_SERVER[SCRIPT_NAME];?>?page=pass">  
       <i class="glyphicon glyphicon-briefcase"></i> <span>Ganti Password</span>
     </a>
   </li>
   
   
 </ul>
 
 
</section>
<!-- /.sidebar -->
</aside>


<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-folder-o icon-title"></i> Data Obat 

      
    </h1>

  </section>

  <!-- Main content -->
  <section class="content">


    <!-- Default box -->
    <div class="box box-warning">
      <div class="box-header with-border">
        <div class="box-tools pull-right">
        </div>
      </div>
      <div class="box-body">
       <table id="example1" class="table table-bordered table-striped table-hover">
        <thead>
          <tr> 
            <th>No</th>
            <th>Kode Obat</th>
            <th>Nama Obat</th>
            <th>Stok</th>
            <th>Kategori</th>
            <th>Satuan</th>
          </thead>
          <tbody>
            <?php
            $sql="SELECT  * FROM obat";
            $no=1;
            if (!$result=  mysqli_query($config, $sql)){
              die('Error:'.mysqli_error($config));
            }  else {
              if (mysqli_num_rows($result)> 0){
                while ($row=  mysqli_fetch_assoc($result)){
                  ?>

                  <tr>
                    <td><?php echo $no ;?></td> 
                    <td><?php echo $row['kd_obat'];?></td>
                    <td><?php echo $row['nm_obat'];?></td>
                    <td><?php echo $row['stok'];?></td>
                    <td><?php echo $row['kategori'];?></td>
                    <td><?php echo $row['satuan'];?></td>

                  </tr> 
                  <?php    
                  $no++;                    
                }
              }  else {
                echo '';    
              }
            }?>
          </tbody>


        </table>
      </div><!-- /.box-body -->

    </div><!-- /.box --> 
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!-- Content Wrapper. Contains page content -->


<?php include 'theme/footer.php'; ?>