<?php
    include "connection.php";
    $id =$_GET['id'];
    $tanggal =$_GET['tanggal'];
    $ppln =$_GET['ppln'];
    $ppdn =$_GET['ppdn'];
    $tl =$_GET['tl'];
    $ppln =$_GET['ppln'];
    $lainnya =$_GET['lainnya'];
    $perawatan =$_GET['perawatan'];
    $sembuh =$_GET['sembuh'];
    $meninggal =$_GET['meninggal'];

    $getTanggal = $koneksi->query("SELECT tanggal FROM tb_data WHERE id_data='$id'");
    while ($rowData = mysqli_fetch_array($getTanggal)) {
        $row[] = $rowData;
    }

    $finalEdit = $koneksi->query("UPDATE tb_data set PPLN='$ppln', PPDN='$ppdn', TL='$tl', Lainnya='$lainnya', Perawatan ='$perawatan', Sembuh='$sembuh', Meninggal= '$meninggal' WHERE id_data='$id'");
    print json_encode($row);

?>