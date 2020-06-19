<?php
$servername = "db4free.net";
$username = "kertiw";
$password = "123kerti";
$db = "db_covid19_kerti";

// Create connection
$koneksi = new mysqli($servername, $username, $password, $db);
if(mysqli_connect_errno()){
    printf ("Gagal terkoneksi : ".mysqli_connect_error());
    exit();
}

?>
