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
 * Sample Crud mysqlii
 * 10/07/2017 23:03
 * priadyheri@gmail.com
 * 082386376942
 * https://www.facebook.com/ciwerartikel
 * Alamat :Desa Kumain, Kec.Tandun, Kab.Rokan Hulu
 * and open the template in the editor.
 */ 
//Start Aksi Anggota
$g=$_GET['sender'];
if($g=='pass')

{
    

    
    // ambil data hasil submit dari form
            $old_pass    = md5(mysqli_real_escape_string($config, trim($_POST['pass_lama'])));
            $new_pass    = md5(mysqli_real_escape_string($config, trim($_POST['pass_baru'])));
            $retype_pass = md5(mysqli_real_escape_string($config, trim($_POST['pass_ulangi'])));

            // ambil data hasil session user
           
           

            // seleksi password dari tabel user untuk dicek
            $sql = mysqli_query($config, "SELECT * FROM account WHERE id_karyawan='$_SESSION[idkuy]'")
                                          or die('Ada kesalahan pada query seleksi  password : '.mysqli_error($config));
            $data = mysqli_fetch_assoc($sql);

            // fungsi untuk pengecekan password sebelum diubah 
            // jika input password lama tidak sama dengan password di database, 
            // alihkan ke halaman ubah password dan tampilkan pesan = 1
            if ($old_pass != $data['password']){

                 echo '<script LANGUAGE="JavaScript">
            
            window.location.href="../../index_employee.php?page=pass&alert=1";
            </script>'; 
                
            }

            // jika input password lama sama dengan password didatabase, jalankan perintah untuk pengecekan selanjutnya
            else {

                // jika input password baru tidak sama dengan input ulangi password baru, 
                // alihkan ke halaman ubah password dan tampilkan pesan = 2 
                if ($new_pass != $retype_pass){
                         echo '<script LANGUAGE="JavaScript">
            
            window.location.href="../../index_employee.php?page=pass&alert=2";
            </script>'; 
                }

                // selain itu, jalankan perintah update password
                else {
                    // perintah query untuk mengubah data pada tabel user
                    $query = mysqli_query($config, "UPDATE account SET password = '$new_pass'
                                                                  WHERE id_karyawan  = '$_SESSION[idkuy]'")
                                                    or die('Ada kesalahan pada query update password : '.mysqli_error($config));   

                    // cek query
                    if ($query) {
                        // jika berhasil tampilkan pesan berhasil update data
                        echo '<script LANGUAGE="JavaScript">
            
            window.location.href="../../index_employee.php?page=pass&alert=3";
            </script>'; 
                    }   
                }
            }
        }

?>