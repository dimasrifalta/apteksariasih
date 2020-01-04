<link href="../../dist/js/sweetalert.css" rel="stylesheet" type="text/css" >
<script src="../../dist/js/sweetalert.min.js"></script>
<script src="../../dist/js/sweetalert-dev.js"></script>

<?php
session_start();
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

date_default_timezone_set("Asia/Jakarta");
$g = $_GET['sender'];
if ($g == 'transaksi') {

	$nopenjualan = $_POST['nopenjualan'];
	$tgl = date("Y-m-d ");

	//menambah data ketabel detail_pembelian

	$query = "INSERT INTO  detail_penjualan (nopenjualan, kasir,
  tgl_beli)
  VALUES ('$nopenjualan',
  '$_SESSION[username]',
  '$tgl' )";

	if (mysqli_query($config, $query)) {

	} else {
		echo "Error : " . $query . ". " . mysqli_error($config);
	}

	// fungsi untuk mendapatkan isi keranjang belanja
	function isi_keranjang() {
		include '../../koneksi.php';
		$isikeranjang = array();
		$sql = mysqli_query($config, "SELECT * FROM temp_penjualan");

		while ($r = mysqli_fetch_array($sql)) {
			$isikeranjang[] = $r;
		}
		return $isikeranjang;
	}

	// panggil fungsi isi_keranjang dan hitung jumlah produk yang dipesan
	$isikeranjang = isi_keranjang();
	$jml = count($isikeranjang);

	// simpan data detail pemesanan
	for ($i = 0; $i < $jml; $i++) {
		mysqli_query($config, "INSERT INTO penjualan(nopenjualan, tglpenjualan,kd_obat, kd_pembelian, itemterjual, harga_penjualan, total_penjualan, created_date,created_user)
     VALUES('$nopenjualan','{$isikeranjang[$i]['tglpenjualan']}', '{$isikeranjang[$i]['kd_obat']}','{$isikeranjang[$i]['kd_pembelian']}','{$isikeranjang[$i]['itemterjual']}', '{$isikeranjang[$i]['harga_penjualan']}', '{$isikeranjang[$i]['total_penjualan']}', '{$isikeranjang[$i]['created_date']}', '{$isikeranjang[$i]['created_user']}')");
	}

	// Update untuk mengurangi stok
	mysqli_query($config, "update obat p left join penjualan d on p.kd_obat=d.kd_obat set p.stok=stok-itemterjual where nopenjualan='$nopenjualan'");

	// Update untuk mengurangi stok
	mysqli_query($config, "update pembelian p left join penjualan d on p.kd_beli=d.kd_pembelian set p.stok_saat_ini=stok_saat_ini-itemterjual where nopenjualan='$nopenjualan'");

	// setelah data pemesanan tersimpan, hapus data pemesanan di tabel pemesanan sementara (orders_temp)
	mysqli_query($config, "DELETE FROM temp_penjualan");

	echo "<script type='text/javascript'>
  setTimeout(function () {
   swal('Succes!', 'Data Transaksi Berhasil Di tambahkan', 'success')
 },10);
 window.setTimeout(function(){

 } ,1100);

 </script>";

	header('location:../../index_employee.php?page=print&nopenjualan=' . $nopenjualan . '');

} else
if ($g == 'hapus') // Menhapus data yang ada di keranjang penjualan
{
	mysqli_query($config, "DELETE FROM temp_penjualan where id_temp='$_GET[kd_pembelian]'");
	echo "<script type='text/javascript'>
 setTimeout(function () {
  swal('Deleted !', 'Obat berhasil di hapus dari keranjang', 'error')
},10);
window.setTimeout(function(){
 window.location.href='../../index_employee.php?page=transaksi&act=cek';
} ,1100);
</script>";
} else
if ($g == 'order') {

	$ambilProduk = mysqli_fetch_array(mysqli_query($config, "select * from pembelian r
        join obat p on (r.kd_obat=p.kd_obat) where kd_beli='$_POST[kd_beli]'"));
	$kode_obat = $ambilProduk['kd_obat'];

	$cek = mysqli_num_rows(mysqli_query($config, "SELECT * FROM temp_penjualan where kd_pembelian='$_POST[kd_beli]'"));
	$cek = mysqli_num_rows(mysqli_query($config, "SELECT * FROM temp_penjualan where kd_obat='$kode_obat'"));

	if ($cek > 0) {
		//Mengecek apakah kode pembelian sudahh perna di beli
		echo "<script>window.alert('Anda tidak bisa menjual obat dengan Kode obat yang sama dalam satu kali pembelian')
      window.location='../../index_employee.php?page=transaksi&act=cek'</script>";
	} else {

		$tanggal = date("Y-m-d H:i:s");
		$tgl = date("Y-m-d ");

		$ambilProduk = mysqli_fetch_array(mysqli_query($config, "select * from pembelian r
        join obat p on (r.kd_obat=p.kd_obat) where kd_beli='$_POST[kd_beli]'"));

		$stokproduk = $ambilProduk['stok'] - $_POST['itemterjual'];

		$stokpembelian = $ambilProduk['stok_saat_ini'] - $_POST['itemterjual'];

		$total_penjualan = $_POST['itemterjual'] * $ambilProduk['harga_jual'];
		if ($_POST['itemterjual'] > $ambilProduk['stok_saat_ini']) {
			echo "<script>window.alert('Anda tidak bisa menjual karna stok kurang dari jumlah beli')
      window.location='../../index_employee.php?page=transaksi&act=cek'</script>";
		} else {

			//menambah data ke temp_penjualan
			$harga_penjulan = $ambilProduk['harga_jual'];
			$kode_obat = $ambilProduk['kd_obat'];
			$query = "INSERT INTO temp_penjualan (tglpenjualan, kd_obat,kd_pembelian,itemterjual, harga_penjualan, total_penjualan, created_date,  created_user) VALUES (
      '$tgl','$kode_obat','$_POST[kd_beli]',
      '$_POST[itemterjual]','$harga_penjulan','$total_penjualan','$tanggal','$_SESSION[username]')";

			if (mysqli_query($config, $query)) {

				echo "<script type='text/javascript'>
        setTimeout(function () {
         swal('Succes!', 'Obat Berhasil di tambahkan ke keranjang', 'success')
       },10);
       window.setTimeout(function(){
         window.location.href='../../index_employee.php?page=transaksi&act=cek';
       } ,1200);
       </script>";

			} else {
				echo "Error : " . $query . ". " . mysqli_error($config);
			}
		}
	}

}

//End Aksi Anggota
?>
