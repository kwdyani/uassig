<?php
    include "connection.php";
    $tanggal =$_GET['tgl'];
    if (empty($tanggal)){
        $queryGetData = $koneksi->query("SELECT SUM(PPLN + PPDN+ TL + Lainnya) AS jumPositif, SUM(Perawatan) AS jumDirawat, SUM(Sembuh) AS jumSembuh, SUM(Meninggal) AS jumMeninggal, tanggal FROM tb_data WHERE tanggal = (SELECT tanggal FROM tb_data ORDER BY tanggal DESC LIMIT 1) GROUP BY tanggal");
    }else{
        $queryGetData = $koneksi->query("SELECT SUM(PPLN + PPDN+ TL + Lainnya) AS jumPositif, SUM(Perawatan) AS jumDirawat, SUM(Sembuh) AS jumSembuh, SUM(Meninggal) AS jumMeninggal, tanggal FROM tb_data WHERE tanggal = '$tanggal' GROUP BY tanggal");
    }
    $row = array();
    while ($rowData = mysqli_fetch_array($queryGetData)) {
        $row[] = $rowData;
    }
    print json_encode($row);
?>