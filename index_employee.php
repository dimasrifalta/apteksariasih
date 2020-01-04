<?php
session_start();
include 'koneksi.php';

$query= mysqli_query($config, "SELECT * FROM account WHERE id_karyawan='$_SESSION[idkuy]' " );
$row = mysqli_fetch_assoc($query);

if(@$_SESSION['level'] !=='Karyawan' &&  @$_SESSION['idkuy'] !=='$row[id_karyawan]'){
  header("Location: login.php");
}
else
{



/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if(@$_SESSION['level']='Karyawan') {
error_reporting(0);
include 'koneksi.php';
$get=$_GET['page'];
 
if($get=='dashboard')
{
   include ('employee/dashboard.php');	
}

elseif ($get=='obat_employee')
{
  include ('employee/obat/obat.php');
}
elseif ($get=='transaksi')
{	
  include ('employee/transaksi/transaksi.php');
 
  
}

elseif ($get=='tambah')
{	
  include ('employee/transaksi/tambah.php');
 
  
}

elseif ($get=='penjualan')
{	
  include ('employee/penjualan/penjualan.php');
 
  
}

elseif ($get=='cetak')
{	
  include ('employee/penjualan/cetak_pdf.php');
 
  
}

elseif ($get=='pass')
{
  include ('employee/ganti_pass/ganti_pass.php');
}

elseif ($get=='print')
{
  include ('employee/transaksi/print.php');
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