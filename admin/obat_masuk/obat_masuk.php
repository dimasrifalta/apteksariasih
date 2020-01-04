<?php
session_start();
if (empty($_SESSION['username'])) {
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
      <li class=""><a href="<?php $_SERVER[SCRIPT_NAME]; ?>?page=dashboard">
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
          <li><a href="<?php $_SERVER[SCRIPT_NAME]; ?>?page=obat">
              <i class="fa fa-circle-o""></i> <span> Data Obat</span>
          </a>
        </li>

        <li><a href=" <?php $_SERVER[SCRIPT_NAME]; ?>?page=supplier">
                <i class="fa fa-circle-o""></i> <span> Data Supplier</span>
        </a>
      </li>

      <li><a href=" <?php $_SERVER[SCRIPT_NAME]; ?>?page=anggota">
                  <i class="fa fa-circle-o""></i> <span>Data Karyawan</span>
      </a>
    </li>

    <li><a href=" <?php $_SERVER[SCRIPT_NAME]; ?>?page=stok_obat">
                    <i class="fa fa-circle-o""></i> <span> Stok Obat</span>
    </a>
  </li>


<li class=""><a href=" <?php $_SERVER[SCRIPT_NAME]; ?>?page=koreksi">
                      <i class="fa fa-circle-o""></i> <span> Koreksi Stok Obat</span>
  </a>
</li>



</ul>
</li>





<li class=" treeview active ">
  <a href=" #">
                        <i class="fa fa-table"></i> <span>Transaksi</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
            </a>
            <ul class="treeview-menu">
              <li class="active"><a href="<?php $_SERVER[SCRIPT_NAME]; ?>?page=obat_masuk">
                  <i class="fa fa-circle-o""></i> <span> Pembelian Obat</span>
  </a>
</li>



</ul>
</li>

<li class=" treeview ">
  <a href=" #">
                    <i class="fa fa-pie-chart"></i>
                    <span>Laporan</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="<?php $_SERVER[SCRIPT_NAME]; ?>?page=penjualan&act=view"><i class="fa fa-circle-o"></i>
                      Laporan Penjualan</a></li>
                  <li><a href="<?php $_SERVER[SCRIPT_NAME]; ?>?page=laporan_transaksi"><i class="fa fa-circle-o"></i>
                      Grafik Laporan Penjualan</a></li>
                  <li><a href="<?php $_SERVER[SCRIPT_NAME]; ?>?page=barang"><i class="fa fa-circle-o"></i> Grafik Laporan
                      Stok Barang</a></li>


                </ul>
              </li>

              <li class="treeview">
                <a href="<?php $_SERVER[SCRIPT_NAME]; ?>?page=pass">
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
      <i class="fa fa-folder-o icon-title"></i> Data Obat Masuk


    </h1>

  </section>

  <!-- Main content -->
  <section class="content">


    <!-- Default box -->
    <div class="box box-danger">
      <div class="box-header with-border">
        <h3 class="box-title"> <a href="#" data-toggle="modal" data-target="#my-modal1" class="btn btn-info">
            <li class="fa fa-plus"></li> Tambah
          </a></h3>
        <div class="box-tools pull-right">

          <h3 class="box-title"> <a href="#" data-toggle="modal" data-target="#my-cetak" class="btn btn-primary btn-social" target="_blank">
              <li class="fa fa-print"></li> Cetak
            </a></h3>
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
                <th>Supplier</th>
                <th>Harga Beli</th>
                <th>Jumlah Beli</th>
                <th>Total Pembelian</th>
                <th>Expired</th>

              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $sql = "SELECT * FROM pembelian
            INNER JOIN obat ON pembelian.kd_obat = obat.kd_obat
            INNER JOIN supplier ON pembelian.id_supplier = supplier.id_supplier ORDER BY kd_beli DESC ";

              if (!$result = mysqli_query($config, $sql)) {
                die('Error:' . mysqli_error($config));
              } else {
                if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
              ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $row['kd_beli']; ?></td>
                      <td><?php echo $row['tglpembelian']; ?></td>
                      <td><?php echo $row['nm_obat']; ?></td>
                      <td><?php echo $row['nama']; ?></td>
                      <td><?php echo "Rp." . number_format("$row[harga_pembelian]", '0', '.', '.') ?></td>
                      <td><?php echo "$row[jumlah_beli]" ?></td>
                      <td><?php echo "Rp." . number_format("$row[totalpembelian]", '0', '.', '.') ?></td>
                      <td><?php echo $row['tgl_exp']; ?></td>


                    </tr>
              <?php
                    $no++;
                  }
                } else {
                  echo '';
                }
              } ?>
            </tbody>


          </table>
        </div><!-- /.box-body -->

      </div><!-- /.box -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->






<!--  //modal cetak data// -->


<form action="<?php $_SERVER[SCRIPT_NAME]; ?>?page=cetak_pembelian" method="POST" target="_blank">

  <!-- Modal Popup untuk delete -->
  <div class="modal fade small" id="my-cetak">


    <div class="modal-body center">
      <div class="modal-dialog">
        <div class="modal-content" style="margin-top:100px;">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

            <h4 class="modal-title" id="myModalLabel">Cetak data Pembelian obat masuk</h4>
          </div>
          <div class="modal-body center">

            <div class="row">
              <div class="col-md-6">
                <label>Tanggal pembelian Awal</label>
                <input type="date" class="form-control" data-date-format="dd-mm-yyyy" name="tglpembelianaw" autocomplete="off" value="" required>
              </div>

              <div class="col-md-6">
                <label>Tanggal pembelian Akhir</label>
                <input type="date" class="form-control" data-date-format="dd-mm-yyyy" name="tglpembelianah" autocomplete="off" value="" required>
              </div>
            </div>



            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal"> Close</button>
              <button type="submit" class="btn btn-info"><i class="fa fa-print"></i> Cetak</button>

            </div>

          </div>
        </div>
      </div>

    </div>
  </div>



