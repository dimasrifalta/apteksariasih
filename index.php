<?php
session_start();
include 'koneksi.php';

$query= mysqli_query($config, "SELECT * FROM account WHERE id_karyawan='$_SESSION[idkuy]' " );
$row = mysqli_fetch_assoc($query);

if(@$_SESSION['level'] !=='Admin' &&  @$_SESSION['idkuy'] !=='$row[id_karyawan]'){
  header("Location: login.php");
}
else
{





/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 
 
 */
if(@$_SESSION['level']='Admin') {
error_reporting(0);

$get=$_GET['page'];
 
if ($get=='dashboard')
{
   include ('admin/karyawan/dashboard.php');	
}

elseif ($get=='anggota')
{
  include ('admin/karyawan/anggota.php');
}

elseif ($get=='obat')
{
  include ('admin/obat/obat.php');
}

elseif ($get=='supplier')
{
  include ('admin/supplier/supplier.php');
}

elseif ($get=='stok_obat')
{
  include ('admin/stok_obat/stokobat.php');
}

elseif ($get=='obat_masuk')
{
  include ('admin/obat_masuk/obat_masuk.php');
}

elseif ($get=='daftar_expired')
{
  include ('admin/daftar_expired/daftar_expired.php');
}

elseif ($get=='koreksi')
{
  include ('admin/daftar_expired/koreksi.php');
}

elseif ($get=='barang')
{
  include ('admin/laporan/laporan_barang.php');
}

elseif ($get=='laporan_transaksi')
{
  include ('admin/laporan/laporan_transaksi.php');
}

elseif ($get=='penjualan')
{
  include ('admin/laporan/penjualan.php');
}

elseif ($get=='cetak')
{
  include ('admin/laporan/cetak_pdf.php');
}

elseif ($get=='cetak_pembelian')
{
  include ('admin/obat_masuk/cetak.php');
}



elseif ($get=='pass')
{
  include ('admin/ganti_pass/ganti_pass.php');
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