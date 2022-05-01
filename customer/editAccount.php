<?php
require_once "../conn.php"; 
extract($user->getUser());

if (isset($_POST['save'])) {
    $id = $id;
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $noHp = $_POST['noHp'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($user->updateData($id, $nama, $alamat, $noHp, $email, $password)) {
        header("location: account.php");
    } 
}
if (isset($_GET['logout'])) {
    $user->logout();
    header("location: ../index.php");
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
    
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link align-items-center" href="index.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link align-items-center" href="#">Mulai Jual</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link align-items-center" href="#">Keranjang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link align-items-center" href="account.php">Profil</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div id="formPage" class="row mt-5">
            <h2 class="mb-5">Informasi Akun <a class="btn btn-danger align-items-center" href="?logout">Keluar</a></h2>
            <form method="post" class="mt-5">
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Nama Lengkap:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama" value="<?php echo $nama_lengkap; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Alamat:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="alamat" value="<?php echo $alamat; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Email:</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Password:</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="password" value="<?php echo $password; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">No. HP:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="noHp" value="<?php echo $no_hp; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col text-center">
                        <button type="submit" class="btn btn-prim" name="save">Simpan Perubahan</button>
                        <button type="button" class="btn btn-prim" onclick="location.href='account.php'">Batal</button>
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