<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "db_sig_covid19";

// Create connection
$koneksi = new mysqli($servername, $username, $password, $db);
if(mysqli_connect_errno()){
    printf ("Gagal terkoneksi : ".mysqli_connect_error());
    exit();
}

?>