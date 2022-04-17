<?php

    include_once '../conn.php';
    include_once 'itemClass.php';
    include_once 'woodClass.php';

    $item = new item($con);
    $wood = new wood($con);

    $id = $_GET['id'];

    if (isset($_POST['save'])) {
        $nama = $_POST['nama'];
        $harga = $_POST['harga'];
        $jenisProduk = $_POST['jenisProduk'];
        $jenisKayu = $_POST['jenisKayu'];
        $deskripsi = $_POST['deskripsi'];
        $nameFoto = $_FILES['file']['name'];
        $foto = $_FILES['file']['tmp_name'];
        $location="../upload/".$nameFoto;

        move_uploaded_file($foto, $location);
        if ($item->updateData($id, $nama, $harga, $jenisProduk, $jenisKayu, $nameFoto, $deskripsi)) {
            header("location: index.php");
        } 
    }
    if (isset($_GET['logout'])) {
        $user->logout();
        header("location: ../index.php");
    }

    if (isset($id)) {
        extract($item->getID($id));

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
    
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link align-items-center" href="index.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link align-items-center" href="#">Daftar Pesanan Jasa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link align-items-center" href="#">Daftar Pesanan Barang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link align-items-center" href="account.php">Akun</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-danger align-items-center" href="?logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div id="formPage" class="row mt-5">
            <h2>Ubah Data Barang</h2>
            <form method="post" class="mt-5" enctype="multipart/form-data">
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Nama Produk:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama" value="<?php echo $nama_produk; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Harga:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="harga" value="<?php echo $harga; ?>">
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
                    <label class="col-sm-2 col-form-label">Deskripsi Produk:</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="5" style="resize: none" name="deskripsi"><?php echo $deskripsi; ?></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-center">
                        <button type="submit" class="btn btn-prim" name="save">Simpan Perubahan</button>
                        <button type="button" class="btn btn-prim" onclick="location.href='index.php'">Batal</button>
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
<?php    }?>