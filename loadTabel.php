<?php
    include "connection.php";
    $tanggal =$_GET['tgl'];
    if (empty($tanggal)){
        $queryGetData = $koneksi->query("SELECT id_data, nama_kelurahan, PPLN, PPDN, TL, Lainnya, Perawatan, Sembuh, Meninggal
            FROM tb_data
            JOIN tb_kelurahan ON tb_kelurahan.`id_kelurahan` = tb_data.`id_kelurahan`
            WHERE tanggal = '2020-06-18';");
    }else{
        $queryGetData = $koneksi->query("SELECT id_data, nama_kelurahan, PPLN, PPDN, TL, Lainnya, Perawatan, Sembuh, Meninggal
            FROM tb_data
            JOIN tb_kelurahan ON tb_kelurahan.`id_kelurahan` = tb_data.`id_kelurahan`
            WHERE tanggal = '$tanggal';");
    }
    
    while ($rowData = mysqli_fetch_array($queryGetData)) {
        $row[] = $rowData;
    }
    
    print json_encode($row);
?>