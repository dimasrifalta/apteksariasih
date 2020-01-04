<?php

ob_start();

// Panggil koneksi database.php untuk koneksi database
include "koneksi.php";
// panggil fungsi untuk format tanggal
include "config/fungsi_tanggal.php";
// panggil fungsi untuk format rupiah

// panggil fungsi untuk format rupiah
include "config/fungsi_rupiah.php";

$hari_ini = date("d-m-Y");

$tgl1 = $_POST['tglpenjualanaw'];
$explode = explode('-', $tgl1);
$tgl_awal = $explode[2] . "-" . $explode[1] . "-" . $explode[0];

$tgl2 = $_POST['tglpenjualanak'];
$explode = explode('-', $tgl2);
$tgl_akhir = $explode[2] . "-" . $explode[1] . "-" . $explode[0];

$user = $_SESSION['username'];

if (isset($_POST['tglpenjualanaw'])) {
	$no = 1;
	// fungsi query untuk menampilkan data dari tabel obat masuk

	$liatHarga = mysqli_query($config, "SELECT sum(total_penjualan) as total_penjualan,
                            sum(harga_penjualan) as harga, sum(itemterjual) as itemterjual FROM penjualan r
                            join obat p on (r.kd_obat=p.kd_obat)
                            where
                            tglpenjualan BETWEEN '$_POST[tglpenjualanaw]'
                            AND  '$_POST[tglpenjualanak]' ORDER BY nopenjualan ASC");

	$query = mysqli_query($config, "SELECT * FROM penjualan r
                            JOIN obat p ON ( r.kd_obat = p.kd_obat) where
                                           tglpenjualan BETWEEN  '$_POST[tglpenjualanaw]' AND  '$_POST[tglpenjualanak]'
                            ORDER BY nopenjualan ASC");
	$count = mysqli_num_rows($query);
}
?>

<page>
<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>LAPORAN PENJUALAN OBAT</title>
        <link rel="stylesheet" type="text/css" href="css/laporan_penjualan.css" />
    </head>
    <body>

        <div id="title">
            APOTIK SARIASIH
        </div>
        <div id="title">
            LAPORAN PENJUALAN OBAT
        </div>
    <?php
if ($tgl_awal == $tgl_akhir) {?>
        <div id="title-tanggal">
            Tanggal <?php echo tgl_eng_to_ind($tgl1); ?>
        </div>
    <?php
} else {?>
        <div id="title-tanggal">
            Tanggal <?php echo tgl_eng_to_ind($tgl1); ?> s.d. <?php echo tgl_eng_to_ind($tgl2); ?>
        </div>
    <?php
}
?>

    <hr>

    <br>

    <div id="isi">
      <table width="100%" border="0.3" cellpadding="0" cellspacing="0">
        <thead style="background:#e8ecee">
          <tr class="tr-title">
            <th height="20" align="center" valign="middle">NO.</th>
            <th height="20" align="center" valign="middle">No Penjualan</th>
            <th height="20" align="center" valign="middle">Tanggal Penjualan</th>
            <th height="20" align="center" valign="middle">Nama Produk</th>
            <th height="20" align="center" valign="middle">Harga Jual</th>
             <th height="20" align="center" valign="middle">Jml Item Terjual</th>
            <th height="20" align="center" valign="middle">Total Penjualan</th>


          </tr>
        </thead>
        <tbody>

        <?php
// jika data ada
if ($count == 0) {
	echo "  <tr>
                    <td width='40' height='13' align='center' valign='middle'></td>
                    <td width='120' height='13' align='center' valign='middle'></td>
                    <td width='80' height='13' align='center' valign='middle'></td>
                    <td width='80' height='13' align='center' valign='middle'></td>
                    <td style='padding-left:5px;' width='155' height='13' valign='middle'></td>
                    <td style='padding-right:10px;' width='100' height='13' align='right' valign='middle'></td>
                    <td width='80' height='13' align='center' valign='middle'></td>
                </tr>";
}
// jika data tidak ada
else {
	// tampilkan data
	while ($data = mysqli_fetch_assoc($query)) {
		$tanggal = $data['tglpenjualan'];
		$item = format_rupiah($data['itemterjual']);
		$jual = format_rupiah($data['harga_penjualan']);
		$total = format_rupiah($data['total_penjualan']);

		// menampilkan isi tabel dari database ke tabel di aplikasi
		echo "  <tr>
                    <td width='40' height='13' align='center' valign='middle'>$no</td>
                    <td width='120' height='13' align='center' valign='middle'>$data[nopenjualan]</td>
                    <td width='80' height='13' align='center' valign='middle'>$tanggal</td>
                    <td width='80' height='13' align='left' valign='middle'>$data[nm_obat]</td>
                    <td width='80' height='13' align='center' valign='middle'>Rp. $jual</td>
                    <td width='80' height='13' align='center' valign='middle'>$item</td>
                    <td width='80' height='13' align='center' valign='middle'>Rp. $total</td>


                    </tr>";
		$no++;
	}
	while ($data = mysqli_fetch_assoc($liatHarga)) {
		$total_penjualan = format_rupiah($data['total_penjualan']);

		echo " <tr>
                <td align = 'center' colspan='5'> Total : </td>

                        <td align='center>Item : $data[itemterjual]</td>
                        <td>Rp. $total_penjualan</td>




                </tr>";

	}
}

?>
        </tbody>
    </table>

    <div id="footer-tanggal">
        Bandung, <?php echo tgl_eng_to_ind("$hari_ini"); ?>
    </div>
    <div id="footer-jabatan">
        Pimpinan
    </div>

    <div id="footer-nama">
        Dimas rifalta Phd
    </div>
</div>
</body>
</html><!-- Akhir halaman HTML yang akan di konvert -->
</page>
<?php
$filename = "LAPORAN PENJUALAN OBAT.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
//==========================================================================================================
$content = ob_get_clean();
$content = '<page style="font-family: freeserif">' . ($content) . '</page>';
// panggil library html2pdf
require_once 'plugins/html2pdf_v4.03/html2pdf.class.php';
try
{
	$html2pdf = new HTML2PDF('P', 'F4', 'en', false, 'ISO-8859-15', array(10, 10, 10, 10));
	$html2pdf->pdf->SetDisplayMode('fullpage');

	$html2pdf->setDefaultFont('Arial');
	$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
	$html2pdf->Output($filename);

	header("Content-type:application/pdf");

} catch (HTML2PDF_exception $e) {echo $e;}

?>