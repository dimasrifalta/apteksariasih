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
  <ul class="treeview-menu" >
    <li><a href="<?php $_SERVER[SCRIPT_NAME];?>?page=penjualan&act=view"><i class="fa fa-circle-o"></i> Laporan Penjualan</a></li>
    <li class="active"><a href="<?php $_SERVER[SCRIPT_NAME];?>?page=laporan_transaksi"><i class="fa fa-circle-o"></i> Grafik Laporan Penjualan</a></li>
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








<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <i class="fa fa-bar-chart icon-title"></i> Grafik Transaksi Penjualan Obat


    </h1>

  </section>


  <!-- Main content -->
  <section class="content">





    <?php
//Include Koneksi
include "koneksi.php";

//Membuat Query
$k = mysqli_query($config, "select * from penjualan");
$q = mysqli_query($config, "select date_format(tglpenjualan,'%b') as bulan from penjualan");
?>

    <!-- File yang diperlukan dalam membuat chart -->
    <script src="js1/jquery.min.js"></script>
    <script src="js1/highcharts.js"></script>
    <script src="js1/exporting.js"></script>

    <script type="text/javascript">
      $(function () {
        $('#view').highcharts({
          title: {
            text: 'Data Penjualan obat ',
            x: -20 //center
          },
          subtitle: {
            text: '',
            x: -20
          },
          xAxis: {
            categories: [<?php while ($r = mysqli_fetch_array($q)) {echo "'" . $r["bulan"] . "',";}?>]
          },
          yAxis: {
            title: {
              text: 'Jumlah'
            },
            plotLines: [{
              value: 0,
              width: 1,
              color: '#808080'
            }]
          },
          tooltip: {
            valueSuffix: ''
          },
          legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
          },
          series: [{
            name: 'Jumlah Rp. ',
            data: [<?php while ($t = mysqli_fetch_array($k)) {echo $t["total_penjualan"] . ",";}?>]
          }]
        });
      });
    </script>

    <div id="view" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
  </div>
</section>




      <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
       <div class="control-sidebar-bg"></div>
     </div><!-- ./wrapper -->


     <script src="bootstrap/js/bootstrap.min.js"></script>
     <script src="bootstrap/js/Chart.bundle.js"></script>
     <!-- Morris.js charts -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
     <script src="plugins/morris/morris.min.js"></script>
     <!-- Sparkline -->
     <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
     <!-- jvectormap -->
     <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
     <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
     <!-- jQuery Knob Chart -->
     <script src="plugins/knob/jquery.knob.js"></script>
     <!-- daterangepicker -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
     <script src="plugins/daterangepicker/daterangepicker.js"></script>
     <!-- datepicker -->
     <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
     <!-- Bootstrap WYSIHTML5 -->
     <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
     <!-- Slimscroll -->
     <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
     <!-- FastClick -->
     <script src="plugins/fastclick/fastclick.min.js"></script>
     <!-- AdminLTE App -->
     <script src="dist/js/app.min.js"></script>

     <!-- SlimScroll -->
     <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
     <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
     <script src="assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
     <script src="assets/plugins/daterangepicker/daterangepicker.js"></script>


     <!-- DataTables -->
     <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
        $('#datepicker').datepicker({
          autoclose: true,
          format: 'yyyy-mm-dd'
        });
        $('#datepicker2').datepicker({
          autoclose: true,
          format: 'yyyy-mm-dd'
        });
        $('.datepicker3').datepicker({
          autoclose: true,
          format: 'yyyy-mm-dd'
        });
        $('.datepicker4').datepicker({
          autoclose: true,
          format: 'yyyy-mm-dd'
        });
        $(".timepicker").timepicker({
          showInputs: true
        });

      });

    </script>
    <script>
      var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
      };
    </script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <script src="plugins/ckeditor/ckeditor.js"></script>
    <script>
      $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
      });
    </script>

  </body>
  </html>


