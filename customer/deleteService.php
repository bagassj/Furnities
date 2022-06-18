<?php

    include_once '../conn.php';
    include_once '../controller/serviceClass.php';

    $service = new service($con);
    $id = $_GET['id'];

    $service->deleteData($id);
    // header("Location: wood.php");
?>
