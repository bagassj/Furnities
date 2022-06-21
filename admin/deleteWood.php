<?php

    include_once '../conn.php';
    include_once '../controller/woodClass.php';

    $wood = new wood($con);
    $id = $_GET['id'];

    $wood->deleteData($id);
    // header("Location: wood.php");
?>
