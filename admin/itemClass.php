<?php

    class item
    {
        private $db;

        public function __construct($con)
        {
            $this->db = $con;
        }

        ### Start : fungsi insert data ke database ###

        public function insertData($nama, $harga, $jenisProduk, $jenisKayu, $foto, $deskripsi)
        {
            try {
                $stmt = $this->db->prepare("INSERT INTO products(jenis_product_id, jenis_kayu_id, nama_produk, deskripsi, harga, foto) VALUES(:jenisProduk, :jenisKayu, :nama, :deskripsi, :harga, :foto)");

                $stmt->bindparam(":jenisProduk", $jenisProduk);

                $stmt->bindparam(":jenisKayu", $jenisKayu);

                $stmt->bindparam(":nama", $nama);

                $stmt->bindparam(":deskripsi", $deskripsi);

                $stmt->bindparam(":harga", $harga);

                $stmt->bindparam(":foto", $foto);

                $stmt->execute();

                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();

                return false;
            }
        }
        public function viewDataSelect()
        {
            $stmt = $this->db->prepare("SELECT * FROM jenis_product");
    
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
    
                    <option value="<?php echo($row['id']); ?>"><?php echo($row['nama_jenis']); ?></option>
    
                <?php
                }
            } else {
            ?>
                <option>Tidak ada data</option>
            <?php
            }
        }

        ### End : fungsi insert data ke database ###

        ### Start : fungsi ambil data dari database ###

        public function getID($id)
        {
            $stmt = $this->db->prepare("SELECT * FROM products WHERE id=:id");

            $stmt->execute(array(":id" => $id));

            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            return $data;
        }

        ### End: fungsi ambil data dari database ###

        ### Start : fungsi untuk menampilkan data dari database ###

        public function viewData()
        {
            $stmt = $this->db->prepare("SELECT * FROM products");

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <div class="col-2 my-2">
                        <button type="button" class="border-0 bg-transparent" data-bs-toggle="modal" data-bs-target="#Modal<?php echo($row['id']); ?>">
                            <div class="card"">
                                <img src="../upload/<?php echo($row['foto']); ?>" class="card-img-top" alt="...">
                                <ul class="list-group list-group-flush text-center">
                                    <li class="list-group-item border-0 py-1 px-0">Kode: <?php echo($row['id']); ?></li>
                                    <li class="list-group-item border-0 py-1 px-0">Harga: Rp <?php echo($row['harga']); ?></li>
                                </ul>
                            </div>
                        </button>
                    </div>

             <?php
                }
            } 
        }
        public function viewDataModal()
        {
            $stmt = $this->db->prepare("SELECT products.id,nama_produk,deskripsi,harga,foto,jenis_product.nama_jenis as jenis,jenis_kayu.nama_jenis as jenis_kayu FROM products JOIN jenis_product ON products.jenis_product_id=jenis_product.id JOIN jenis_kayu ON products.jenis_kayu_id=jenis_kayu.id");

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <div class="modal fade" id="Modal<?php echo($row['id']); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Meja Belajar</h5>&nbsp;&nbsp;&nbsp;
                                    <a class="btn btn-prim" href="editItem.php?id=<?php echo($row['id']); ?>">UBAH</a>&nbsp;&nbsp;&nbsp;
                                    <a class="btn btn-danger"  href="deleteItem.php?id=<?php echo($row['id']); ?>">HAPUS</a>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <img src="../upload/<?php echo($row['foto']); ?>" class="card-img-top" alt="...">
                                            </div>
                                            <div class="col-md-6">
                                                <span><b>Harga:</b> <?php echo($row['harga']); ?></span><br>
                                                <span><b>Nama:</b> <?php echo($row['nama_produk']); ?></span><br>
                                                <span><b>Jenis Produk:</b> <?php echo($row['jenis']); ?></span><br>
                                                <span><b>Jenis Kayu:</b> <?php echo($row['jenis_kayu']); ?></span><br>
                                                <span><b>Deskripsi:</b> <?php echo($row['deskripsi']); ?></span><br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

             <?php
                }
            } 
        }

        ### End : fungsi untuk menampilkan data dari database ###

        ### Start : fungsi untuk memperbaharui data###

        public function updateData($id, $nama, $harga, $jenisProduk, $jenisKayu, $foto, $deskripsi)
        {
            try {
                $stmt = $this->db->prepare("UPDATE products SET jenis_product_id=:jenisProduk,jenis_kayu_id=:jenisKayu,nama_produk=:nama,deskripsi=:deskripsi,harga=:harga,foto=:foto WHERE id=:id");

                $stmt->bindparam(":id", $id);

                $stmt->bindparam(":jenisProduk", $jenisProduk);

                $stmt->bindparam(":jenisKayu", $jenisKayu);

                $stmt->bindparam(":nama", $nama);

                $stmt->bindparam(":deskripsi", $deskripsi);

                $stmt->bindparam(":harga", $harga);

                $stmt->bindparam(":foto", $foto);

                $stmt->execute();

                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();

                return false;
            }
        }

        ### End : fungsi untuk memperbaharui data###

        ### Start : fungsi untuk menghapus data###

        public function deleteData($id)
        {
            $stmt = $this->db->prepare("DELETE FROM products WHERE id=:id");

            $stmt->bindparam(":id", $id);

            $stmt->execute();

            return true;
        }

        ### End : fungsi untuk menghapus data###
    }
?>