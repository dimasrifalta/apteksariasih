<?php
session_start();
// include 'koneksi.php';

// $query= mysqli_query($config, "SELECT * FROM account WHERE id_karyawan='$_SESSION[idkuy]' " );
// $row = mysqli_fetch_assoc($query);

if(@$_SESSION['level'] =='Admin'  ){
 header("Location: index.php?page=dashboard");

}
elseif (@$_SESSION['level'] =='Apoteker'  ){
 header("Location: index_apoteker.php?page=dashboard");


 }
elseif (@$_SESSION['level'] =='Karyawan'  ){
 header("Location: index_employee.php?page=dashboard");



} else  {





if(isset($_POST['login'])){ 
	require("koneksi.php");
					
	$username	= $_POST['username'];
	$password	= md5($_POST['password']);
	$level		= $_POST['level'];	
					
	$query = mysqli_query($config, "SELECT * FROM account WHERE username='$username' AND password='$password'  AND status='aktif'" );
	if(mysqli_num_rows($query) == 0){
		echo 'Username $username dan password $password tidak ditemukan';
	}else{
		$row = mysqli_fetch_assoc($query);				
		if($row['level'] == 1 && $level == 1){
		$_SESSION['username']=$row['nama'];
		$_SESSION['idkuy']=$row['id_karyawan'];
		$_SESSION['level']='Admin';
		header("Location: index.php?page=dashboard");
	}else if($row['level'] == 2 && $level == 2){
		$_SESSION['username']=$row['nama'];
		$_SESSION['idkuy']=$row['id_karyawan'];
		$_SESSION['level']='Apoteker';
		header("Location: index_apoteker.php?page=dashboard");
	}else if($row['level'] == 3 && $level == 3){
		$_SESSION['username']=$row['nama'];
		$_SESSION['idkuy']=$row['id_karyawan'];
		$_SESSION['level']='Karyawan';
		header("Location: index_employee.php?page=dashboard");
	}else{
		echo 'Login gagal.</div>';
		}
	}
}
			
?>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>APOTEK | Sariasih</title>

  <style type="text/css">

    body { background-color:black; }

</style>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <link rel="shortcut icon" href="dist/img/dimas.png"/>
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="css/fontroboto.css">
  <!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="login-page bg-login">
    <div class="login-box">
      <div style="color:#3c8dbc" class="login-logo">
        <img style="margin-top:-12px" src="dist/img/dimas.png" alt="Logo" height="50"> <b>Apotek</b> <b>Sariasih</b>
      </div><!-- /.login-logo -->
  <!-- /.login-logo -->
 <div class="login-box-body">
        <p class="login-box-msg"><i class="fa fa-user icon-title"></i> Silahkan Login</p>
       

    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="username" placeholder="username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
      	<select class="form-control" name="level">
      		<option selected>Level</option>
      		<option value="1">Admin</option>
      		<option value="2">Apoteker</option>
      		<option value="3">Kasir</option>
      	</select>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>

      <div class="row">
        <div class="col-xs-8">
          
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit"  name="login" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    
    
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
  <script src="bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>



<?php
}
?>