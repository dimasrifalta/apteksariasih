<?php

/*
* To change this template, choose Tools | Templates
* and open the template in the editor.


*/


$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db'   => 'apotek',
    'host' => 'localhost'
);
$config = $sql_details;

    
    $host   ="localhost";
    $user ="root";
    $password ="";
    $db ="apotek"; 
    
    $config = mysqli_connect($config['host'], $config['user'],$config['pass'],$config['db']);
    if (mysqli_connect_errno()) {

    echo mysqli_connect_error();
}


    
?>
