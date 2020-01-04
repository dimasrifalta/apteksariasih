<!-- Aplikasi Persediaan Obat pada Apotek
*******************************************************
* Developer    : Indra Styawantoro
* Company      : Indra Studio
* Release Date : 1 April 2017
* Website      : www.indrasatya.com
* E-mail       : indra.setyawantoro@gmail.com
* Phone        : +62-856-6991-9769
-->

<?php
session_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../../koneksi.php";

if(isset($_POST['dataidobat'])) {
	$kode_obat = $_POST['dataidobat'];

  // fungsi query untuk menampilkan data dari tabel obat
  $query = mysqli_query($config, "SELECT kd_obat,nm_obat,stok,harga_beli FROM obat WHERE kd_obat='$kode_obat'")
                                  or die('Ada kesalahan pada query tampil data obat: '.mysqli_error($config));

  // tampilkan data
  $data = mysqli_fetch_assoc($query);

  $harga   = $data['harga_beli'];


	if($harga != '') {
		echo " <span id='harga_beli'> 
        <div class='form-group'>
          <label>Harga Obat</label>
          <input type='text' class='form-control money' name='harga_pembelian' id='harga_beli' value='$harga' readonly required>
        </div>
      </span>";
	} else {
		echo "<div class='form-group'>
          <label>Harga Obat</label>
          <input type='text' class='form-control' name='harga_beli' id='harga_beli' readonly required>
           <span class=''>Harga obat tidak ditemukan</span>
        </div>";
	}		
}
?> 