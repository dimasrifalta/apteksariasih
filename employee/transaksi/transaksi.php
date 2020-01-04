
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
        <li class="header">NAVIGASI</li>
        <li class="treeview ">
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
          <li class=""> <a href="<?php $_SERVER[SCRIPT_NAME];?>?page=obat_employee">
            <i class="fa fa-circle-o"></i> <span>Stok Obat</span>
          </a></li></ul>
        </li>

        <li class="treeview active">
          <a href="#">
            <i class="fa fa-table"></i> <span>Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"> <a href="<?php $_SERVER[SCRIPT_NAME];?>?page=transaksi&act=view">
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

 <?php
switch ($_GET['act']) {

// PROSES VIEW DATA LAPORAN PENJUALAN //

case 'view':
	?>

  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class=" fa fa-line-chart"></i> Data Transaksi


    </h1>

  </section>

  <!-- Main content -->
  <section class="content">


    <!-- Default box -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title"> <a href="#" data-toggle="modal" data-target="#my-modal1" class="btn btn-info"><li class="fa fa-plus"></li> Tambah</a></h3>
        <div class="box-tools pull-right">
        </div>
      </div>
      <div class="box-body">
       <table id="example1" class="table table-bordered table-striped table-hover">
        <thead>
          <tr>

            <th>No</th>
            <th>No Penjualan</th>
            <th>Kasir</th>
            <th>Tanggal Penjualan</th>
            <th>Lihat Transaksi</th>


          </tr>
        </thead>
        <tbody>
          <?php
$sql = "SELECT * FROM detail_penjualan

          ORDER BY nopenjualan DESC";
	$no = 1;
	if (!$result = mysqli_query($config, $sql)) {
		die('Error:' . mysqli_error($config));
	} else {
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				?>
                <tr>

                  <td><?php echo $no; ?></td>
                  <td><?php echo $row['nopenjualan']; ?></td>
                  <td><?php echo $row['kasir']; ?></td>
                  <td><?php echo $row['tgl_beli']; ?></td>
                  <td align="center">
                    <a href="<?php $_SERVER[SCRIPT_NAME];?>?page=print&nopenjualan=<?php echo $row['nopenjualan']; ?>" class="btn btn-info"><li class="glyphicon glyphicon-eye-open"></li> Lihat</a>
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





<!-- Bootstrap Modal - To Add New Record -->
<!-- Modal -->

<form action="employee/transaksi/aksi_transaksi.php?sender=order" method="POST" >
  <div class="modal fade" id="my-modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">

      <div class="modal-content">
        <div class="modal-header">

          <h4 class="modal-title" id="myModalLabel">Tambah Data Obat</h4>
        </div>

        <div class="modal-body center">
         <!--Content-->


         <?php
$query_id = mysqli_query($config, "SELECT RIGHT(nopenjualan,7) as kode FROM detail_penjualan
          ORDER BY nopenjualan DESC LIMIT 1")
	or die('Ada kesalahan pada query tampil kode_transaksi : ' . mysqli_error($config));

	$count = mysqli_num_rows($query_id);

	if ($count != 0) {
		// mengambil data kode transaksi
		$data_id = mysqli_fetch_assoc($query_id);
		$kode = $data_id['kode'] + 1;
	} else {
		$kode = 1;
	}

	// buat kode_transaksi
	$tahun = date("Y");
	$buat_id = str_pad($kode, 7, "0", STR_PAD_LEFT);
	$kode_transaksi = "PN-$tahun-$buat_id";

	?>


        <div class="form-group">
          <input type="text" class="form-control" id="nopenj" name="nopenj" placeholder="Nomor Penjualan" value="<?php echo $kode_transaksi ?>" required data-fv-notempty-message="Tidak boleh kosong" disabled>
          <input type="hidden" class="form-control" id="nopenjualan" name="nopenjualan" placeholder="Nomor Penjualan" value="<?php echo $kode_transaksi ?>" required data-fv-notempty-message="Tidak boleh kosong">
        </div>



        <div class="form-group">
          <label>Nama Produk</label> <br>
          <select class="form-control select2" id="pembelian" name="kd_beli" style="width: 100%;" required>
            <option value="">--- Silahkan Pilih ---</option>
            <optgroup label="--- Nama Produk ---">
              <?php
$sql_pasien = mysqli_query($config, "SELECT * FROM pembelian
               INNER JOIN obat ON pembelian.kd_obat = obat.kd_obat WHERE stok_saat_ini >=1 AND status != 'expired' AND tgl_exp >= now() ORDER by tgl_exp asc  ") or die(mysqli_error($config));

	while ($data_pasien = mysqli_fetch_array($sql_pasien)) {
		echo '<option value="' . $data_pasien['kd_beli'] . '">  EXP: ' . $data_pasien['tgl_exp'] . '  ||' . $data_pasien['nm_obat'] . ' || SATUAN: &nbsp;' . $data_pasien['satuan'] . ' ||STOK: &nbsp ' . $data_pasien['stok_saat_ini'] . ' </option>';
	}
	?>
           </optgroup>
         </select>
       </div>



         <div class="form-group">
          <label>Jumlah Pembelian</label>
          <input type="number" min="1" class="form-control" name="itemterjual" required>
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


<?php
break;

case 'cek':
	// menampilkan pertanyaan pertama

	//header('location:http://localhost/');

	?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class=" fa fa-line-chart"></i> Data Transaksi


    </h1>

  </section>

  <!-- Main content -->
  <section class="content">

<?php
$query_id = mysqli_query($config, "SELECT RIGHT(nopenjualan,7) as kode FROM detail_penjualan
          ORDER BY nopenjualan DESC LIMIT 1")
	or die('Ada kesalahan pada query tampil kode_transaksi : ' . mysqli_error($config));

	$count = mysqli_num_rows($query_id);

	if ($count != 0) {
		// mengambil data kode transaksi
		$data_id = mysqli_fetch_assoc($query_id);
		$kode = $data_id['kode'] + 1;
	} else {
		$kode = 1;
	}

	// buat kode_transaksi
	$tahun = date("Y");
	$buat_id = str_pad($kode, 7, "0", STR_PAD_LEFT);
	$kode_transaksi = "PN-$tahun-$buat_id";

	?>

   <form action="employee/transaksi/aksi_transaksi.php?sender=transaksi" method="POST" >
    <div class="box box box-success box-solid">
      <div class="box-header">


        <div class="form-group">
                <label for="inputPassword3" class="col-sm-1 control-label">No Penjualan </label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" disabled name="no_transaksi" value="<?php echo "$kode_transaksi"; ?>">
                  <input type="hidden" name="nopenjualan" value="<?php echo "$kode_transaksi"; ?>">

                </div>
              </div>

        <div class="box-tools pull-right">
          <h3 class="box-title"> <a href="#" data-toggle="modal" data-target="#my-modal1" class="btn btn-info"><li class="fa fa-plus"></li> Tambah</a></h3>
        </div>
      </div>
      <div class="box box-primary">
        <div class="box-header with-border">

          <div class="box-tools pull-right">
          </div>
        </div>
        <div class="box-body">

         <table id="" class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th>Nama Obat</th>
              <th>Tanggal Penjualan</th>
              <th>Harga</th>
              <th>Jumlah Beli</th>
              <th>Total Penjualan</th>
              <th>Aksi</th>




            </tr>
          </thead>
          <tbody>

           <?php
$sql = "SELECT * FROM temp_penjualan
           INNER JOIN obat ON temp_penjualan.kd_obat = obat.kd_obat
           ORDER BY created_date DESC";
	$no = 1;
	if (!$result = mysqli_query($config, $sql)) {
		die('Error:' . mysqli_error($config));
	} else {
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				?>
                <tr>
                  <td><?php echo $row['nm_obat']; ?></td>
                  <td><?php echo $row['tglpenjualan']; ?></td>
                  <td><?php echo "Rp." . number_format("$row[harga_penjualan]", '0', '.', '.') ?></td>
                  <td><?php echo "$row[itemterjual]" ?></td>
                  <td><?php echo "Rp." . number_format("$row[total_penjualan]", '0', '.', '.') ?></td>
                  <td>
                     <a href="#" onclick="confirm_modal('employee/transaksi/aksi_transaksi.php?sender=hapus&kd_pembelian=<?php echo $row['id_temp']; ?>');" class="btn bg-red smallbtn"><i class="glyphicon glyphicon-trash"></i></a>
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

      <div class="modal-footer">

        <button type="submit" class="btn btn-info"> Simpan</button>
      </div>
      <p>*/jika ada data dikeranjang obat mohon terlebih dahulu di hapus</p>
    </section><!-- /.content -->

  </form>

</div><!-- /.content-wrapper -->


<!-- Modal Popup untuk delete -->
<div class="modal fade small" id="modalDelete">
  <div class="modal-dialog">
    <div class="modal-content" style="margin-top:100px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" style="text-align:center;">Yakin anda ingin mengahapus keranjang ini??</h4>
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

<form action="employee/transaksi/aksi_transaksi.php?sender=order" method="POST" >
  <div class="modal fade" id="my-modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">

      <div class="modal-content">
        <div class="modal-header">

          <h4 class="modal-title" id="myModalLabel">Tambah Data Obat</h4>
        </div>

        <div class="modal-body center">
         <!--Content-->


         <?php
$query_id = mysqli_query($config, "SELECT RIGHT(nopenjualan,7) as kode FROM detail_penjualan
          ORDER BY nopenjualan DESC LIMIT 1")
	or die('Ada kesalahan pada query tampil kode_transaksi : ' . mysqli_error($config));

	$count = mysqli_num_rows($query_id);

	if ($count != 0) {
		// mengambil data kode transaksi
		$data_id = mysqli_fetch_assoc($query_id);
		$kode = $data_id['kode'] + 1;
	} else {
		$kode = 1;
	}

	// buat kode_transaksi
	$tahun = date("Y");
	$buat_id = str_pad($kode, 7, "0", STR_PAD_LEFT);
	$kode_transaksi = "PN-$tahun-$buat_id";

	?>


        <div class="form-group">
          <input type="text" class="form-control" id="nopenj" name="nopenj" placeholder="Nomor Penjualan" value="<?php echo $kode_transaksi ?>" required data-fv-notempty-message="Tidak boleh kosong" disabled>
          <input type="hidden" class="form-control" id="nopenjualan" name="nopenjualan" placeholder="Nomor Penjualan" value="<?php echo $kode_transaksi ?>" required data-fv-notempty-message="Tidak boleh kosong">
        </div>



        <div class="form-group">
          <label>Nama Produk</label> <br>
          <select class="form-control select2" id="pembelian" name="kd_beli" style="width: 100%;" required>
            <option value="">--- Silahkan Pilih ---</option>
            <optgroup label="--- Nama Produk ---">
              <?php
$sql_pasien = mysqli_query($config, "SELECT * FROM pembelian
               INNER JOIN obat ON pembelian.kd_obat = obat.kd_obat WHERE stok_saat_ini >=1 AND status != 'expired' AND tgl_exp >= now() ORDER by tgl_exp asc  ") or die(mysqli_error($config));

	while ($data_pasien = mysqli_fetch_array($sql_pasien)) {
		echo '<option value="' . $data_pasien['kd_beli'] . '">  EXP: ' . $data_pasien['tgl_exp'] . '  ||' . $data_pasien['nm_obat'] . ' || SATUAN: &nbsp;' . $data_pasien['satuan'] . ' ||STOK: &nbsp ' . $data_pasien['stok_saat_ini'] . ' </option>';
	}
	?>
           </optgroup>
         </select>
       </div>

         <div class="form-group">
          <label>Jumlah Pembelian</label>
          <input type="number" min="1" class="form-control" name="itemterjual" required>
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





<?php
break;
}
?>







<!-- Content Wrapper. Contains page content -->




<?php include 'theme/footer.php';?>