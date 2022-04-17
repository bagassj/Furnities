<?php

    include_once '../conn.php';
    include_once 'itemClass.php';
    include_once 'woodClass.php';

    $item = new item($con);
    $wood = new wood($con);
    
    $id = $_GET['id'];

    $item->deleteData($id);

    header("Location: index.php");

?>
