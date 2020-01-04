
<?php
session_start();
if (empty($_SESSION['username'])) {
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



       <li class="treeview ">
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

<li class="treeview active ">
  <a href="#">
    <i class="fa fa-pie-chart"></i>
    <span>Laporan</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li class="active"><a href="<?php $_SERVER[SCRIPT_NAME];?>?page=penjualan&act=view"><i class="fa fa-circle-o"></i> Laporan Penjualan</a></li>
    <li><a href="<?php $_SERVER[SCRIPT_NAME];?>?page=laporan_transaksi"><i class="fa fa-circle-o"></i> Grafik Laporan Penjualan</a></li>
    <li><a href="<?php $_SERVER[SCRIPT_NAME];?>?page=barang"><i class="fa fa-circle-o"></i> Grafik Laporan Stok Barang</a></li>


  </ul>
</li>

<li class="treeview">
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
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-danger">
         <div class=box-header with-border>
          <div class="container">
            <div class="box-header with-border">
              <div class="form-group">
               <label for="exampleInputEmail1">Cari Semua Pertanggal </label><br>
               <h3 class="box-title"> <a href="#" data-toggle="modal" data-target="#my-cetak" class="btn btn-info"><li class="fa fa-find"></li> Pencarian</a></h3>
             </div>
             <div class="box-tools pull-right">


               <div class="form-group">
                <label for="exampleInputEmail1">Cari Pertanggal dan Perkaryawan </label><br>
                <h3 class="box-title"> <a href="#" data-toggle="modal" data-target="#my-print" class="btn btn-info"><li class= "fa fa-printu"></li> Pencarian</a></h3>
              </div>
              <div class="box-tools pull-left">
              </div>
            </div>
          </div>

        </div>
      </div><!-- /.box -->
    </div> <!-- /.col -->
  </div>
</div>
<!-- /.row (main row) -->
</section> <!-- /.content -->
</div><!-- /.container -->
</div><!-- /.content-wrapper -->



<!--  //modal cetak data// -->


<form action="<?php $_SERVER[SCRIPT_NAME];?>?page=penjualan&act=cek" method="POST" >
  <!-- Modal Popup untuk delete -->
  <div class="modal fade small" id="my-cetak">
    <div class="modal-body center">
      <div class="modal-dialog">
        <div class="modal-content" style="margin-top:100px;">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Cari data penjualan Obat</h4>
          </div>
          <div class="modal-body center">
            <div class="row">
              <div class="col-md-6">
                <label >Penjualan Awal</label>
                <input type="date" class="form-control" data-date-format="dd-mm-yyyy" name="tglpenjualanaw" autocomplete="off" value=""  required>
              </div>
              <div class="col-md-6">
                <label >Penjualan Akhir</label>
                <input type="date" class="form-control" data-date-format="dd-mm-yyyy" name="tglpenjualanak" autocomplete="off" value=""  required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal"> Close</button>
              <button type="submit" class="btn btn-info"><i class="fa fa-print"></i> Cari</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>



<form action="<?php $_SERVER[SCRIPT_NAME];?>?page=penjualan&act=semua" method="POST" >
  <!-- Modal Popup untuk delete -->
  <div class="modal fade small" id="my-print">
    <div class="modal-body center">
      <div class="modal-dialog">
        <div class="modal-content" style="margin-top:100px;">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Cari data penjualan Obat</h4>
          </div>
          <div class="modal-body center">
            <div class="row">
              <div class="col-md-4">
                <label >Penjualan Awal</label>
                <input type="date" class="form-control" data-date-format="dd-mm-yyyy" name="tglpenjualanaw" autocomplete="off" value=""  required>
              </div>
              <div class="col-md-4">
                <label >Penjualan Akhir</label>
                <input type="date" class="form-control" data-date-format="dd-mm-yyyy" name="tglpenjualanak" autocomplete="off" value=""  required>
              </div>


              <div class="col-md-4">

                <label>Nama Karyawan</label> <br>
                <select class="form-control select2" id="pembelian" name="karyawan" style="width: 100%;" required>
                  <option value="">Silahkan Pilih</option>
                  <optgroup label="--- Nama karyawan ---">
                    <?php
$sql_pasien = mysqli_query($config, "SELECT nama FROM account where level=3 ") or die(mysqli_error($config));

	while ($data_pasien = mysqli_fetch_array($sql_pasien)) {
		echo '<option value="' . $data_pasien['nama'] . '">||| ' . $data_pasien['nama'] . '  </option>';
	}
	?>
                  </optgroup>
                </select>

              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal"> Close</button>
              <button type="submit" class="btn btn-info"><i class="fa fa-print"></i> Cari</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>



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
        <div class="col-md-2">
          <div class="form-group">
            <label for="exampleInputEmail1">Mulai Pencarian</label><br>
            <input type="submit" value="Pencarian" class="btn bg-orange">
          </div>
        </div>
      </form>

      <div class="col-md-2">
        <form action="<?php $_SERVER[SCRIPT_NAME];?>?page=penjualan&act=view" method="POST" >
          <label for="exampleInputEmail1"> Kembali</label> <br>
          <button type="submit" class="btn btn-success">
            <i class="fa fa-back"> Back </i>
          </button>

        </form>
      </div>
      <div class="col-md-2">
        <form action="<?php $_SERVER[SCRIPT_NAME];?>?page=cetak" method="POST" target="_blank">
          <label for="exampleInputEmail1"> Download PDF</label> <br>
          <button type="submit" class="btn btn-info">
            <i class="fa fa-file-pdf-o"> Cetak </i>
          </button>

          <div class="form-group">
            <input type="hidden" class="form-control" id="tglpenjualanaw" name="tglpenjualanaw" placeholder="Nama Konsumen" value= "<?php echo $_POST['tglpenjualanaw'] ?>">
            <input type="hidden" class="form-control" id="tglpenjualanak" name="tglpenjualanak" placeholder="Nama Konsumen" value= "<?php echo $_POST['tglpenjualanak'] ?>">
          </div>
        </form>
      </div>







      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-danger">
          <div class="box-body">
            <div class="table-responsive">
              <table id="penjualan" class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>No Penjualan</th>
                    <th>Tanggal Penjualan</th>
                    <th>Nama Produk</th>
                    <th>Karyawan</th>
                    <th>Harga Obat</th>
                    <th>Jumlah Item Terjual</th>
                    <th>Total Penjualan</th>
                  </tr>
                </thead>
                <tfoot>

                  <th align = "center" colspan="6"> <span style="font-weight:bold">TOTAL</span></th>
                  <?php

	$liatharga_penjualan = mysqli_fetch_array(mysqli_query($config, "SELECT sum(total_penjualan) as total_penjualan,
                    sum(harga_penjualan) as harga_penjualan, sum(itemterjual) as itemterjual FROM penjualan r
                    join obat p on (r.kd_obat=p.kd_obat)
                    where
                    tglpenjualan BETWEEN '$_POST[tglpenjualanaw]'
                    AND  '$_POST[tglpenjualanak]' ORDER BY nopenjualan DESC"));
	?>

                    <th align = "center"><span style="font-weight:bold">Item :<?php echo "" . number_format("$liatharga_penjualan[itemterjual]", '0', '.', '.') ?></th>

                      <th align = "center"><span style="font-weight:bold"><?php echo "Rp." . number_format("$liatharga_penjualan[total_penjualan]", '0', '.', '.') ?></th>


                      </tfoot>
                      <tbody>
                        <?php
$tampil = mysqli_query($config, "SELECT * FROM penjualan r
                          JOIN obat p ON ( r.kd_obat = p.kd_obat) where
                          tglpenjualan BETWEEN  '$_POST[tglpenjualanaw]' AND  '$_POST[tglpenjualanak]'
                          ORDER BY nopenjualan ASC");
	$no = 1;
	while ($r = mysqli_fetch_array($tampil)) {
		?>
                          <tr>
                            <td><?php echo "$no" ?></td>
                            <td><?php echo "$r[nopenjualan]" ?></td>

                            <td align="left"><?php echo "$r[tglpenjualan]" ?></td>
                            <td align="left"><?php echo "$r[nm_obat]" ?></td>
                            <td align="left"><?php echo "$r[created_user]" ?></td>
                            <td align="left"><?php echo "Rp." . number_format("$r[harga_penjualan]", '0', '.', '.') ?></td>
                            <td align="left"><?php echo "$r[itemterjual]" ?></td>
                            <td align="left"><?php echo "Rp." . number_format("$r[total_penjualan]", '0', '.', '.') ?></td>
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

case 'semua':
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
              <form action="<?php $_SERVER[SCRIPT_NAME];?>?page=penjualan&act=semua" method="POST">
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

              <div class="col-md-2">
               <div class="form-group">
                <label>Nama Karyawan</label> <br>
                <select class="form-control select2" id="pembelian" name="karyawan" style="width: 100%;" required>
                  <option value="">--- Silahkan Pilih ---</option>
                  <optgroup label="--- Nama karyawan ---">
                    <?php
$sql_pasien = mysqli_query($config, "SELECT nama FROM account where level=3 ") or die(mysqli_error($config));

	while ($data_pasien = mysqli_fetch_array($sql_pasien)) {
		echo '<option value="' . $data_pasien['nama'] . '">||| ' . $data_pasien['nama'] . '  </option>';
	}
	?>
                  </optgroup>
                </select>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <label for="exampleInputEmail1">Mulai Pencarian</label><br>
                <input type="submit" value="Pencarian" class="btn bg-orange">
              </div>
            </div>



          </form>


          <div class="col-md-2">
            <form action="<?php $_SERVER[SCRIPT_NAME];?>?page=penjualan&act=view" method="POST" >
              <label for="exampleInputEmail1"> Kembali</label> <br>
              <button type="submit" class="btn btn-success">
                <i class="fa fa-back"> Back </i>
              </button>

            </form>
          </div>

          <div class="col-md-2">
            <form action="<?php $_SERVER[SCRIPT_NAME];?>?page=cetak" method="POST" target="_blank">
              <label for="exampleInputEmail1"> Download PDF</label> <br>
              <button type="submit" class="btn btn-info">
                <i class="fa fa-file-pdf-o"> Cetak </i>
              </button>

              <div class="form-group">
                <input type="hidden" class="form-control" id="tglpenjualanaw" name="tglpenjualanaw" placeholder="Nama Konsumen" value= "<?php echo $_POST['tglpenjualanaw'] ?>">
                <input type="hidden" class="form-control" id="tglpenjualanak" name="tglpenjualanak" placeholder="Nama Konsumen" value= "<?php echo $_POST['tglpenjualanak'] ?>">
              </div>
            </form>
          </div>






          <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-danger">
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
                        <th>Harga Obat</th>
                        <th>Jumlah Item Terjual</th>
                        <th>Total Penjualan</th>
                      </tr>
                    </thead>
                    <tfoot>

                      <th align = "center" colspan="7"> <span style="font-weight:bold">TOTAL</span></th>
                      <?php

	$liatharga_penjualan = mysqli_fetch_array(mysqli_query($config, "SELECT sum(total_penjualan) as total_penjualan,
                        sum(harga_penjualan) as harga_penjualan, sum(itemterjual) as itemterjual FROM penjualan r
                        join obat p on (r.kd_obat=p.kd_obat)
                        where created_user='$_POST[karyawan]' AND
                        tglpenjualan BETWEEN '$_POST[tglpenjualanaw]'
                        AND  '$_POST[tglpenjualanak]' ORDER BY nopenjualan ASC"));
	?>

                        <th align = "center"><span style="font-weight:bold">Item :<?php echo "" . number_format("$liatharga_penjualan[itemterjual]", '0', '.', '.') ?></th>

                          <th align = "center"><span style="font-weight:bold"><?php echo "Rp." . number_format("$liatharga_penjualan[total_penjualan]", '0', '.', '.') ?></th>


                          </tfoot>
                          <tbody>
                            <?php
$tampil = mysqli_query($config, "SELECT * FROM penjualan r
                              JOIN obat p ON ( r.kd_obat = p.kd_obat) where created_user='$_POST[karyawan]' AND
                              tglpenjualan BETWEEN  '$_POST[tglpenjualanaw]' AND  '$_POST[tglpenjualanak]'
                              ORDER BY nopenjualan ASC");
	$no = 1;
	while ($r = mysqli_fetch_array($tampil)) {
		?>
                              <tr>
                                <td><?php echo "$no" ?></td>
                                <td><?php echo "$r[nopenjualan]" ?></td>

                                <td align="left"><?php echo "$r[tglpenjualan]" ?></td>
                                <td align="left"><?php echo "$r[nm_obat]" ?></td>
                                <td align="left"><?php echo "$r[stok]" ?></td>
                                <td align="left"><?php echo "$r[created_user]" ?></td>
                                <td align="left"><?php echo "Rp." . number_format("$r[harga_penjualan]", '0', '.', '.') ?></td>
                                <td align="left"><?php echo "$r[itemterjual]" ?></td>
                                <td align="left"><?php echo "Rp." . number_format("$r[total_penjualan]", '0', '.', '.') ?></td>
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
        <?php include 'theme/footer.php';?>
