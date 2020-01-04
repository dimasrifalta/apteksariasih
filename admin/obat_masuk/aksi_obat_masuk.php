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
$g = $_GET['sender'];
if ($g == 'obat_masuk') {
	$tanggal = date("Y-m-d H:i:s"); //buat tanggal otomatis
	$tanggal_pembelian = date("Y-m-d");

	$ambilProduk = mysqli_fetch_array(mysqli_query($config, "select * from obat where kd_obat = '$_POST[kd_obat]'")); //ambil produk dari databases

	$total_pembelian = $_POST['jumlah_beli'] * $ambilProduk['harga_beli']; //menjumlakan total pembelian
	$sisaStok = $ambilProduk['stok'] + $_POST['jumlah_beli']; //menambah stok
	 $edit_harga_pembelian = str_replace('.', '', mysqli_real_escape_string($config, trim($_POST['edit_harga_pembelian'])));//mengubah format uang

	if ($_POST['tgl_exp'] < $tanggal_pembelian) {
		//jika stok kurang dari jumlah beli
		echo '<script LANGUAGE="JavaScript">
		alert("Harap masukan tanggal Expired yang benar ")
		window.location.href="../../index.php?page=obat_masuk";
		</script>';

	} else {
		//menambah pembelian
		if (empty($_POST['edit_harga_pembelian'])) {
			$harga_pembelian = $ambilProduk['harga_beli'];

			$query = "INSERT INTO pembelian (kd_beli, tglpembelian, kd_obat, id_supplier, kode_koreksi, jumlah_beli, harga_pembelian, stok_saat_ini, totalpembelian, tgl_exp, created_date, created_user ) VALUES ('$_POST[kode_transaksi]',
			'$tanggal_pembelian','$_POST[kd_obat]','$_POST[id_supplier]','$_POST[id_koreksi]',
			'$_POST[jumlah_beli]','$harga_pembelian','$_POST[jumlah_beli]','$total_pembelian','$_POST[tgl_exp]','$tanggal','$_SESSION[username]')";
		} else{
			$query = "INSERT INTO pembelian (kd_beli, tglpembelian, kd_obat, id_supplier, kode_koreksi, jumlah_beli, harga_pembelian, stok_saat_ini, totalpembelian, tgl_exp, created_date, created_user ) VALUES ('$_POST[kode_transaksi]',
			'$tanggal_pembelian','$_POST[kd_obat]','$_POST[id_supplier]','$_POST[id_koreksi]',
			'$_POST[jumlah_beli]','$edit_harga_pembelian','$_POST[jumlah_beli]','$total_pembelian','$_POST[tgl_exp]','$tanggal','$_SESSION[username]')";

			mysqli_query($config, "update obat set harga_beli = '$edit_harga_pembelian'
							       where kd_obat = '$_POST[kd_obat]'"); //mengupdate Harga Obat

		}

		

		mysqli_query($config, "update obat set stok = '$sisaStok'
       where kd_obat = '$_POST[kd_obat]'"); //mengupdate stok

		

		mysqli_query($config, "INSERT INTO tb_koreksi (id_koreksi, kode_beli)
			VALUES ('$_POST[id_koreksi]',
            '$_POST[kode_transaksi]') "); //tambah ke tabel koreksi

		if (mysqli_query($config, $query)) {

			echo "<script type='text/javascript'>
			setTimeout(function () {
				swal('Succes!', 'Data obat Berhasil Di Ditambahkan', 'success')
				},10);
				window.setTimeout(function(){
					window.location.href='../../index.php?page=obat_masuk';
					} ,1100);
					</script>";
				} else {
					echo "Error : " . $query . ". " . mysqli_error($config);
				}
		//header('location:http://localhost/');
			}
		} else
		if ($g == 'edit') {

			$tanggal = date("Y-m-d ");

			$ambilProduk = mysqli_fetch_array(mysqli_query($config, "select * from pembelian r
				join obat p on (r.kd_obat=p.kd_obat) where kd_beli='$_POST[kd_beli]'"));

			if ($ambilProduk['stok_saat_ini'] < $_POST['koreksi_stok']) {
		//apabila stok saat ini lebih kecil dari koreksi stok

				$satu = $_POST['koreksi_stok'] - $ambilProduk['stok_saat_ini'];

				$stokproduk = $ambilProduk['stok'] + $satu;

				mysqli_query($config, "update obat set stok = '$stokproduk'
					where kd_obat = '$ambilProduk[kd_obat]'");

				$status = "KOREKSI STOK";

				mysqli_query($config, "INSERT INTO tb_keterangan (kode_koreksi,jumlah_update, status, keterangan, log_tanggal)
					VALUES ('$_POST[id_koreksi]',
					'$satu',
					'$status',

					'$_POST[keterangan]',
					'$tanggal') ");

			} elseif ($ambilProduk['stok_saat_ini'] > $_POST['koreksi_stok']) {
		//apabila stok saat ini lebih besar dari koreksi stok
				$satu = $ambilProduk['stok_saat_ini'] - $_POST['koreksi_stok'];

				$stokproduk = $ambilProduk['stok'] - $satu;

				mysqli_query($config, "update obat set stok = '$stokproduk'
					where kd_obat = '$ambilProduk[kd_obat]'");

				$status = "KOREKSI STOK";

				mysqli_query($config, "INSERT INTO tb_keterangan (kode_koreksi,jumlah_update, status, keterangan, log_tanggal)
					VALUES ('$_POST[id_koreksi]',
					'$satu',
					'$status',

					'$_POST[keterangan]',
					'$tanggal') ");

			}

	// $stokproduk = $ambilProduk['stok'] + $_POST['koreksi_stok'];

	// mysqli_query($config, "update obat set stok = '$stokproduk'
	// where kd_obat = '$ambilProduk[kd_obat]'");

	// $a = mysqli_fetch_array(mysqli_query($config,"select * from tb_koreksi
	//      WHERE kode_beli='$_POST[kd_beli]'"));

	// $result = $a['keterangan'] . $_POST['keterangan'];

			mysqli_query($config, "UPDATE tb_koreksi SET  koreksi_stok='$_POST[koreksi_stok]'
				WHERE kode_beli='$_POST[kd_beli]'");

			mysqli_query($config, "UPDATE pembelian SET  stok_saat_ini='$_POST[koreksi_stok]' WHERE kd_beli='$_POST[kd_beli]'");

			echo "<script type='text/javascript'>
			setTimeout(function () {
				swal('Succes!', 'Data obat Berhasil Di perbarui', 'success')
				},10);
				window.setTimeout(function(){
					window.location.href='../../index.php?page=koreksi';
					} ,1200);
					</script>";
				} else

				if ($g == 'hapus') {

					$tanggal = date("Y-m-d ");
					$ambilProduk = mysqli_fetch_array(mysqli_query($config, "select * from pembelian r
						join obat p on (r.kd_obat=p.kd_obat) where kd_beli='$_POST[kd_beli]'"));

					$stokproduk = $ambilProduk['stok'] - $_POST['jumlah_retur'];

					mysqli_query($config, "update obat set stok = '$stokproduk'
						where kd_obat = '$ambilProduk[kd_obat]'");

					$stokpembelian = $ambilProduk['stok_saat_ini'] - $_POST['jumlah_retur'];

					mysqli_query($config, "update pembelian set stok_saat_ini = '$stokpembelian'
						where kd_beli = '$ambilProduk[kd_beli]'");

					$status = "RETUR";

					mysqli_query($config, "INSERT INTO tb_keterangan (kode_koreksi,jumlah_update, status, keterangan, log_tanggal)
						VALUES ('$_POST[id_koreksi]',
						'$_POST[jumlah_retur]',
						'$status',

						'$_POST[keterangan]',
						'$tanggal') ");

					echo "<script type='text/javascript'>
					setTimeout(function () {
						swal('Succes!', 'Data obat Berhasil Di Retur', 'success')
						},10);
						window.setTimeout(function(){
							window.location.href='../../index.php?page=koreksi';
							} ,1100);
							</script>";
						} else

						if ($g == 'expired') {
							$expired = "expired";
							$tanggal = date("Y-m-d ");
							$ambilProduk = mysqli_fetch_array(mysqli_query($config, "select * from pembelian r
								join obat p on (r.kd_obat=p.kd_obat) where kd_beli='$_GET[kd_beli]'"));

							$stokproduk = $ambilProduk['stok'] - $ambilProduk['stok_saat_ini'];

							mysqli_query($config, "update obat set stok = '$stokproduk'
								where kd_obat = '$ambilProduk[kd_obat]'");

							$stokpembelian = $ambilProduk['stok_saat_ini'] - $ambilProduk['stok_saat_ini'];

							mysqli_query($config, "update pembelian set stok_saat_ini = '$stokpembelian', status='$expired'
								where kd_beli = '$ambilProduk[kd_beli]'");

							$id_koreksi = $ambilProduk['kode_koreksi'];
							$jumalah_expired = $ambilProduk['stok_saat_ini'];
							$status = "EXPIRED";
							$keterangan = "obat sudah kadaluarsa";

							mysqli_query($config, "INSERT INTO tb_keterangan (kode_koreksi,jumlah_update, status, keterangan, log_tanggal)
								VALUES ('$id_koreksi',
								'$jumalah_expired',
								'$status',

								'$keterangan',
								'$tanggal') ");

							echo "<script type='text/javascript'>
							setTimeout(function () {
								swal('Succes!', 'Data obat Berhasil Di di Nonaktifkan', 'success')
								},10);
								window.setTimeout(function(){
									window.location.href='../../index.php?page=koreksi';
									} ,1100);
									</script>";
								}

//End Aksi Anggota
								?>
