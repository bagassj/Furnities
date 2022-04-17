<?php

require_once "conn.php";
if (isset($_POST['kirim'])) {

    $email = $_POST['email'];

    $password = $_POST['password'];
    if ($user->login($email, $password)) {

        header("location: admin/index.php");
    } else {
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
                    <li class="nav-item">
                        <a class="nav-link align-items-center" href="#">
                            <i class="fa-brands fa-instagram"></i>&nbsp;&nbsp;@furnities_meubel
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
                <form class="my-5" method="post">
                    <div class="form-outline mb-4">
                        <label class="form-label">Email</label>
                        <input class="form-control form-control-md py-2" type="email" placeholder="Email" name="email">
                    </div>

                    <div class="form-outline mb-4">
                        <label class="form-label">Password</label>
                        <input class="form-control form-control-md py-2" type="password" placeholder="Password" name="password">
                    </div>
  
                    <div class="mx-auto mb-5">
                        <button class="btn btn-md px-5 py-2" type="submit" name="kirim">MASUK</button>
                    </div>
                    <div class="text-center">
                        <span>Belum Memiliki Akun?</span><br>
                        <a href="signup.html">Daftar</a>
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