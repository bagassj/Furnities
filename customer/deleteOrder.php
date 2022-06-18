<?php

    include_once '../conn.php';
    include_once '../controller/orderClass.php';

    $order = new order($con);
    $id = $_GET['id'];

    $order->deleteData($id);
    // header("Location: wood.php");
?>
