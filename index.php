<?php
require_once "conn.php";
include_once "controller/itemClass.php";

$item = new item($con);

if($user->isLoggedIn()){ 
    $lvl = $_SESSION['level'];
    if($lvl =='admin'){
        header("location: admin/index.php");
    }
    elseif($lvl =='customer'){
        header("location: customer/index.php");
    }
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Furnities - Buy cheap and best furniture</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-blue">
        <div class="container">
            <a class="navbar-brand" href="index.php"><img src="assets/img/logo.png" alt="" style="width: 90px;"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item" id="home">
                        <a class="align-items-center" href="#">
                            <i class="fa-brands fa-instagram"></i>&nbsp;&nbsp;@furnties_meubel
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <section id="welcomePage" class="row mt-5 py-5">
            <div class="col-6">
                <div class="image"></div>
            </div>
            <div class="col-6">
                <h1>Selamat Datang</h1>
                <p class="my-4">Selamat datang di Furnity! Cari meja, kursi, lemari, atau bahkan dekorasi rumah berbahan kayu? Kami menyediakan segala kebutuhan anda. Tersedia berbagai design dan bisa custom lho!</p>
                <div class="w-100 text-center">
                    <button type="button" class="btn btn-md px-5 py-2" onclick="location.href='signin.php'">Masuk</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="button" class="btn btn-md px-5 py-2" onclick="location.href='signup.php'">Daftar</button>
                </div>
            </div>
        </section>
        <section id="catalogPage" class="row mt-5 py-5">
            <h3 class="mb-4">Katalog kami</h3>
            <?php
            $item->viewDataCatalog();
            ?>
        </section>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/8da538daa2.js" crossorigin="anonymous"></script>
</html>