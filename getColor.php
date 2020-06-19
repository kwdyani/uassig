<?php
    include "connection.php";
    $ColorSteps = array();
    $tanggal =$_GET['tgl'];

    $HexFrom = ltrim($_GET['start'], '#');
    $HexTo = ltrim($_GET['end'], '#');
    if (empty($tanggal)){
      $queryTotal = $koneksi->query("SELECT COUNT(DISTINCT positif) AS totalWarna FROM tb_data WHERE tanggal = (SELECT tanggal FROM tb_data ORDER BY tanggal DESC LIMIT 1)");
    }else{
      $queryTotal = $koneksi->query("SELECT COUNT(DISTINCT positif) AS totalWarna FROM tb_data WHERE tanggal = '$tanggal'");
    }
    
    while ($rowData = mysqli_fetch_array($queryTotal)) {
        $ColorSteps = $rowData[0];
    }

      $FromRGB['r'] = hexdec(substr($HexFrom, 0, 2));
      $FromRGB['g'] = hexdec(substr($HexFrom, 2, 2));
      $FromRGB['b'] = hexdec(substr($HexFrom, 4, 2));

      $ToRGB['r'] = hexdec(substr($HexTo, 0, 2));
      $ToRGB['g'] = hexdec(substr($HexTo, 2, 2));
      $ToRGB['b'] = hexdec(substr($HexTo, 4, 2));

      $StepRGB['r'] = ($FromRGB['r'] - $ToRGB['r']) / ($ColorSteps - 1);
      $StepRGB['g'] = ($FromRGB['g'] - $ToRGB['g']) / ($ColorSteps - 1);
      $StepRGB['b'] = ($FromRGB['b'] - $ToRGB['b']) / ($ColorSteps - 1);

      $GradientColors = array();

          for($i = 0; $i <= $ColorSteps; $i++) {
            $RGB['r'] = floor($FromRGB['r'] - ($StepRGB['r'] * $i));
            $RGB['g'] = floor($FromRGB['g'] - ($StepRGB['g'] * $i));
            $RGB['b'] = floor($FromRGB['b'] - ($StepRGB['b'] * $i));

            $HexRGB['r'] = sprintf('%02x', ($RGB['r']));
            $HexRGB['g'] = sprintf('%02x', ($RGB['g']));
            $HexRGB['b'] = sprintf('%02x', ($RGB['b']));

            $GradientColors[] = implode(NULL, $HexRGB);
          }
      $GradientColors = array_filter($GradientColors, "len");
      print json_encode($GradientColors);

function len($val){
  return (strlen($val) == 6 ? true : false );
}
?>
