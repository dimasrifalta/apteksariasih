<link href="../../dist/js/sweetalert.css" rel="stylesheet" type="text/css" >
<script src="../../dist/js/sweetalert.min.js"></script>
<script src="../../dist/js/sweetalert-dev.js"></script>


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
if ($g == 'anggota') {
	$cek = mysqli_num_rows(mysqli_query($config, "SELECT * FROM account WHERE email='$_POST[email]' or telepon='$_POST[telepon]' or username='$_POST[username]' OR nama='$_POST[nama]' "));

	if ($cek > 0) {
		echo "<script>window.alert('Telepon/ email/ nama/ username yang anda masukan sudah ada')
    window.location='../../index.php?page=anggota'</script>";
	} else {

		$password = md5($_POST['password']);
		$sql = "INSERT INTO account (id_karyawan, nama, telepon, email, username, password, level, status)
        VALUES
        (
        '$_POST[id_karyawan]',
        '$_POST[nama]',
        '$_POST[telepon]',
        '$_POST[email]',
        '$_POST[username]',
        '$password',

         '$_POST[level]',
         '$_POST[status]')";

		if (mysqli_query($config, $sql)) {
			echo "<script type='text/javascript'>
			                      setTimeout(function () {
			                        swal('Succes!', 'Data Karyawan Berhasil Di tambahkan', 'success')
			                      },10);
			                      window.setTimeout(function(){
			                        window.location.href='../../index.php?page=anggota';
			                      } ,1200);
			                    </script>";
		} else {
			echo "Error : " . $sql . ". " . mysqli_error($config);
		}
		//header('location:http://localhost/');
	}
} else
if ($g == 'edit') {
	$password = md5($_POST['password']);
	mysqli_query($config, "UPDATE account SET id_karyawan='$_POST[id_karyawan]',
            nama='$_POST[nama]',telepon='$_POST[telepon]',email='$_POST[email]', password='$password',
                level='$_POST[level]', status='$_POST[status]' WHERE id_karyawan='$_POST[id_karyawan]'");
	echo "<script type='text/javascript'>
                         setTimeout(function () {
                           swal('Succes!', 'Data Karyawan Berhasil Di perbarui', 'success')
                         },10);
                         window.setTimeout(function(){
                           window.location.href='../../index.php?page=anggota';
                         } ,1200);
                       </script>";
} else
if ($g == 'hapus') {
	mysqli_query($config, "DELETE FROM account where id_karyawan='$_GET[id_karyawan]'");
	echo "<script type='text/javascript'>
                      setTimeout(function () {
                        swal('Deleted !', 'Berhasil di Hapus', 'error')
                      },10);
                         window.setTimeout(function(){
                           window.location.href='../../index.php?page=anggota';
                         } ,1100);
                       </script>";
}
//End Aksi Anggota
?>
