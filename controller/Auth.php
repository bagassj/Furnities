<?php

/** 

 * Class Auth untuk melakukan login dan registrasi user baru 

 */
class Auth

{

    private $db; //Menyimpan Koneksi database 

    private $error; //Menyimpan Error Message 

    ## Contructor untuk class Auth, membutuhkan satu parameter yaitu koneksi ke database ## 

    function __construct($db_conn)

    {

        $this->db = $db_conn;

        // Mulai session  

        session_start();
    }

    ### Start : Registrasi User baru ###  

    public function register($nama, $email, $password, $alamat, $nohp)

    {

        try {

            //Masukkan user baru ke database 

            $stmt = $this->db->prepare("INSERT INTO customers(nama_lengkap, alamat, no_hp, email, password) VALUES(:nama, :alamat, :nohp, :email, :pass)");

            $stmt->bindParam(":nama", $nama);

            $stmt->bindParam(":email", $email);

            $stmt->bindParam(":pass", $password);

            $stmt->bindParam(":alamat", $alamat);

            $stmt->bindParam(":nohp", $nohp);

            $stmt->execute();

            $_SESSION['user_session'] = $this->db->lastInsertId();
            $_SESSION['level'] = 'customer';

            return true;
        } catch (PDOException $e) {

            // Jika terjadi error 

            if ($e->errorInfo[0] == 23000) {

                //errorInfor[0] berisi informasi error tentang query sql yg baru dijalankan 

                //23000 adalah kode error ketika ada data yg sama pada kolom yg di set unique 

                $this->error = "Email sudah digunakan!";

                return false;
            } else {

                echo $e->getMessage();

                return false;
            }
        }
    }

    ### End : Registrasi User baru ###  

    ### Start : fungsi login user ###  

    public function login($email, $password)

    {
        if($email=="" || $password==""){
            echo "<script type='text/javascript'>alert('Email atau Password ada yang salah');</script>";
        }
        else{
            try {

                // Ambil data dari database 

                $stmt = $this->db->prepare("SELECT * FROM admin WHERE email = :email");

                $stmt->bindParam(":email", $email);

                $stmt->execute();

                $data = $stmt->fetch();
                // Jika jumlah baris > 0 

                if ($stmt->rowCount() > 0) {

                    // jika password yang dimasukkan sesuai dengan yg ada di database 

                    if ($password == $data['password']) {

                        $_SESSION['user_session'] = $data['id'];
                        $_SESSION['level'] = 'admin';

                        return true;
                    } else {

                        echo "<script type='text/javascript'>alert('Username atau Password Salah');</script>";
                        $this->error = "Email atau Password Salah";
                        return false;
                    }
                } 
                else {
                    
                    // $this->error = "Email atau Password Salah";
                    // return false;
                    $stmtc = $this->db->prepare("SELECT * FROM customers WHERE email = :email");

                    $stmtc->bindParam(":email", $email);

                    $stmtc->execute();

                    $datac = $stmtc->fetch();

                    if ($stmtc->rowCount() > 0) {
                        // jika password yang dimasukkan sesuai dengan yg ada di database 
        
                        if ($password == $datac['password']) {
        
                            $_SESSION['user_session'] = $datac['id'];
                            $_SESSION['level'] = 'customer';
        
                            return true;
                        } else {
                            echo "<script type='text/javascript'>alert('Username atau Password Salah');</script>";
                            $this->error = "Email atau Password Salah";
                            return false;
                        }
                    }
                    else{
                        echo "<script type='text/javascript'>alert('Username atau Password Salah');</script>";
                    } 
                }
            } catch (PDOException $e) {

                echo $e->getMessage();

                return false;
            }
        }
    }

    ### End : fungsi login user ### 

    ### Start : fungsi cek login user ###  

    public function isLoggedIn()
    {

        // Apakah user_session sudah ada di session 

        if (isset($_SESSION['user_session'])) {

            return true;
        }
    }

    ### End : fungsi cek login user ###  

    ### Start : fungsi ambil data user yang sudah login ###   

    public function getUser()
    {

        // Cek apakah sudah login 

        if (!$this->isLoggedIn()) {

            return false;
        }

        try {

            // Ambil data user dari database 
            if($_SESSION['level'] == 'admin'){
                $stmt = $this->db->prepare("SELECT * FROM admin WHERE id = :id");
            }
            elseif ($_SESSION['level'] == 'customer') {
                $stmt = $this->db->prepare("SELECT * FROM customers WHERE id = :id");
            }
            $stmt->bindParam(":id", $_SESSION['user_session']);

            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC); 
        } catch (PDOException $e) {

            echo $e->getMessage();

            return false;
        }
    }

    ### End : fungsi ambil data user yang sudah login ###  

    ### Start : fungsi Logout user ###  

    public function logout()
    {

        // Hapus session 

        session_destroy();

        // Hapus user_session 

        unset($_SESSION['user_session']);

        return true;
    }

    ### End : fungsi Logout user ###  

    ### Start : fungsi ambil error terakhir yg disimpan di variable error ###  

    public function getLastError()
    {

        return $this->error;
    }

    ### End : fungsi ambil error terakhir yg disimpan di variable error ### 
    public function updateData($id, $nama, $alamat, $noHp, $email, $pwd)
        {
            try {
                if($_SESSION['level'] == 'admin'){
                    $stmt = $this->db->prepare("UPDATE `admin` SET nama_lengkap=:nama, alamat=:alamat, email=:email, password=:pwd, no_hp=:noHp WHERE id=:id");
                }
                elseif ($_SESSION['level'] == 'customer') {
                    $stmt = $this->db->prepare("UPDATE `customers` SET nama_lengkap=:nama, alamat=:alamat, email=:email, password=:pwd, no_hp=:noHp WHERE id=:id");
                }
                $stmt->bindparam(":id", $id);

                $stmt->bindparam(":nama", $nama);

                $stmt->bindparam(":alamat", $alamat);

                $stmt->bindparam(":email", $email);

                $stmt->bindparam(":pwd", $pwd);

                $stmt->bindparam(":noHp", $noHp);

                $stmt->execute();

                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();

                return false;
            }
        }


}