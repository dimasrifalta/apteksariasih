
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
        <li class="header">Navigasi</li>
        <li class=""><a href="<?php $_SERVER[SCRIPT_NAME];?>?page=dashboard">  
         <i class="fa fa-home"></i> <span>Dashboard</span>
       </a></li>



       <li class="treeview active ">
        <a href="#">
          <i class="fa fa-table"></i> <span>Master </span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php $_SERVER[SCRIPT_NAME];?>?page=obat">
            <i class="fa fa-circle-o""></i> <span> Data Obat</span>  
          </a>
        </li>

        <li><a href="<?php $_SERVER[SCRIPT_NAME];?>?page=supplier">
          <i class="fa fa-circle-o""></i> <span> Data Supplier</span>  
        </a>
      </li>

      <li><a href="<?php $_SERVER[SCRIPT_NAME];?>?page=anggota">
        <i class="fa fa-circle-o""></i> <span>Data Karyawan</span>  
      </a>
    </li>

    <li><a href="<?php $_SERVER[SCRIPT_NAME];?>?page=stok_obat">
      <i class="fa fa-circle-o""></i> <span> Stok Obat</span>  
    </a>
  </li>

<li class="active"><a href="<?php $_SERVER[SCRIPT_NAME];?>?page=koreksi">
    <i class="fa fa-circle-o""></i> <span> Koreksi Stok Obat</span>  
  </a>
</li>



</ul>
</li>





<li class="treeview  ">
  <a href="#">
    <i class="fa fa-table"></i> <span>Transaksi</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
   <li class="active"><a href="<?php $_SERVER[SCRIPT_NAME];?>?page=obat_masuk">
    <i class="fa fa-circle-o""></i> <span> Pembelian Obat</span>  
  </a>
