<?php

    try {

        $con = new PDO('mysql:host=localhost;dbname=furnities', 'root', '', array(PDO::ATTR_PERSISTENT => true));
    } catch (PDOException $e) {

        echo $e->getMessage();
    }

    include_once 'controller/Auth.php';
    $user = new Auth($con);
?> 