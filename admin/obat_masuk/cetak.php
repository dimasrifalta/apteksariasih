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


$tgl1     = $_POST['tglpembelianaw'];
$explode  = explode('-',$tgl1);
$tgl_awal = $explode[2]."-".$explode[1]."-".$explode[0];

$tgl2      = $_POST['tglpembelianah'];
$explode   = explode('-',$tgl2);
$tgl_akhir = $explode[2]."-".$explode[1]."-".$explode[0];

if (isset($_POST['tglpembelianaw'])) {
    $no    = 1;
    // fungsi query untuk menampilkan data dari tabel obat masuk

    $liatHarga=mysqli_query($config, "SELECT sum(totalpembelian) as totalpembelian, 
                            sum(harga_pembelian) as harga_pembelian, sum(jumlah_beli) as jumlah_beli FROM pembelian
                               INNER JOIN obat ON pembelian.kd_obat = obat.kd_obat
                               INNER JOIN supplier ON pembelian.id_supplier = supplier.id_supplier
                            where 
                            tglpembelian BETWEEN '$_POST[tglpembelianaw]' 
                            AND  '$_POST[tglpembelianah]' ORDER BY kd_beli ASC");



    $query=mysqli_query($config, "SELECT * FROM pembelian
           INNER JOIN obat ON pembelian.kd_obat = obat.kd_obat
           INNER JOIN supplier ON pembelian.id_supplier = supplier.id_supplier where
                            tglpembelian BETWEEN  '$_POST[tglpembelianaw]' AND  '$_POST[tglpembelianah]'
                            ORDER BY kd_beli ASC");
    $count  = mysqli_num_rows($query);
}
?>

<page>
<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>LAPORAN DATA OBAT MASUK</title>
        <link rel="stylesheet" type="text/css" href="css/laporan.css" />
    </head>
    <body>

        <div id="title">
            APOTIK SARIASIH
        </div>
        <div id="title">
            LAPORAN DATA OBAT MASUK
        </div>
    <?php  
    if ($tgl_awal==$tgl_akhir) { ?>
        <div id="title-tanggal">
            Tanggal <?php echo tgl_eng_to_ind($tgl1); ?>
        </div>
    <?php
    } else { ?>
        <div id="title-tanggal">
            Tanggal <?php echo tgl_eng_to_ind($tgl1); ?> s.d. <?php echo tgl_eng_to_ind($tgl2); ?>
        </div>
    <?php
    }
    ?>

    <hr>

    <br>

    <div id="isi">
      <table class="center" id="table" width="100%" border="0.3" cellpadding="0" cellspacing="0">
        <thead style="background:#e8ecee">
          <tr class="tr-title">
            <th height="20" align="center" valign="middle">NO.</th>
            <th height="20" align="center" valign="middle">Kode Beli</th>
            <th height="20" align="center" valign="middle">Tanggal Pembelian</th>
            <th height="20" align="center" valign="middle">Nama Obat</th>
            <th height="20" align="center" valign="middle">Supplier</th>
            <th height="20" align="center" valign="middle">Tanggal Expired</th>
            <th height="20" align="center" valign="middle">Harga Beli</th>
            <th height="20" align="center" valign="middle">Jumlah Beli</th>

            <th height="20" align="center" valign="middle">Total Pembelian</th>

          </tr>
        </thead>
        <tbody>

        <?php
    // jika data ada
    if($count == 0) {
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
                    $tanggal       = $data['tglpembelian'];
                     $beli = format_rupiah($data['harga_pembelian']);
                      
                       $total = format_rupiah($data['totalpembelian']);
           

           // menampilkan isi tabel dari database ke tabel di aplikasi
                    echo "  <tr>
                    <td width='40' height='13' align='left' valign='middle'>$no</td>
                    <td width='120' height='13' align='left' valign='middle'>$data[kd_beli]</td>
                    <td width='120' height='13' align='left' valign='middle'>$tanggal</td>
                    <td width='80' height='13' align='left' valign='middle'>$data[nm_obat]</td>
                    <td width='50' height='13' align='left' valign='middle'>$data[nama]</td>
                    <td width='120' height='13' align='left' valign='middle'>$data[tgl_exp]</td>                   
                    <td width='80' height='13' align='left' valign='middle'>Rp. $beli</td>
                    <td width='80' height='13' align='left' valign='middle'>$data[jumlah_beli]<</td>

                    <td width='80' height='13' align='left' valign='middle'>Rp. $total</td>

                    </tr>";
                    $no++;
                }
          while ($data = mysqli_fetch_assoc($liatHarga)) {
            $harga_pembelian = format_rupiah($data['harga_pembelian']);
            $total_penjualan = format_rupiah($data['totalpembelian']);

                echo " <tr>
                <td align = 'center' colspan='6'> Total : </td>
                        <td>Rp. $harga_pembelian</td>
      
                        <td align='center>Item : $data[jumlah_beli]</td>
                         
                        
                        <td>Rp. $total_penjualan</td>


                </tr>"  ;

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
        Dimas rifalta Ph.d
    </div>
</div>
</body>
</html><!-- Akhir halaman HTML yang akan di konvert -->
</page>
<?php
$filename="LAPORAN DATA OBAT MASUK.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
//==========================================================================================================
$content = ob_get_clean();
$content = '<page style="font-family: freeserif">'.($content).'</page>';
// panggil library html2pdf
require_once('plugins/html2pdf_v4.03/html2pdf.class.php');
try
{
    $html2pdf = new HTML2PDF('L','F4','en', false, 'ISO-8859-15',array(10, 10, 10, 10));
    $html2pdf->pdf->SetDisplayMode('fullpage');
    
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output($filename);

    header("Content-type:application/pdf");

}

catch(HTML2PDF_exception $e) { echo $e; }


?>