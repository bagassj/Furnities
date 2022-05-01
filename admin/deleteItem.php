<?php

    include_once '../conn.php';
    include_once '../controller/itemClass.php';
    include_once '../controller/woodClass.php';

    $item = new item($con);
    $wood = new wood($con);
    
    $id = $_GET['id'];

    $item->deleteData($id);

    header("Location: index.php");

?>