</li>


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
    <li><a href="<?php $_SERVER[SCRIPT_NAME];?>?page=laporan_transaksi"><i class="fa fa-circle-o"></i> Grafik Laporan Penjualan</a></li>  
    <li><a href="<?php $_SERVER[SCRIPT_NAME];?>?page=barang"><i class="fa fa-circle-o"></i> Grafik Laporan Stok Barang</a></li>
      
    
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
      <i class="fa fa-folder-o icon-title"></i> Koreksi Stok Obat

      
    </h1>

  </section>

  <!-- Main content -->
  <section class="content">

    <!--edit-->
    <?php
    
    $kd_beli=$_GET['kd_beli'];
    $sql="SELECT * FROM pembelian
    INNER JOIN obat ON pembelian.kd_obat = obat.kd_obat
    where kd_beli='$kd_beli' ";
    
    if (!$result=  mysqli_query($config, $sql)){
      die('Error:'.mysqli_error($config));
    }  else {
      if (mysqli_num_rows($result)> 0){
        while ($row=  mysqli_fetch_assoc($result)){
          ?>
          <div class="box box-danger">
            <div class="box-header with-border">
              Koreksi Stok OBAT 
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div> 
            </div> 
            <form action="admin/obat_masuk/aksi_obat_masuk.php?sender=edit" method="POST">
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12 form-group">
                    <label>Nama Obat</label>
                    <input readonly="" type="hidden" name="kd_beli" value="<?php echo $row['kd_beli'];?>" class="form-control" placeholder="Enter..." required="">
                    <input type="text" name="nm_obat" value="<?php echo $row['nm_obat'];?>" class="form-control" readonly>
                  </div>                   

                  <div class="col-md-12 form-group">

                    <input readonly="" type="hidden" name="id_koreksi" value="<?php echo $row['kode_koreksi'];?>" class="form-control" readonly>
                  </div>

                  <div class="col-md-12 form-group">
                    <label>Stok Saat Ini</label>                   
                    <input type="text" name="stok_saat_ini" value="<?php echo $row['stok_saat_ini'];?>" class="form-control" readonly>
                  </div>  

                  <div class="col-md-12 form-group">
                    <label>Koreksi Stok</label>                   
                    <input type="number" name="koreksi_stok" value="" class="form-control" required="" autocomplete="off">
                  </div>  



                  <div class="col-md-12 form-group">
                    <label for="keterangan" id="ket">keterangan</label>
                    <textarea name="keterangan" id="keterangan" class="form-control" required></textarea>
                  </div>  


                  


                  <div class="col-md-12 form-group">
                   <button type="submit" class="btn btn-primary btn-flat pull-right"><span class="fa fa-send"></span> Simpan</button>
                 </div>
               </div> 
             </div></form>
           </div>
           <?php                
         }
       }  else {
        echo '';    
      }
    }?> 


    <!--Retur-->
    <?php
    
    $kd_beli=$_GET['kd_retur'];
    $sql="SELECT * FROM pembelian
    INNER JOIN obat ON pembelian.kd_obat = obat.kd_obat
    where kd_beli='$kd_beli' ";
    
    if (!$result=  mysqli_query($config, $sql)){
      die('Error:'.mysqli_error($config));
    }  else {
      if (mysqli_num_rows($result)> 0){
        while ($row=  mysqli_fetch_assoc($result)){
          ?>
          <div class="box box-danger">
            <div class="box-header with-border">
              Retur Obat 
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div> 
            </div> 
            <form action="admin/obat_masuk/aksi_obat_masuk.php?sender=hapus" method="POST">
              <div class="box-body">
                <div class="row">


                  <div class="col-md-12 form-group">
                    <label>Kode Beli</label>                   
                    <input type="text" name="kd_beli" value="<?php echo $row['kd_beli'];?>" class="form-control" readonly>
                  </div>


                  <div class="col-md-12 form-group">

                    <input type="hidden" name="id_koreksi" value="<?php echo $row['kode_koreksi'];?>" class="form-control" readonly>
                  </div>


                  <div class="col-md-12 form-group">
                    <label>Nama Obat</label>                   
                    <input type="text" name="nm_obat" value="<?php echo $row['nm_obat'];?>" class="form-control" readonly>
                  </div>  

                  

                  

                  <div class="col-md-12 form-group">
                    <label>Stok Saat Ini</label>                   
                    <input type="text" name="stok_saat_ini" value="<?php echo $row['stok_saat_ini'];?>" class="form-control" readonly>
                  </div>  

                  <div class="col-md-12 form-group">
                    <label>Jumlah Yang di Retur</label>                   
                    <input type="number" min="1" class="form-control" name="jumlah_retur" max="<?php echo $row['stok_saat_ini'];?>" >
                  </div>  



                  <div class="col-md-12 form-group">
                    <label for="keterangan" id="ket">keterangan</label>
                    <textarea name="keterangan" id="keterangan" class="form-control" required></textarea>
                  </div>  


                  


                  <div class="col-md-12 form-group">
                   <button type="submit" class="btn btn-primary btn-flat pull-right"><span class="fa fa-send"></span> Simpan</button>
                 </div>
               </div> 
             </div></form>
           </div>
           <?php                
         }
       }  else {
        echo '';    
      }
    }?> 





    <!--Lihat LOG -->
    <?php
    
    $kd_beli=$_GET['kd_log'];
    $sql="SELECT * FROM tb_keterangan 
    where kode_koreksi='$kd_beli' ";
    
    if (!$result=  mysqli_query($config, $sql)){
      die('Error:'.mysqli_error($config));
    }  else {
      if (mysqli_num_rows($result)> 0){?>



      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Catatan Koreksi Yang di lakukan pada Obat </h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
           <table id="examp" class="table table-bordered table-striped table-hover">
            <thead>
              <tr>

                <th>Status</th>

                <th>Jumlah Update</th>
                <th>Keterangan</th>
                <th>Tanggal Koreksi</th>

              </tr>
            </thead>
            <tbody>

              <tr><?php while ($row=  mysqli_fetch_assoc($result)){  ?>              

                <td><?php echo $row['status'];?></td>
                <td><?php echo $row['jumlah_update'];?></td>
                <td><?php echo $row['keterangan'];?></td>

                <td><?php echo $row['log_tanggal'];?></td>


              </tr> 


            </tr>
            <?php                
          }?>

          
        </tbody>
      </table>
    </div>
    <!-- /.table-responsive -->
    
  </div>
  <!-- /.box -->
</div>
<!-- /.col -->

<?php }  else {
  echo '';    
}
}?> 








