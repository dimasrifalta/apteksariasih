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
       
       
       <li class="treeview ">
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

      <li class="treeview active ">
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


<?php
switch ($_GET['act']) {

  // PROSES VIEW DATA LAPORAN PENJUALAN //      

 case 'view':
 ?>
 <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-file-text-o  icon-title"></i> Laporan Penjualan Obat


    </h1>

  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-3">
        <form action="<?php $_SERVER[SCRIPT_NAME];?>?page=penjualan&act=cek" method="POST">
          <div class="form-group">
            <label for="exampleInputEmail1">Tanggal Penjualan Awal</label>
            <input class="form-control" type="date" id="date" name="tglpenjualanaw" placeholder="MM/DD/YYY" type="text" required/>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="exampleInputEmail1">Tanggal Penjualan Akhir</label>
            <input class="form-control" type="date" id="date" name="tglpenjualanak" placeholder="MM/DD/YYY" type="text" required/>
          </div>
        </div>

        

        <div class="col-md-2">
          <div class="form-group">
            <label for="exampleInputEmail1">Mulai Pencarian</label><br>
            <input type="submit" value="Pencarian" class="btn btn-info">
          </div>
        </div>
      </form>



      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-warning">
          <div class="box-body">
            <div class="table-responsive">
             <table  class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>No Penjualan</th>
                  <th>Tanggal Penjualan</th>
                  <th>Nama Produk</th>
                  <th>Stok Obat</th>
                  <th>Karyawan</th>
                  <th>Jumlah Item Terjual</th>
                  
                </tr>
              </thead>
              <tbody>

                <tr>
                  <td align = "center" colspan="6"> <span style="font-weight:bold">TOTAL</span></td>

                  
                  <td><span style="font-weight:bold"><?php echo "Item :"?></td>
                  </tr>
                </tbody>
              </table>
            </div><!-- /.box-body -->
          </div>
        </div><!-- /.box -->
      </div> <!-- /.col -->
    </div>
    <!-- /.row (main row) -->
  </section> <!-- /.content -->
</div><!-- /.container -->
</div><!-- /.content-wrapper -->

<?php
break;


case 'cek':
  // menampilkan pertanyaan pertama

     //header('location:http://localhost/');



?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-file-text-o  icon-title"></i> Laporan Penjualan Obat


    </h1>

  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-2">
        <form action="<?php $_SERVER[SCRIPT_NAME];?>?page=penjualan&act=cek" method="POST">
          <div class="form-group">
            <label for="exampleInputEmail1">Tanggal Penjualan Awal</label>
            <input class="form-control" id="date" name="tglpenjualanaw" placeholder="MM/DD/YYY" type="date" required/>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <label for="exampleInputEmail1">Tanggal Penjualan Akhir</label>
            <input class="form-control" id="date" name="tglpenjualanak" placeholder="MM/DD/YYY" type="date" required/>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="exampleInputEmail1">Mulai Pencarian</label><br>
            <input type="submit" value="Pencarian" class="btn bg-orange">
          </div>
        </div>
      </form>
      <div class="col-md-2">
        <form action="<?php $_SERVER[SCRIPT_NAME];?>?page=cetak" method="POST" target="_blank">
          <label for="exampleInputEmail1"> Download PDF</label> <br>             
          <button type="submit" class="btn btn-info">
            <i class="fa fa-file-pdf-o"> Cetak </i>  
          </button>

          <div class="form-group">
            <input type="hidden" class="form-control" id="tglpenjualanaw" name="tglpenjualanaw" placeholder="Nama Konsumen" value= "<?php echo $_POST['tglpenjualanaw']?>">
            <input type="hidden" class="form-control" id="tglpenjualanak" name="tglpenjualanak" placeholder="Nama Konsumen" value= "<?php echo $_POST['tglpenjualanak']?>">
          </div>
        </form>
      </div>






      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-warning">
          <div class="box-body">
            <div class="table-responsive">
              <table id="penjualan" class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>No Penjualan</th>
                    <th>Tanggal Penjualan</th>
                    <th>Nama Produk</th>
                    <th>Stok Obat</th>
                    <th>Karyawan</th>
                    <th>Jumlah Item Terjual</th>
                    
                  </tr>
                </thead>
                <tfoot>

                  <th align = "center" colspan="6"> <span style="font-weight:bold">TOTAL</span></th>
                  <?php

                  $liatharga_penjualan=mysqli_fetch_array(mysqli_query($config,"SELECT sum(total_penjualan) as total_penjualan, 
                    sum(harga_penjualan) as harga_penjualan, sum(itemterjual) as itemterjual FROM penjualan r  
                    join obat p on (r.kd_obat=p.kd_obat)
                    where 
                    tglpenjualan BETWEEN '$_POST[tglpenjualanaw]' 
                    AND  '$_POST[tglpenjualanak]' ORDER BY nopenjualan ASC"));
                    ?>

                    <th align = "center"><span style="font-weight:bold">Item :<?php echo "". number_format("$liatharga_penjualan[itemterjual]",'0','.','.')?></th>
                      
                      


                    </tfoot>
                    <tbody>
                      <?php
                      $tampil=mysqli_query($config, "SELECT * FROM penjualan r
                        JOIN obat p ON ( r.kd_obat = p.kd_obat) where
                        tglpenjualan BETWEEN  '$_POST[tglpenjualanaw]' AND  '$_POST[tglpenjualanak]'
                        ORDER BY nopenjualan ASC");
                      $no = 1;
                      while ($r=mysqli_fetch_array($tampil)){
                        ?>
                        <tr>
                          <td><?php echo "$no"?></td>
                          <td><?php echo "$r[nopenjualan]"?></td>                         

                          <td align="left"><?php echo "$r[tglpenjualan]"?></td>
                          <td align="left"><?php echo "$r[nm_obat]"?></td>
                          <td align="left"><?php echo "$r[stok]"?></td>
                          <td align="left"><?php echo "$r[created_user]"?></td>
                          
                          <td align="left"><?php echo "$r[itemterjual]"?></td>
                          
                        </tr>

                        <?php
                        $no++;
                      }
                      ?>



                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div>
            </div><!-- /.box -->
          </div> <!-- /.col -->
        </div>
        <!-- /.row (main row) -->
      </section> <!-- /.content -->
    </div><!-- /.container -->




    <?php
    break;
  }
  ?>

  <?php include 'theme/footer.php'; ?>
