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
    $sql="INSERT INTO obat 
        VALUES
        ('$_POST[kd_obat]',
         '$_POST[nm_obat]',
          '$_POST[stok]',
          '$_POST[kategori]', 
          '$_POST[tgl_exp]')";   
        if (mysqli_query($config, $sql)){ 
        echo '<script LANGUAGE="JavaScript">
            alert("Data obat baru dengan kd_obat :('.$_POST['kd_obat'].') Tersimpan")
            window.location.href="../../index.php?page=obat";
            </script>'; 
    }
    else{
        echo "Error : ".$sql.". ".mysqli_error($config);
    }
     //header('location:http://localhost/');
}

else 
    if($g=='edit')
    {
        mysqli_query($config,"UPDATE obat SET kd_obat='$_POST[kd_obat]',
            kd_obat='$_POST[kd_obat]',
                nm_obat='$_POST[nm_obat]', stok='$_POST[stok]', kategori='$_POST[kategori]', tgl_exp='$_POST[tgl_exp]' WHERE kd_obat='$_POST[kd_obat]'");
         echo '<script LANGUAGE="JavaScript">
            alert("Data obat dengan kode obat :('.$_POST[kd_obat].') Di Update")
            window.location.href="../../index.php?page=obat";
            </script>';
    } 
else 
    if($g=='hapus')
    {
        mysqli_query($config,"DELETE FROM obat where kd_obat='$_GET[kd_obat]'");
         echo '<script LANGUAGE="JavaScript">
            alert("Data obat dengan kode obat :('.$_GET[kd_obat].') Di Terhapus")
            window.location.href="../../index.php?page=obat";
            </script>';
    }
//End Aksi Anggota
?>
