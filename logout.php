<link href="dist/js/sweetalert.css" rel="stylesheet" type="text/css" >
<script src="dist/js/sweetalert.min.js"></script>
<script src="dist/js/sweetalert-dev.js"></script>

<?php
session_start();
session_destroy();
unset($_SESSION['username']);
unset($_SESSION['idkuy']);
unset($_SESSION['level']);
echo "<script type='text/javascript'>
                      setTimeout(function () {
                        swal('Warning !', 'Anda telah keluar aplikasi', 'warning')
                      },10);
                         window.setTimeout(function(){
                           window.location.href='login.php';
                         } ,1100);
                       </script>";

?>