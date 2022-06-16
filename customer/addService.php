<?php
require_once "../conn.php";
include_once '../controller/itemClass.php';
include_once '../controller/woodClass.php';
include_once '../controller/serviceClass.php';

$item = new item($con);
$wood = new wood($con);
$service = new service($con);

if(isset($_POST['save'])){
    $id = $_SESSION['user_session'];
    $alamat = $_POST['alamat'];
    $jenisKayu = $_POST['jenisKayu'];
    $diameter = $_POST['diameter'];
    $tinggi = $_POST['tinggi'];
    $harga = $_POST['harga'];
    $keterangan = $_POST['keterangan'];
    $nameFoto = $_FILES['file']['name'];
    $foto = $_FILES['file']['tmp_name'];
    $temp = explode(".", $_FILES["file"]["name"]);
    $newfilename = round(microtime(true)) . '.' . end($temp);
    $location="../upload/".$newfilename;
    $tanggal = date("Y-m-d");

    move_uploaded_file($foto, $location);
    $service->insertData($id, $alamat, $jenisKayu, $diameter, $tinggi, $harga, $keterangan, $newfilename, $tanggal);
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
            <div class="col-8">
                <h2>Punya kayu mentah untuk dijual? Jual kayumu disini!</h2>
            </div>
            <div class="col-4 text-end">
                <button type="button" class="btn btn-prim w" onclick="location.href='service.php'">LIHAT DAFTAR TRANSAKSI</button>
            </div>
            <form method="post" class="mt-5" enctype="multipart/form-data">
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Alamat:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="alamat">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Harga:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="harga">
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
                    <label class="col-sm-2 col-form-label">Diameter Kayu:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="diameter">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Tinggi Kayu:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="tinggi">
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
                <div class="row">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-prim" name="save">Buat Pesanan</button>
                    </div>
                    <div class="col-4 text-start">
                        <span class="text-danger">* Menerima pemesanan jasa penebangan kayu khusus untuk wilayah jember</span>
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