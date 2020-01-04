<?php
session_start();
if (empty($_SESSION['username'])) {
	echo "<script>window.location='../../login.php';</script>";
}
?>


<?php include 'theme/header.php';?>



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
if ($_SESSION['level'] == 'Apoteker') {
	echo "Apoteker";
} elseif ($_SESSION['level'] == 'Admin') {
	echo "Admin";
} elseif ($_SESSION['level'] == 'Karyawan') {
	echo "Kasir";
}

?></a>
        </div>
      </div>

      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Navigasi</li>
        <li class=""><a href="<?php $_SERVER[SCRIPT_NAME];?>?page=dashboard">
         <i class="fa fa-home"></i> <span>Dashboard</span>
       </a></li>



       <li class="treeview active">
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

      <li class = active><a href="<?php $_SERVER[SCRIPT_NAME];?>?page=anggota">
        <i class="fa fa-circle-o""></i> <span>Data Karyawan</span>
      </a>
    </li>

    <li><a href="<?php $_SERVER[SCRIPT_NAME];?>?page=stok_obat">
      <i class="fa fa-circle-o""></i> <span> Stok Obat</span>
    </a>
  </li>


<li class=""><a href="<?php $_SERVER[SCRIPT_NAME];?>?page=koreksi">
    <i class="fa fa-circle-o""></i> <span> Koreksi Stok Obat</span>
  </a>
</li>



</ul>
</li>





<li class="treeview ">
  <a href="#">
    <i class="fa fa-table"></i> <span>Transaksi</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
   <li class=""><a href="<?php $_SERVER[SCRIPT_NAME];?>?page=obat_masuk">
    <i class="fa fa-circle-o""></i> <span> Pembelian Obat</span>
  </a>
</li>



</ul>
</li>

<li class="treeview ">
  <a href="#">
    <i class="fa fa-pie-chart"></i>
    <span>Grafik</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li><a href="<?php $_SERVER[SCRIPT_NAME];?>?page=penjualan&act=view"><i class="fa fa-circle-o"></i> Laporan Penjualan</a></li>
    <li><a href="<?php $_SERVER[SCRIPT_NAME];?>?page=barang"><i class="fa fa-circle-o"></i> Grafik Laporan Stok Barang</a></li>
    <li><a href="<?php $_SERVER[SCRIPT_NAME];?>?page=laporan_transaksi"><i class="fa fa-circle-o"></i> Grafik Laporan Penjualan</a></li>

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
      <i class="fa  fa-user icon-title"></i> Data Karyawan


    </h1>

  </section>

  <!-- Main content -->
  <section class="content">



   <!--edit-->
   <?php

$id_karyawan = $_GET['id_karyawan'];
$sql = "SELECT  * FROM account where id_karyawan='$id_karyawan' ";

if (!$result = mysqli_query($config, $sql)) {
	die('Error:' . mysqli_error($config));
} else {
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			?>
        <div class="box box-danger">
          <div class="box-header with-border">
            Edit Karyawan
            <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
              <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <form action="admin/karyawan/aksi.php?sender=edit" method="POST">
            <div class="box-body">
              <div class="row">
                <div class="col-md-12 form-group">
                  <label>Nama Karyawan</label>
                  <input readonly="" type="hidden" name="id_karyawan" value="<?php echo $row['id_karyawan']; ?>" class="form-control" placeholder="Enter..." required="">
                  <input type="text" name="nama" value="<?php echo $row['nama']; ?>" class="form-control" placeholder="Enter..." required="">
                </div>

                <div class="col-md-12 form-group">
                  <label>Telepon</label>
                  <input type="number" name="telepon" value="<?php echo $row['telepon']; ?>" class="form-control" placeholder="Enter..." required="">
                </div>

                <div class="col-md-12 form-group">
                  <label>email</label>
                  <input type="email" name="email" value="<?php echo $row['email']; ?>" class="form-control" placeholder="Enter..." required="">
                </div>


                <div class="col-md-12 form-group">
                  <label>Reset Password</label>
                  <input type="password" name="password"  class="form-control" placeholder="password" >
                </div>


                <div class="col-md-12 form-group">

                  <label for="kg">Level  </label> <br>

                  <label class="radio-inline">
                   <input type="radio" name="level" id="level" value="2"  <?=$row['level'] == 2 ? "checked" : null?>> Level 2 (Apoteker)
                 </label>

                 <label class="radio-inline">
                   <input type="radio" name="level" value="3" <?=$row['level'] == 3 ? "checked" : null?>> Level 3 (Karyawan)
                 </label>

               </div>


               <div class="col-md-12 form-group">
                <label>Status</label>

                <select class="form-control" name="status" required>
                  <option value="<?php echo $row['status']; ?>"><?php echo $row['status']; ?></option>
                  <option value="aktif">aktif</option>
                  <option value="blokir">blokir</option>

                </select>



              </div>



              <div class="col-md-12 form-group">
               <button type="submit" class="btn btn-primary btn-flat pull-right"><span class="fa fa-send"></span> Simpan</button>
             </div>
           </div>
         </div></form>
       </div>
       <?php
}
	} else {
		echo '';
	}
}?>