<!-- Default box -->


<div class="box box-danger">
  <div class="box-header with-border">
    <h3 class="box-title">
      <div class="box-tools pull-left">
      </div>
    </div>
    <div class="box-body">
     <table id="example1" class="table table-bordered table-striped table-hover">
      <thead>
        <tr> 
          <th>No</th>
          <th>Kode Beli</th>
          <th>Tanggal pembelian</th>
          <th>Nama Obat</th>
          <th>Stok</th>       
          <th>Expired</th>

          <th>Koreksi Stok</th>
          <th>Log Koreksi </th>




        </tr>
      </thead>
      <tbody>
        <?php

        $no = 1 ;
        $sql = "SELECT * FROM pembelian
        INNER JOIN obat ON pembelian.kd_obat = obat.kd_obat
        INNER JOIN tb_koreksi ON pembelian.kode_koreksi = tb_koreksi.id_koreksi ORDER BY tgl_exp asc " ;


        if (!$result=  mysqli_query($config, $sql)){
          die('Error:'.mysqli_error($config));
        }  else {
          if (mysqli_num_rows($result)> 0){
            while ($row=  mysqli_fetch_assoc($result)){
              ?>
              <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $row['kd_beli'] ;?></td>
                <td><?php echo $row['tglpembelian'] ;?></td>
                <td><?php echo $row['nm_obat'];?></td>
                <td><?php echo $row['stok_saat_ini'];?></td>
                <td><?php echo $row['tgl_exp'];?></td>

                <td align="center">
                  <?php

                  if ($row['status']=="expired") { ?>

                  <a href="#"  class="btn bg-green smallbtn"><i>Sudah Expired</i></a>
                  
                  <?php
                } else { ?>


                <a href="<?php $_SERVER[SCRIPT_NAME] ;?>?page=koreksi&kd_beli=<?php echo $row['kd_beli'];?>" class="btn btn-info"><li class="fa fa-pencil"></li> Edit</a> 
                <a href="<?php $_SERVER[SCRIPT_NAME] ;?>?page=koreksi&kd_retur=<?php echo $row['kd_beli'];?>" class="btn btn-warning"><li class="fa fa-refresh"></li> Retur</a>
                <a href="#" onclick="confirm_modal('admin/obat_masuk/aksi_obat_masuk.php?sender=expired&kd_beli=<?php echo $row['kd_beli']; ?>');" class="btn bg-red smallbtn"><i class="glyphicon glyphicon-trash"> Expired</i></a>

                <?php
              } ?>
            </td>
            <td>
              <a href="<?php $_SERVER[SCRIPT_NAME] ;?>?page=koreksi&kd_log=<?php echo $row['id_koreksi'];?>" class="btn btn-info"><li class="glyphicon glyphicon-eye-open"></li> Lihat</a> 
            </td>




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










<!-- Modal Popup untuk delete --> 
<div class="modal fade small" id="modalDelete">
  <div class="modal-dialog">
    <div class="modal-content" style="margin-top:100px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" style="text-align:center;">Yakin anda ingin menghapus stok obat ini ? ?</h4>
      </div>
      <div>

      </div>
      
      <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
        <a href="#" class="btn btn-danger" id="delete_link">Hapus</a>
        <button type="button" class="btn btn-success" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function confirm_modal(delete_url)
  {
    $('#modalDelete').modal('show', {backdrop: 'static'});
    document.getElementById('delete_link').setAttribute('href' , delete_url);
  }
</script>
<!-- ahir Modal Popup untuk delete --> 



<!--  //modal cetak data// -->


<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Detail Barang</h4>
      </div>
      <div class="modal-body">
        <div class="fetched-data"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  $(document).ready(function(){
    $('#myModal').on('show.bs.modal', function (e) {
      var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
              type : 'post',
              url : '.admin/daftar_expired/detail.php',
              data :  'rowid='+ rowid,
              success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
              }
            });
          });
  });
