<?php
require_once "../conn.php";
include_once 'itemClass.php';
include_once 'woodClass.php';

$item = new item($con);
$wood = new wood($con);

if(isset($_POST['addWood'])){ 

    $nama = $_POST['nama'];

    if($wood->insertData($nama)){ 

        // Jika berhasil set variable success ke true 
        header("location: wood.php");
        $success = true; 

    }else{ 

        // Jika gagal, ambil pesan error 

        $error = $user->getLastError(); 

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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
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
        <section id="linkPage" class="row g-0 mt-5 pt-5">
            <div class="col-6 d-grid">
                <button type="submit" class="btn btn-green rounded-0" onclick="location.href='addItem.php'">Tambahkan data barang</button>
            </div>
            <div class="col-6 d-grid">
                <button type="submit" class="btn btn-prim rounded-0" onclick="location.href='wood.php'">Data jenis kayu</button>
            </div>
        </section>
        <section id="dataPage" class="row g-0 mt-5 pt-5">
            <table id="example" class="table table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Jenis</th>
                        <th>Ubah Data</th>
                        <th>Hapus</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $wood->viewData();
                    ?>
                </tbody>
            </table>
            <div class="row mt-3">
                <div class="col text-center">
                    <button type="button" class="btn btn-prim" data-bs-toggle="modal" data-bs-target="#Modal">Tambahkan Data</button>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid p-2">
                        <form method="post">
                            <div class="row">
                                <label class="col-sm-4 col-form-label">Jenis Kayu:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="nama">
                                </div>
                            </div>
                            
                            <div class="row mt-3">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-prim" name="addWood" data-bs-toggle="modal" data-bs-target="#Modal">Tambahkan Data</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/8da538daa2.js" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>
</html>