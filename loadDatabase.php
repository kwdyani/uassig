<?php
    include "connection.php";
    $tanggal =$_GET['tgl'];
    $warna =$_GET['warna'];
    if (empty($tanggal)){
        if($warna == 0){
        $queryGetData = $koneksi->query("SELECT nama_kabupaten, positif, dirawat, sembuh, meninggal FROM tb_data 
                                    JOIN tb_kabupaten ON tb_kabupaten.`id_kabupaten` = tb_data.`id_kabupaten`
                                    WHERE tanggal = (SELECT tanggal FROM tb_data ORDER BY tanggal DESC LIMIT 1)");
        }else{
            $queryGetData = $koneksi->query("SELECT positif FROM tb_data 
                                    JOIN tb_kabupaten ON tb_kabupaten.`id_kabupaten` = tb_data.`id_kabupaten`
                                    WHERE tanggal = (SELECT tanggal FROM tb_data ORDER BY tanggal DESC LIMIT 1) 
                                    GROUP BY positif");
        }
    }else{
        if ($warna == 0){
            $queryGetData = $koneksi->query("SELECT nama_kabupaten, positif, dirawat, sembuh, meninggal FROM tb_data 
									JOIN tb_kabupaten ON tb_kabupaten.`id_kabupaten` = tb_data.`id_kabupaten`
									WHERE tanggal = '$tanggal'");
        }else{
            $queryGetData = $koneksi->query("SELECT positif FROM tb_data 
                                    JOIN tb_kabupaten ON tb_kabupaten.`id_kabupaten` = tb_data.`id_kabupaten`
                                    WHERE tanggal = '$tanggal' GROUP BY positif");
        }
    }

    $row = array();
    while ($rowData = mysqli_fetch_array($queryGetData)) {
        $row[] = $rowData;
    }
    print json_encode($row);
?>