<?php
require_once "../conn.php";
include_once '../controller/woodClass.php';
include_once '../controller/orderClass.php';
include_once '../controller/itemClass.php';

$wood = new wood($con);
$order = new order($con);
$item = new item($con);

if(isset($_POST['save'])){
    $alamat = $_POST['alamat'];
    $jenisKayu = $_POST['jenisKayu'];
    $jenisProduk = $_POST['jenisProduk'];
    $harga = $_POST['harga'];
    $keterangan = $_POST['keterangan'];
    $nameFoto = $_FILES['file']['name'];
    $foto = $_FILES['file']['tmp_name'];
    $temp = explode(".", $_FILES["file"]["name"]);
    $newfilename = round(microtime(true)) . '.' . end($temp);
    $location="../upload/".$newfilename;

    move_uploaded_file($foto, $location);
    $id = $item->customProduk($alamat, $jenisKayu, $jenisProduk, $harga, $keterangan, $newfilename, 1);
    $order->addOrderCustom($_SESSION['user_session'], $id, $alamat);
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
    <div id="formPage" class="row mt-5">
            <div class="col-12 text-center">
                <h2>Pesan sesuai impian anda!</h2>
            </div>
            <form method="post" class="mt-5" enctype="multipart/form-data">
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Besaran Dana:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="harga">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Jenis Produk:</label>
                    <div class="col-sm-10">
                        <select class="form-select" aria-label="Default select example" name="jenisProduk">
                        <?php
                        $item->viewDataSelect();
                        ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Jenis Kayu:</label>
                    <div class="col-sm-10">
                        <select class="form-select" aria-label="Default select example" name="jenisKayu">
                        <?php
                        $wood->viewDataSelect();
                        ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Foto Produk:</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="file" name="file">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Keterangan:</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="5" style="resize: none" name="keterangan"></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Alamat:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="alamat">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-prim" name="save">Buat Pesanan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/8da538daa2.js" crossorigin="anonymous"></script>
</html>