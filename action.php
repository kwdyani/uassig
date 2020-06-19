<?php
    include "connection.php";
    $action =$_GET['action'];
    $id =$_GET['id'];
    $tanggal =$_GET['tanggal']; 

    $getTanggal = $koneksi->query("SELECT tanggal FROM tb_data WHERE id_data='$id'");
    while ($rowData = mysqli_fetch_array($getTanggal)) {
        $row[] = $rowData;
    }

    if ($action =='delete'){
        $getDelete = $koneksi->query("DELETE FROM tb_data WHERE id_data='$id'");
        print json_encode($row);
    }else if ($action =='getedit'){
        $dataEdit = $koneksi->query("SELECT tb_data.id_kelurahan, nama_kelurahan, PPLN, PPDN, TL, Lainnya, Perawatan, Sembuh, Meninggal, tanggal FROM tb_data 
            JOIN tb_kelurahan ON tb_kelurahan.`id_kelurahan` = tb_data.`id_kelurahan`
            WHERE id_data = '$id'");
        while ($get = mysqli_fetch_array($dataEdit)) {
        $editData[] = $get;
        print json_encode($editData);
        }   
    }else if ($action=="add") {
        $hariSebelum = $koneksi->query("INSERT INTO tb_data(id_kabupaten, positif, sembuh, dirawat, meninggal, tanggal)
                                        SELECT id_kabupaten, positif, sembuh, dirawat, meninggal, '$tanggal' FROM tb_data WHERE tanggal = (SELECT tanggal FROM tb_data HAVING (tanggal-DATE('$tanggal')) = -1 LIMIT 1)");
        print json_encode($tanggal);
    }

?>