</form>









<!-- Bootstrap Modal - To Add New Record -->
<!-- Modal -->

<form action="admin/obat_masuk/aksi_obat_masuk.php?sender=obat_masuk" method="POST">
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
          $kode_transaksi = "TM-$tahun-$buat_id";

          ?>


          <div class="form-group">
            <label>Kode beli</label>
            <input type="text" class="form-control" name="kode_transaksi" value="<?php echo $kode_transaksi; ?>" readonly required>
          </div>


          <?php
          $query_id = mysqli_query($config, "SELECT RIGHT(id_koreksi,3) as kode FROM tb_koreksi
              ORDER BY id_koreksi DESC LIMIT 1")
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
          $buat_id = str_pad($kode, 3, "0", STR_PAD_LEFT);
          $kode_koreksi = "K-$buat_id";

          ?>


          <div class="form-group">

            <input type="hidden" class="form-control" name="id_koreksi" value="<?php echo $kode_koreksi; ?>" readonly required>

          </div>


          <div class="form-group">
            <label>Nama Supplier</label> <br>
            <select class="form-control select2" id="pembelian" name="id_supplier" style="width: 100%;" required>
              <option value="">--- Silahkan Pilih ---</option>
              <optgroup label="--- Nama Produk ---">
                <?php
                $sql_pasien = mysqli_query($config, "SELECT * FROM supplier order by id_supplier") or die(mysqli_error($config));

                while ($data_pasien = mysqli_fetch_array($sql_pasien)) {
                  echo '<option value="' . $data_pasien['id_supplier'] . '">' . $data_pasien['id_supplier'] . '  ||    ' . $data_pasien['nama'] . ' </option>';
                }
                ?>
              </optgroup>
            </select>
          </div>
          <?php $tgl = date("Y-m-d "); ?>
          <div class="form-group">
            <label>Tanggal Expired</label>
            <input class="form-control" id="date" name="tgl_exp" min=" <?php date("Y-m-d ") ?>" placeholder="MM/DD/YYY" type="date" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label>Nama Obat</label> <br>
            <select class="form-control select2" id="pembelian" name="kd_obat" style="width: 100%;" onchange="tampil_obat(this)" autocomplete="off" required>
              <option value="">-Pilih obat-</option>
              <optgroup label="--- Nama Produk ---">
                <?php
                $sql_pasien = mysqli_query($config, "SELECT * FROM obat order by kd_obat ") or die(mysqli_error($config));

                while ($data_pasien = mysqli_fetch_array($sql_pasien)) {
                  echo '<option value="' . $data_pasien['kd_obat'] . '"> ' . $data_pasien['kd_obat'] . '  ||   ' . $data_pasien['nm_obat'] . ' ||   ' . $data_pasien['satuan'] . '  </option>';
                }
                ?>
              </optgroup>
            </select>
          </div>
          <span id='harga_beli'>
            <div class="form-group">
              <label>Harga Obat</label>
              <input type="text" class="form-control money" name="harga_pembelian" id="harga_beli" readonly required>
            </div>
          </span>

          <div class="form-group">
            <label>Edit Harga Obat</label><br>
            <input type="text" class="col-md-2 harga_beli" placeholder="Rp." readonly>
            <input type="text" min="1" name="edit_harga_pembelian" class="col-md-10 money" autocomplete="off">
            <small class="form-text text-danger">
              <p>Edit Harga hanya ketika harga obat berubah.</p>
            </small>
          </div>

          <div class="form-group">
            <label>Jumlah Pembelian</label>
            <input type="number" min="1" class="form-control" id="jumlah_beli" name="jumlah_beli" placeholder="Jumlah Pembelian" required data-fv-notempty-message="Tidak boleh kosong">
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
//ajax nampilin harga obat//
<script type="text/javascript">
  function tampil_obat(input) {
    var num = input.value;

    $.post("admin/obat_masuk/obat.php", {
      dataidobat: num,
    }, function(response) {
      $('#harga_beli').html(response)

      document.getElementById('jumlah_masuk').focus();
    });
  }

  function cek_jumlah_masuk(input) {
    jml = document.formObatMasuk.jumlah_masuk.value;
    var jumlah = eval(jml);
    if (jumlah < 1) {
      alert('Jumlah Masuk Tidak Boleh Nol !!');
      input.value = input.value.substring(0, input.value.length - 1);
    }
  }

  function hitung_total_stok() {
    bil1 = document.formObatMasuk.stok.value;
    bil2 = document.formObatMasuk.jumlah_masuk.value;

    if (bil2 == "") {
      var hasil = "";
    } else {
      var hasil = eval(bil1) + eval(bil2);
    }

    document.formObatMasuk.total_stok.value = (hasil);
  }
</script>







<!-- Content Wrapper. Contains page content -->




<?php include 'theme/footer.php'; ?>