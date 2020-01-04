<link href="../../dist/js/sweetalert.css" rel="stylesheet" type="text/css" >  
<script src="../../dist/js/sweetalert.min.js"></script>
<script src="../../dist/js/sweetalert-dev.js"></script>


<?php
session_start();
if(empty($_SESSION['username'])){
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
$g=$_GET['sender'];
if($g=='obat')
{
   $ambilProduk = mysqli_fetch_array(mysqli_query($config, "select * from obat where nm_obat = '$_POST[nm_obat]'"));

    

      $nmobat=strtoupper($_POST['nm_obat']);
     $satuan= strtoupper($_POST['satuan']);
      $nm= strtoupper($ambilProduk['nm_obat']);
      $st= strtoupper($ambilProduk['satuan']);

     if (strtolower($nmobat) == strtolower( $nm) && strtolower($satuan) == strtolower($st)) {
 echo "<script type='text/javascript'>
                      setTimeout(function () {
                        swal('Deleted !', 'Data obat Sudah ada', 'error')
                      },10);
                         window.setTimeout(function(){
                           window.location.href='../../index.php?page=obat';
                         } ,1100);
                       </script>";
}

else {
  





   $harga_beli = str_replace('.', '', mysqli_real_escape_string($config, trim($_POST['harga_beli'])));
            $harga_jual = str_replace('.', '', mysqli_real_escape_string($config, trim($_POST['harga_jual'])));
    $sql="INSERT INTO obat  (kd_obat, 	nm_obat, kategori, 	satuan, harga_beli, harga_jual)
    VALUES
    ('$_POST[kd_obat]',
    '$_POST[nm_obat]',
    
    '$_POST[kg]',
    '$_POST[satuan]',
    '$harga_beli',
    '$harga_jual')"; 

    if (mysqli_query($config, $sql)){ 
          echo "<script type='text/javascript'>
                         setTimeout(function () {
                           swal('Succes!', 'Data obat Berhasil Di tambahkan', 'success')
                         },10);
                         window.setTimeout(function(){
                           window.location.href='../../index.php?page=obat';
                         } ,1200);
                       </script>";

    }
    else{
        echo "Error : ".$sql.". ".mysqli_error($config);
    }
     //header('location:http://localhost/');
}
}

else 
    if($g=='edit')
    {

          $harga_beli = str_replace('.', '', mysqli_real_escape_string($config, trim($_POST['harga_beli'])));
            $harga_jual = str_replace('.', '', mysqli_real_escape_string($config, trim($_POST['harga_jual'])));
        mysqli_query($config,"UPDATE obat SET kd_obat='$_POST[kd_obat]',
            kd_obat='$_POST[kd_obat]',
            nm_obat='$_POST[nm_obat]', kategori='$_POST[kg]', satuan='$_POST[satuan]', harga_beli='$harga_beli', harga_jual='$harga_jual' WHERE kd_obat='$_POST[kd_obat]'");
         echo "<script type='text/javascript'>
                         setTimeout(function () {
                           swal('Succes!', 'Data obat Berhasil Di perbarui', 'success')
                         },10);
                         window.setTimeout(function(){
                           window.location.href='../../index.php?page=obat';
                         } ,1200);
                       </script>";
    } 
    else 
        if($g=='hapus')
        {
            mysqli_query($config,"DELETE FROM obat where kd_obat='$_GET[kd_obat]'");
           echo "<script type='text/javascript'>
                      setTimeout(function () {
                        swal('Deleted !', 'Berhasil di Hapus', 'error')
                      },10);
                         window.setTimeout(function(){
                           window.location.href='../../index.php?page=obat';
                         } ,1100);
                       </script>";
        }
//End Aksi Anggota
        ?>
