<link href="../../dist/js/sweetalert.css" rel="stylesheet" type="text/css" >
<script src="../../dist/js/sweetalert.min.js"></script>
<script src="../../dist/js/sweetalert-dev.js"></script>

<!-- <!load sweetalert yang di atas!> -->


<?php
session_start();
if (empty($_SESSION['username'])) {
	echo "<script>window.location='../../login.php';</script>";
}
?>
<?php
include '../../koneksi.php';
/*
 * Heri Priady
 * Sample Crud MYSQLi
 * 10/07/2017 23:03
 * priadyheri@gmail.com
 * 082386376942
 * https://www.facebook.com/ciwerartikel
 * Alamat :Desa Kumain, Kec.Tandun, Kab.Rokan Hulu
 * and open the template in the editor.
 */
//Start Aksi Anggota
$g = $_GET['sender'];
if ($g == 'supplier') {

	$cek = mysqli_num_rows(mysqli_query($config, "SELECT * FROM supplier WHERE  telepon='$_POST[telepon]'  OR nama='$_POST[nama]' "));

	if ($cek > 0) {
		// cek data supllier sudah ada atau tidak
		echo "<script type='text/javascript'>
                      setTimeout(function () {
                        swal('Warning !', 'Data Supplier Sudah ada', 'error')
                      },10);
                         window.setTimeout(function(){
                           window.location.href='../../index.php?page=supplier';
                         } ,1100);
                       </script>";
	} else {
		$sql = "INSERT INTO supplier
    VALUES
    ('$_POST[id_supplier]',
    '$_POST[nama]',
    '$_POST[alamat]',
    '$_POST[telepon]')";

		if (mysqli_query($config, $sql)) {
			echo "<script type='text/javascript'>
                         setTimeout(function () {
                           swal('Succes!', 'Data Supplier Berhasil Di tambahkan', 'success')
                         },10);
                         window.setTimeout(function(){
                           window.location.href='../../index.php?page=supplier';
                         } ,2000);
                       </script>";
		} else {
			echo "Error : " . $sql . ". " . mysqli_error($config);
		}
		//header('location:http://localhost/');
	}
} else
if ($g == 'edit') {
	mysqli_query($config, "UPDATE supplier SET id_supplier='$_POST[id_supplier]',
            id_supplier='$_POST[id_supplier]',
            nama='$_POST[nama]', alamat='$_POST[alamat]', telepon='$_POST[telepon]' WHERE id_supplier='$_POST[id_supplier]'");
	echo "<script type='text/javascript'>
                         setTimeout(function () {
                           swal('Succes!', 'Data Supplier Berhasil Di perbarui', 'success')
                         },10);
                         window.setTimeout(function(){
                           window.location.href='../../index.php?page=supplier';
                         } ,2000);
                       </script>";
} else
if ($g == 'hapus') {
	mysqli_query($config, "DELETE FROM supplier where id_supplier='$_GET[id_supplier]'");
	echo "<script type='text/javascript'>
                      setTimeout(function () {
                        swal('Deleted !', 'Data Suplier Berhasil di Hapus', 'error')
                      },10);
                         window.setTimeout(function(){
                           window.location.href='../../index.php?page=supplier';
                         } ,1500);
                       </script>";
}
//End Aksi Anggota
?>
