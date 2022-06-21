<?php
    class order
    {
        private $db;

        public function __construct($con)
        {
            $this->db = $con;
        }

        public function addOrder($idCustomer, $idItem, $price)
        {
            try {
                $insert = $this->db->prepare("INSERT INTO orders(customer_id, product_id, harga) VALUES(:idCustomer, :idItem, :price)");

                $insert->bindparam(":idCustomer", $idCustomer);

                $insert->bindparam(":idItem", $idItem);

                $insert->bindparam(":price", $price);

                $insert->execute(); 

                echo "<script type='text/javascript'>alert('Pesanan berhasil ditambahkan');</script>";
            } catch (PDOException $e) {
                return false;
            }
        }

        public function addOrderCustom($idCustomer, $idItem, $alamat, $price)
        {
            try {
                $insert = $this->db->prepare("INSERT INTO orders(customer_id, product_id, lokasi_tujuan, status_pesanan, tanggal, harga) VALUES(:idCustomer, :idItem, :alamat, 'Menunggu Konfirmasi', now(), :price)");

                $insert->bindparam(":idCustomer", $idCustomer);

                $insert->bindparam(":idItem", $idItem);

                $insert->bindparam(":alamat", $alamat);

                $insert->bindparam(":price", $price);

                $insert->execute();
            } catch (PDOException $e) {
                return false;
            }
        }

        public function viewData()
        {
            $stmt = $this->db->prepare("SELECT orders.id AS ID, nama_lengkap, product_id, lokasi_tujuan, tanggal, status_pesanan FROM orders JOIN customers ON orders.customer_id = customers.id WHERE status_pesanan IS NOT NULL");

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>

                        <td><?php echo($row['ID']); ?></td>

                        <td><?php echo($row['nama_lengkap']); ?></td>

                        <td><?php echo($row['product_id']); ?></td>

                        <td><?php echo($row['lokasi_tujuan']); ?></td>

                        <td><?php echo($row['tanggal']); ?></td>

                        <td align="center">
                            <?php
                            if($row['status_pesanan'] == 'Ditolak'){
                                ?><a href="editOrder.php?id=<?php echo($row['ID']); ?>"><span type="button" class="btn btn-danger btn-sm"><?php echo($row['status_pesanan']); ?></span></a><?php
                            }
                            elseif($row['status_pesanan'] == 'Menunggu Konfirmasi'){
                                ?><a href="editOrder.php?id=<?php echo($row['ID']); ?>"><span type="button" class="btn btn-warning btn-sm"><?php echo($row['status_pesanan']); ?></span></a><?php
                            }
                            else{
                                ?><a href="editOrder.php?id=<?php echo($row['ID']); ?>"><span type="button" class="btn btn-success btn-sm"><?php echo($row['status_pesanan']); ?></span></a><?php
                            }
                            ?>
                        </td>

                    </tr>
                    <?php
                }
            } 
        }

        public function viewDataByID($id)
        {
            $stmt = $this->db->prepare("SELECT orders.id AS orderID, foto, nama_produk, orders.harga AS harga, status_pesanan, deskripsi, jenis_kayu.nama_jenis AS jenisKayu, jenis_product.nama_jenis AS jenisProduk FROM orders JOIN products ON orders.product_id = products.id JOIN jenis_kayu ON products.jenis_kayu_id = jenis_kayu.id  JOIN jenis_product ON products.jenis_product_id = jenis_product.id WHERE customer_id = :id");
            $stmt->execute(array(":id" => $id));
            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <div class="col-12 my-3">
                        <div class="card mb-3">
                            <div class="row no-gutters px-5 py-2">
                                <div class="col-md-12">
                                    <?php if($row['nama_produk'] == ''){
                                        ?> <h5 class="card-title">Custom Design</h5> <?php
                                    }
                                    else{
                                        ?> <h5 class="card-title"><?php echo($row['nama_produk']); ?></h5> <?php
                                    } 
                                    ?>
                                </div>
                                <div class="col-md-3">
                                    <img src="../upload/<?php echo($row['foto']); ?>" class="card-img" alt="...">
                                </div>
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <span class="card-text"><b class="text-dark">Harga:</b> <?php echo($row['harga']); ?></span><br>
                                        <span class="card-text"><b class="text-dark">Jenis Produk:</b> <?php echo($row['jenisProduk']); ?></span><br>
                                        <span class="card-text"><b class="text-dark">Jenis Kayu:</b> <?php echo($row['jenisKayu']); ?></span><br>
                                        <span class="card-text"><b class="text-dark">Deskripsi:</b> <?php echo($row['deskripsi']); ?></span><br>
                                        <?php 
                                        if($row['status_pesanan']!='' && $row['status_pesanan']!='Ditolak'){
                                        ?>
                                            <span class="card-text text-success"><b class="text-dark">Status:</b> <?php echo($row['status_pesanan']); ?></span><br>
                                        
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-3 text-end">
                                    <?php 
                                    if($row['status_pesanan']==''){ 
                                    ?>
                                        <!-- <form method="post" enctype="multipart/form-data"> -->
                                            <input type="hidden" name="id" value="<?php echo($row['orderID']); ?>"/>
                                            <a class="btn btn-danger" onClick="javascript: return confirm('Apakah anda yakin ingin menghapus?');" href="deleteOrder.php?id=<?php echo($row['orderID']); ?>">Hapus</a>
                                            <button class="btn btn-success" name="addOrder"data-bs-toggle="modal" data-bs-target="#Modal<?php echo($row['orderID']); ?>">Konfirmasi</button>
                                        <!-- </form> -->
                                    <?php 
                                    }
                                    elseif($row['status_pesanan']=='Ditolak'){
                                        ?><span class="btn btn-danger"><?php echo($row['status_pesanan']); ?></span><?php
                                    }
                                    else{
                                        ?><span class="btn btn-success">Dikonfirmasi</span><?php
                                    } 
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
        }

        public function viewEditDataByID($id)
        {
            $stmt = $this->db->prepare("SELECT orders.id AS orderID, foto, nama_produk, orders.harga AS harga, lokasi_tujuan, status_pesanan, nama_lengkap, deskripsi, jenis_kayu.nama_jenis AS jenisKayu, jenis_product.nama_jenis AS jenisProduk FROM orders JOIN customers ON orders.customer_id = customers.id JOIN products ON orders.product_id = products.id JOIN jenis_kayu ON products.jenis_kayu_id = jenis_kayu.id  JOIN jenis_product ON products.jenis_product_id = jenis_product.id WHERE orders.id = :id");
            $stmt->execute(array(":id" => $id));
            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <div class="row no-gutters px-5 py-2">
                            <div class="col-md-12">
                                    <?php 
                                    if($row['nama_produk'] == ''){
                                        ?> <h5 class="card-title">Custom Design</h5> <?php
                                    }
                                    else{
                                        ?> <h5 class="card-title"><?php echo($row['nama_produk']); ?></h5> <?php
                                    } 
                                    ?>
                            </div>
                            <div class="col-4">
                                <img src="../upload/<?php echo($row['foto']); ?>" class="card-img" alt="...">
                            </div>
                            <div class="col-8">
                                <form method="post" class="" enctype="multipart/form-data">
                                    <div class="row mb-3 align-items-center">
                                        <label class="col-sm-2 col-form-label">Pemesan:</label>
                                        <div class="col-sm-10">
                                            <span><?php echo($row['nama_lengkap']); ?></span>
                                        </div>
                                    </div>
                                    <div class="row mb-3 align-items-center">
                                        <label class="col-sm-2 col-form-label">Alamat:</label>
                                        <div class="col-sm-10">
                                            <span><?php echo($row['lokasi_tujuan']); ?></span>
                                        </div>
                                    </div>
                                    <div class="row mb-3 align-items-center">
                                        <label class="col-sm-2 col-form-label">Harga:</label>
                                        <div class="col-sm-10">
                                            <span><?php echo($row['harga']); ?></span>
                                        </div>
                                    </div>
                                    <div class="row mb-3 align-items-center">
                                        <label class="col-sm-2 col-form-label">Jenis Produk:</label>
                                        <div class="col-sm-10">
                                            <span><?php echo($row['jenisProduk']); ?></span>
                                        </div>
                                    </div>
                                    <div class="row mb-3 align-items-center">
                                        <label class="col-sm-2 col-form-label">Jenis Kayu:</label>
                                        <div class="col-sm-10">
                                            <span><?php echo($row['jenisKayu']); ?></span>
                                        </div>
                                    </div>
                                    <div class="row mb-3 align-items-center">
                                        <label class="col-sm-2 col-form-label">Keterangan:</label>
                                        <div class="col-sm-10">
                                            <span><?php echo($row['deskripsi']); ?></span>
                                        </div>
                                    </div>
                                    <div class="row mb-3 align-items-center">
                                        <label class="col-sm-2 col-form-label">Status:</label>
                                        <div class="col-sm-2">
                                            <select class="form-select" aria-label="Default select example" name="status">
                                                <option value="Diproses">Diproses</option>
                                                <option value="Sedang Diperjalanan">Sedang Diperjalanan</option>
                                                <option value="Selesai">Selesai</option>
                                                <option value="Ditolak">Ditolak</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col mt-3"> 
                                            <button class="btn btn-prim" name='save'>Simpan Perubahan</button>
                                            <a class="btn btn-prim" href='#'><i class="fa-brands fa-whatsapp text-success"></i> Hubungi</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php
                }
            }
        }

        public function viewDataModal($id)
        {
            $stmt = $this->db->prepare("SELECT * FROM orders WHERE customer_id = :id");

            $stmt->execute(array(":id" => $id));

            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <div class="modal fade" id="Modal<?php echo($row['id']); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <h5 class="modal-title w-100" id="exampleModalLabel">KONFIRMASI</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <div class="row">    
                                            <form method="post" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">Masukan alamat tujuan pengiriman: </label>
                                                    <textarea class="form-control" name="alamat" id="exampleFormControlTextarea1" rows="4" style="resize: none" required></textarea>
                                                </div>
                                                <div class="col-md-12 my-3 text-center">
                                                        <input type="hidden" name="id" value="<?php echo($row['id']); ?>"/>
                                                        <button class="btn btn-success" name="confirmOrder">KONFIRMASI</button>
                                                </div>
                                            </form>
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

        public function setAlamat($id, $alamat)
        {
            try {
                $stmt = $this->db->prepare("UPDATE orders SET status_pesanan = 'Menunggu Konfirmasi', lokasi_tujuan = :alamat WHERE id=:id");

                $stmt->bindparam(":id", $id);

                $stmt->bindparam(":alamat", $alamat);

                $stmt->execute();

                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();

                return false;
            }
        }

        public function setStatus($id, $status)
        {
            try {
                
                $stmt = $this->db->prepare("UPDATE orders SET status_pesanan = :statusPesanan WHERE id=:id");

                $stmt->bindparam(":id", $id);

                $stmt->bindparam(":statusPesanan", $status);

                $stmt->execute();

                header( "Location: order.php" );

                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();

                return false;
            }
        }

        public function deleteData($id)
        {
            $del = $this->db->prepare("DELETE FROM orders WHERE id=:id");

            $del->bindparam(":id", $id);

            $del->execute();

            header("Location: order.php");
        }
    }
?>