<?php
    include_once(__DIR__.'/../../dbconnect.php');

    $sql = "SELECT count(*) AS SoLuong FROM `dondathang`";
    $result = mysqli_query($conn, $sql);
    $data = [];
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
        $data[] = array(
            'SoLuong' => $row['SoLuong'] 
        );
    }

    echo json_encode($data[0]);
?>