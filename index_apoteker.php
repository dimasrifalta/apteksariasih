<?php
session_start();
include 'koneksi.php';


$query= mysqli_query($config, "SELECT * FROM account WHERE id_karyawan='$_SESSION[idkuy]' " );
$row = mysqli_fetch_assoc($query);

if(@$_SESSION['level'] !=='Apoteker' &&  @$_SESSION['idkuy'] !=='$row[id_karyawan]'){
  header("Location: login.php");
}
else
{





/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
error_reporting(0);
include 'koneksi.php';
$get=$_GET['page'];
if(@$_SESSION['level']='Apoteker') {	 
if ($get=='dashboard')
{
	
   include ('apoteker/dashboard.php');	
}


elseif ($get=='obat1')
{
  include ('apoteker/obat.php');


}

elseif ($get=='pass')
{
  include ('apoteker/ganti_pass/ganti_pass.php');
}

elseif ($get=='penjualan')
{
  include ('apoteker/laporan/penjualan.php');
}

elseif ($get=='cetak')
{
  include ('apoteker/laporan/cetak_pdf.php');
}

elseif ($get=='logout')
{
  include ('logout.php');
}
else {
	echo "<script>alert('Jangan nakal');</script>";
	  header("Location: login.php");	
}
}
}
?>