</script>



</form>









<!-- Bootstrap Modal - To Add New Record -->
<!-- Modal -->

<form action="admin/obat_masuk/aksi_obat_masuk.php?sender=obat_masuk" method="POST" >
  <div class="modal fade" id="my-modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">

      <div class="modal-content">
        <div class="modal-header">

          <h4 class="modal-title" id="myModalLabel">Tambah Pembelian Obat</h4>
        </div>

        <div class="modal-body center"> 
         <!--Content-->


         <?php
         $query_id = mysqli_query($config, "SELECT RIGHT(kd_beli,7) as kode FROM pembelian
          ORDER BY kd_beli DESC LIMIT 1")
         or die('Ada kesalahan pada query tampil kode_transaksi : '.mysqli_error($config));

         $count = mysqli_num_rows($query_id);

         if ($count <> 0) {
                  // mengambil data kode transaksi
          $data_id = mysqli_fetch_assoc($query_id);
          $kode    = $data_id['kode']+1;
        } else {
          $kode = 1;
        }

              // buat kode_transaksi
        $tahun          = date("Y");
        $buat_id        = str_pad($kode, 7, "0", STR_PAD_LEFT);
        $kode_transaksi = "TM-$tahun-$buat_id";

        ?>


        <div class="form-group">
          <label>Kode beli</label>
          <input type="text" class="form-control" name="kode_transaksi" value="<?php echo $kode_transaksi; ?>" readonly required>
          
        </div>

        
        <div class="form-group">
          <label>Nama Supplier</label> <br>
          <select class="form-control select2" id="pembelian" name="id_supplier" style="width: 100%;" required>
            <option value="">--- Silahkan Pilih ---</option>
            <optgroup label="--- Nama Produk ---">
              <?php
              $sql_pasien = mysqli_query($config, "SELECT * FROM supplier order by id_supplier") or die (mysqli_error($config));

              while ($data_pasien = mysqli_fetch_array($sql_pasien)) {
                echo '<option value="'.$data_pasien['id_supplier'].'">'.$data_pasien['id_supplier'].'  ||    '.$data_pasien['nama'].' </option>';
              }
              ?>
            </optgroup>
          </select>
        </div>

        <div class="form-group">
          <label >Tanggal Expired</label>
          <input class="form-control" id="date" name="tgl_exp" placeholder="MM/DD/YYY" type="date" autocomplete="off" required >
        </div>

        <div class="form-group">
          <label>Nama Produk</label> <br>
          <select class="form-control select2" id="pembelian" name="kd_obat" style="width: 100%;" required>
            <option value="">--- Silahkan Pilih ---</option>
            <optgroup label="--- Nama Produk ---">
              <?php
              $sql_pasien = mysqli_query($config, "SELECT * FROM obat order by kd_obat ") or die (mysqli_error($config));

              while ($data_pasien = mysqli_fetch_array($sql_pasien)) {
               echo '<option value="'.$data_pasien['kd_obat'].'"> '.$data_pasien['kd_obat'].'  ||   '.$data_pasien['nm_obat'].' ||   '.$data_pasien['satuan'].'  </option>';
             }
             ?>
           </optgroup>
         </select>
       </div>

       <div class="form-group">
        <label>Jumlah Pembelian</label>
        <input type="number" class="form-control" id="jumlah_beli" name="jumlah_beli" placeholder="Jumlah Pembelian" required data-fv-notempty-message="Tidak boleh kosong">
      </div>

      

      


      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"> Close</button>
        <button type="submit" class="btn btn-info"> Simpan</button> 

      </div>

    </div>
  </div>
</div>
</form>


</div>
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="plugins/select2/select2.min.js"></script>

<script>

  $(document).ready(function() {
    $("#pembelian ").select2({
      dropdownParent: $("#my-modal1")
    });
  });

</script>







<!-- Content Wrapper. Contains page content -->




<?php include 'theme/footer.php'; ?>