<!-- Default box -->
<div class="box box-danger">
  <div class="box-header with-border">
    <h3 class="box-title"> <a href="#" data-toggle="modal" data-target="#my-modal1" class="btn btn-info"><li class="fa fa-plus"></li> Tambah</a></h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <div class="box-body">
   <table id="example1" class="table table-bordered table-striped table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>Nama Karyawan</th>
        <th>Telepon</th>
        <th>Email</th>
        <th>Level</th>
        <th>Status</th>
        <th>Aksi</th>


      </tr>
    </thead>
    <tbody>
      <?php
$sql = "SELECT  * FROM account WHERE level !=1";
$no = 1;
if (!$result = mysqli_query($config, $sql)) {
	die('Error:' . mysqli_error($config));
} else {
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			?>

            <tr>
              <td><?php echo $no; ?></td>
              <td><?php echo $row['nama']; ?></td>
              <td><?php echo $row['telepon']; ?></td>
              <td><?php echo $row['email']; ?></td>
              <td>
                <?php if ($row['level'] == 1) {
				echo "Admin";
			} elseif ($row['level'] == 2) {

				echo "Apoteker";
			} elseif ($row['level'] == 3) {

				echo "Kasir";
			}?>

             </td>
             <td>
              <?php
if ($row['status'] == 'aktif') {
				echo "Aktif";

			} elseif ($row['status'] == 'blokir') {
				echo "Di blokir";
			}

			?>


            </td>
            <td>
              <a href="<?php $_SERVER[SCRIPT_NAME];?>?page=anggota&id_karyawan=<?php echo $row['id_karyawan']; ?>" class="btn btn-info"><li class="fa fa-pencil"></li> Edit</a>
               <a href="#" onclick="confirm_modal('admin/karyawan/aksi.php?sender=hapus&id_karyawan=<?php echo $row['id_karyawan']; ?>');" class="btn bg-red smallbtn"><i class="glyphicon glyphicon-trash"></i></a>
                </td>
              </tr>
              <?php
$no++;
		}
	} else {
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
        <h4 class="modal-title" style="text-align:center;">Yakin anda ingin hapus data ini ? ?</h4>
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




<!-- Bootstrap Modal - To Add New Record -->
<!-- Modal -->

    <form action="admin/karyawan/aksi.php?sender=anggota" method="POST" >
      <div class="modal fade" id="my-modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">

          <div class="modal-content">
            <div class="modal-header">

              <h4 class="modal-title" id="myModalLabel">Tambah Data Karyawan</h4>
            </div>

            <div class="modal-body center">
             <!--Content-->


         <?php
$query_id = mysqli_query($config, "SELECT RIGHT(id_karyawan,3) as kode FROM account
                        ORDER BY id_karyawan DESC LIMIT 1")
or die('Ada kesalahan pada query tampil id_karyawan : ' . mysqli_error($config));

$count = mysqli_num_rows($query_id);

if ($count != 0) {
	// mengambil data kode transaksi
	$data_id = mysqli_fetch_assoc($query_id);
	$kode = $data_id['kode'] + 1;
} else {
	$kode = 1;
}

// buat kode_transaksi

$buat_id = str_pad($kode, 3, "0", STR_PAD_LEFT);
$kode_transaksi = "ID$buat_id";

?>
        <div class="form-group">
          <label>Id Karyawan</label>
          <input type="text" class="form-control" name="id_karyawan" value="<?php echo $kode_transaksi; ?>" readonly required>
        </div>

            <div class="form-group">
              <label>nama</label>
              <input type="text" name="nama" class="form-control" required="" autocomplete="off" placeholder="Enter ...">
            </div>

            <div class="form-group">
              <label>telepon</label>
              <input type="number" name="telepon" class="form-control" required="" autocomplete="off" placeholder="Enter ...">
            </div>

            <div class="form-group">
              <label>email</label>
              <input type="email" name="email" class="form-control" required="" autocomplete="off" placeholder="Enter ...">
            </div>


            <div class="form-group">
              <label>Username</label>
              <input type="text" name="username" class="form-control" required="" autocomplete="off" placeholder="Enter ...">
            </div>

            <div class="form-group">
              <label>Password</label>
              <input type="password" name="password" class="form-control" required="" placeholder="Enter ...">
            </div>


            <div class="form-group">
              <label for="level">Level</label>
              <div>
               <label class="radio-inline">
                 <input type="radio" name="level" id="level" value="2" required> level 2 (Apoteker)
               </label>

               <label class="radio-inline">
                 <input type="radio" name="level" value="3"> Level 3 (Kasir)
               </label>
             </div>
           </div>

           <div class="form-group">
            <label>Status</label>

            <select class="form-control" name="status" required>
              <option value="aktif">Aktif</option>
              <option value="blokir">Blokir</option>

            </select>



          </div>



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

<!-- Content Wrapper. Contains page content -->


<?php include 'theme/footer.php';?>