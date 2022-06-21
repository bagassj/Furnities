<?php
require_once "../conn.php";
include_once '../controller/itemClass.php';
include_once '../controller/woodClass.php';
include_once '../controller/orderClass.php';

$item = new item($con);
$wood = new wood($con);
$order = new order($con);
$search = '';
$filter = '';

if(isset($_POST['addOrder'])){
    $idCustomer = $_SESSION['user_session'];
    $idItem = $_POST['id'];
    $price = $_POST['price']; 
    $order->addOrder($idCustomer, $idItem, $price);
}

if(isset($_POST['btnSearch'])){
    $search = $_POST['search'];
}

if(isset($_POST['btnFilter'])){
    $filter = $_POST['filter'];
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
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-blue">
        <div class="container">
            <a class="navbar-brand" href="../index.php"><img src="../assets/img/logo.png" alt="" style="width: 90px;"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <?php include_once 'cNavbar.php'; ?>
        </div>
    </nav>
    <div class="container">
        <section id="welcomePage" class="row mt-5 pt-5">
            <div class="col-10">
                <form method="post">
                    <div class="row">
                        <div class="col-11">
                            <input type="text" name="search" class="form-control">
                        </div>
                        <div class="col-1">
                            <button type="submit" name="btnSearch" class="btn">Cari</button>
                        </div>
                    </div>
                </form> 
            </div>
            <div class="col-2 d-grid gap-2">
                <button type="submit" class="btn" onclick="location.href='customOrder.php'">Custom Desain</button>
            </div>
        </section>
        <section id="catalogPage" class="row py-5">
            <div class="col-12 pb-5 text-center">
                <div class="row d-flex justify-content-center text-center">
                    <?php
                    $item->viewDataFilter();
                    ?>
                </div>
            </div>
            <?php
            $item->viewData($search, $filter);
            ?>
        </section>
    </div>
    
    <?php
    $item->viewDataModal();
    ?>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/8da538daa2.js" crossorigin="anonymous"></script>
</html>