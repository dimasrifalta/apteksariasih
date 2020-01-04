<?php include "koneksi.php";

include "koneksi.php";
// panggil fungsi untuk format tanggal
include "config/fungsi_tanggal.php";
// panggil fungsi untuk format rupiah


// panggil fungsi untuk format rupiah
include "config/fungsi_rupiah.php";

error_reporting(0);



?>
<style type='text/css'>

.style1 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 16px;
}
.style4 {font-family: Arial, Helvetica, sans-serif; font-weight: bold; font-size: 13px; }
.style5 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.style12 {font-family: Arial, Helvetica, sans-serif; font-size: 13; }
.style14 {font-family: Arial, Helvetica, sans-serif; font-size: 11; }
.style15 {font-family: Arial, Helvetica, sans-serif; font-weight: bold; font-size: 9; }

.style41 {font-family: Arial, Helvetica, sans-serif;  font-size: 9px; }
.style411 {font-family: Arial, Helvetica, sans-serif;  font-size: 8px; }
.style141 {font-family: Arial, Helvetica, sans-serif; font-size: 12; }
a:link, a:visited {
	background-color: #0c99b9;
	color: white;
	padding: 5px 15px;
	text-align: center;
	text-decoration: none;
	display: inline-block;
	border-radius: 3px;
}


a:hover, a:active {
	background-color: #126d82;
}

@media print {
	@page { margin: 0px auto; }
	body { margin-top: 1cm;  }
	.hilang { display:none;}
	.tablep {
		font-size:10px;
		font-family:arial;
	}
	style1 {
		font-family: Arial, Helvetica, sans-serif;
		font-weight: bold;
		font-size: 13px;
	}
	.style4 {font-family: Arial, Helvetica, sans-serif; font-weight: bold; font-size: 11px; }
	.style5 {
		font-family: Arial, Helvetica, sans-serif;
		font-size: 9px;
	}
	.style12 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; }
	.style14 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; }
	.style15 {font-family: Arial, Helvetica, sans-serif; font-weight: bold; font-size: 8px; }

	.style41 {font-family: Arial, Helvetica, sans-serif;  font-size: 10px; }
	.style411 {font-family: Arial, Helvetica, sans-serif;  font-size: 8px; }
	.style141 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; }


	a:link, a:visited {

		display: none;
	}


	a:hover, a:active {
		display: none;
	}


}

</style>


<table width="770" border="0">
	<tr>
		<td width="474"><span class="style1">FAKTUR KOMERSIL</span><br />
			<span class="style4">APOTEK SARIASIH</span><br />
			<span class="style5">Jl. Sari Asih No.151 sarijadi<br />
				Sukasari - Kota Bandung<br />
				Telepon : +62 21 89652<br />
				Fax   : +62 21 877562<br />
			Hot Line Service : +645693230 </span></td>

		</tr>
		<tr>
			<td colspan="2">
				<hr size="1" noshade="noshade" />
			</td></tr>
		</table>

		<?php
		$t= mysqli_fetch_array(mysqli_query($config,"select * from penjualan r
			join obat p on (r.kd_obat=p.kd_obat) where nopenjualan='$_GET[nopenjualan]'"));

		$tgl1     = $t['tglpenjualan'];
		$explode  = explode('-',$tgl1);
		$tgl_awal = $explode[2]."-".$explode[1]."-".$explode[0];

		$liatHarga=mysqli_query($config, "SELECT sum(total_penjualan) as total_penjualan FROM penjualan r  
                            join obat p on (r.kd_obat=p.kd_obat)
                            where nopenjualan ='$_GET[nopenjualan]'
                            ORDER BY nopenjualan ASC");

		?>
		<input type="hidden" name="id_transaksi" value="<?php echo $t['nopenjualan'] ;?>">
		<table width="770" border="0">
			<tr>

				<td width="64" valign="top" class="style5"><span class="style12">Faktur</span></td>
				<td width="161" valign="top" class="style5"><span class="style12">: <?php echo"$t[nopenjualan]"; ?></span></td>
				<td class="style12">&nbsp;</td>
				<td width="148" valign="top" class="style5"><span class="style12">Kasir</span></td>
				<td width="160" valign="top" class="style5"><span class="style12">: <?php echo"$t[created_user]"; ?> </span></td>

			</tr>
			<tr>
				<td class="style5"><span class="style12">Tanggal</span></td>
				<td class="style5"><span class="style12">: <?php echo tgl_eng_to_ind($tgl1); ?>  </span></td>
				<td class="style12">&nbsp;</td>
				<td class="style5"><span class="style12">jam</span></td>
				<td class="style5"><span class="style12">: <?php echo"$t[created_date]"; ?> </span></td>
			</tr>

		</table>

		<table width="770" border="0" cellpadding="1" cellspacing="0" class="tablep">
			<tr>
				<td colspan="7">
					<hr align="center" size="1"  noshade="noshade"  /></td>
				</tr>
				<tr bordercolor="#000000">
					<td width="30" class="style4"><span class="style14">No</span></td>

					<td width="242" class="style4"><span class="style14">Nama Produk</span></td>

					<td width="100" class="style4"><span class="style14">Harga</span></td>
					<td width="100" class="style4"><span class="style14">Satuan</span></td>
					<td width="73" class="style4"><span class="style14">Jml Beli</span></td>

					<td width="119" class="style4"><span class="style14">Tanggal Beli</span></td>
					<td width="121" class="style4"><span class="style14">Total</span></td>
				</tr>
				<tr>
					<td colspan="7">
						<hr align="center" size="1"  noshade="noshade"  /></td>
					</tr>
					<?php
					$no = 1;
					$tampil= mysqli_query($config,"select * from penjualan r
						join obat p on (r.kd_obat=p.kd_obat) where nopenjualan='$_GET[nopenjualan]'");

					while($data=mysqli_fetch_array($tampil)){

						$jual = format_rupiah($data['harga_penjualan']);
						$total = format_rupiah($data['total_penjualan']);



						echo " <tr>
						<td>$no</td>							
						<td>$data[nm_obat]-$data[kd_obat]</td>
						<td>$jual</td>
						<td>$data[satuan]</td>		                    
						<td>$data[itemterjual]</td>
						<td>$data[tglpenjualan]</td>


						<td>Rp. $total</td>
						</tr>";

						$no++; }

						while ($data = mysqli_fetch_assoc($liatHarga)) {
							$total_penjualan = format_rupiah($data['total_penjualan']);


							echo " <tr>
								<td colspan='7'>
								<hr>
								</td>
								</tr><tr>
								<td colspan='6'>
								<b>Total</b>
								</td>
								<td>
								<b>Rp. $total_penjualan</b>
								</td>
								</tr>";

						}

						?>

						
					</table>
					<br>
					<button onclick="cetak()" class="hilang" style="
					background: green;
					padding: 6px 15px;
					border: aqua;
					color: white;
					border-radius: 2px;
					margin-right: 15;
					">Print/Cetak</button>
					<a href="<?php $_SERVER[SCRIPT_NAME] ;?>?page=transaksi&act=view" class="hilang">Kembali</a>

					<script>

						function cetak(){

							window.print();

						}

					</script>
					<br>
