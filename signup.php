<?php  

// Lampirkan dbconfig 

require_once "conn.php"; 

if(isset($_POST['kirim'])){ 

  $nama = $_POST['nama']; 

  $email = $_POST['email']; 

  $password = $_POST['password']; 

  $alamat = $_POST['alamat'];

  $nohp = $_POST['nohp'];

  // Registrasi user baru 

  if($user->register($nama, $email, $password, $alamat, $nohp)){ 

    // Jika berhasil set variable success ke true 
    header("location: customer/index.php");
    $success = true; 

  }else{ 

    // Jika gagal, ambil pesan error 

    $error = $user->getLastError(); 

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
                        <a class="nav-link align-items-center" href="#">
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
            <div class="col-6 px-4">
                <h1 class="text-center">Selamat Datang</h1>
                <h6 class="fw-normal text-center" style="letter-spacing: 1px;">Daftar Sekarang</h6>
                <form class="my-5" method="post">
                    <div class="form-outline mb-4">
                        <input class="form-control form-control-md py-2" type="text" placeholder="Nama Lengkap" required name="nama">
                    </div>

                    <div class="form-outline mb-4">
                        <input class="form-control form-control-md py-2" type="email" placeholder="Email" required name="email">
                    </div>

                    <div class="form-outline mb-4">
                        <input class="form-control form-control-md py-2" type="password" placeholder="Password" minlength="8" required name="password">
                    </div>

                    <div class="form-outline mb-4">
                        <input class="form-control form-control-md py-2" type="text" placeholder="Alamat" required name="alamat">
                    </div>

                    <div class="form-outline mb-4">
                        <input class="form-control form-control-md py-2" type="text" placeholder="No. HP" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" required name="nohp">
                    </div>
  
                    <div class="mx-auto mb-5">
                        <button class="btn btn-md px-5 py-2" type="submit" name="kirim">DAFTAR</button> 
                    </div>
                </form>
            </div>
        </section>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/8da538daa2.js" crossorigin="anonymous"></script>
</html>