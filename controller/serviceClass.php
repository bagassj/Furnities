<?php
    class service
    {
        private $db;

        public function __construct($con)
        {
            $this->db = $con;
        }
        public function viewData() 
        {
            $stmt = $this->db->prepare("SELECT services.id AS ID, nama_lengkap, nama_jenis, diameter, tinggi, harga, keterangan, status_pesanan FROM services JOIN customers ON services.customer_id = customers.id JOIN jenis_kayu ON services.jenis_kayu_id = jenis_kayu.id WHERE status_pesanan IS NOT NULL");

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <tr>

                            <td><?php echo($row['ID']); ?></td>

                            <td><?php echo($row['nama_lengkap']); ?></td>

                            <td><?php echo($row['nama_jenis']); ?></td>

                            <td><?php echo($row['diameter']); ?></td>

                            <td><?php echo($row['tinggi']); ?></td>

                            <td><?php echo($row['harga']); ?></td>

                            <td><?php echo($row['keterangan']); ?></td>

                            <td align="center">
                                <?php
                                if($row['status_pesanan'] == 'Ditolak'){
                                    ?>
                    <a href="editService.php?id=<?php echo($row['ID']); ?>"><span type="button" class="btn btn-danger btn-sm"><?php echo($row['status_pesanan']); ?></span></a><?php
                                }
                                elseif($row['status_pesanan'] == 'Baru'){
                                    ?>
                    <a href="editService.php?id=<?php echo($row['ID']); ?>"><span type="button" class="btn btn-warning text-light btn-sm"><?php echo($row['status_pesanan']); ?></span></a><?php
                                }
                                else{
                                    ?>
                    <a href="editService.php?id=<?php echo($row['ID']); ?>"><span type="button" class="btn btn-success btn-sm"><?php echo($row['status_pesanan']); ?></span></a><?php
                                }
                                ?>
                            </td>

                        </tr>
                    
                    <?php
                }
            } 
        }
        public function viewDataById($id)
        {
            $stmt = $this->db->prepare("SELECT services.id AS ID, nama_lengkap, services.alamat AS Alamat, nama_jenis, diameter, tinggi, harga, keterangan, status_pesanan FROM services JOIN customers ON services.customer_id = customers.id JOIN jenis_kayu ON services.jenis_kayu_id = jenis_kayu.id WHERE services.id= :id");

            $stmt->execute(array(":id" => $id));

            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <div class="row mb-3 align-items-center">
                            <label class="col-sm-2 col-form-label">Pemesan:</label>
                            <div class="col-sm-10">
                                <span><?php echo($row['nama_lengkap']); ?></span>
                            </div>
                        </div>
                        <div class="row mb-3 align-items-center">
                            <label class="col-sm-2 col-form-label">Alamat:</label>
                            <div class="col-sm-10">
                                <span><?php echo($row['Alamat']); ?></span>
                            </div>
                        </div>
                        <div class="row mb-3 align-items-center">
                            <label class="col-sm-2 col-form-label">Harga:</label>
                            <div class="col-sm-10">
                                <span><?php echo($row['harga']); ?></span>
                            </div>
                        </div>
                        <div class="row mb-3 align-items-center">
                            <label class="col-sm-2 col-form-label">Jenis Kayu:</label>
                            <div class="col-sm-10">
                                <span><?php echo($row['nama_jenis']); ?></span>
                            </div>
                        </div>
                        <div class="row mb-3 align-items-center">
                            <label class="col-sm-2 col-form-label">Diameter Kayu:</label>
                            <div class="col-sm-10">
                                <span><?php echo($row['diameter']); ?></span>
                            </div>
                        </div>
                        <div class="row mb-3 align-items-center">
                            <label class="col-sm-2 col-form-label">Tinggi Kayu:</label>
                            <div class="col-sm-10">
                                <span><?php echo($row['tinggi']); ?></span>
                            </div>
                        </div>
                        <div class="row mb-3 align-items-center">
                            <label class="col-sm-2 col-form-label">Keterangan:</label>
                            <div class="col-sm-10">
                                <span><?php echo($row['keterangan']); ?></span>
                            </div>
                        </div>
                        <form method="post" class="mt-5" enctype="multipart/form-data">
                            <div class="row mb-3 align-items-center">
                                <label class="col-sm-2 col-form-label">Status:</label>
                                <div class="col-sm-2">
                                    <select class="form-select" aria-label="Default select example" name="status">
                                        <option value="Diterima">Diterima</option>
                                        <option value="Selesai">Selesai</option>
                                        <option value="Ditolak">Ditolak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-center">
                                    <button class="btn btn-prim" name='save'>Simpan Perubahan</button>
                                    <a class="btn btn-prim" href='#'><i class="fa-brands fa-whatsapp text-success"></i> Hubungi</a>
                                </div>
                            </div>
                        </form>
                    <?php
                }
            } 
        }
        public function insertData($idCustomer, $alamat, $jenisKayu, $diameter, $tinggi, $harga, $keterangan, $foto, $tanggal)
        {
            try {
                $stmt = $this->db->prepare("INSERT INTO services(customer_id,alamat,jenis_kayu_id,diameter,tinggi,tanggal,harga,keterangan,foto) VALUES(:idCustomer, :alamat, :jenisKayu, :diameter, :tinggi, :tanggal, :harga, :keterangan, :foto)");

                $stmt->bindparam(":idCustomer",$idCustomer);

                $stmt->bindparam(":alamat",$alamat);

                $stmt->bindparam(":jenisKayu",$jenisKayu);

                $stmt->bindparam(":diameter",$diameter);

                $stmt->bindparam(":tinggi",$tinggi);

                $stmt->bindparam(":harga",$harga);

                $stmt->bindparam(":keterangan",$keterangan);

                $stmt->bindparam(":foto",$foto);

                $stmt->bindparam(":tanggal",$tanggal);

                $stmt->execute();
                echo "<script type='text/javascript'>alert('Pesanan berhasil ditambahkan');</script>";
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        
        public function viewDataByCust($id)
        {
            $stmt = $this->db->prepare("SELECT services.id as ID, harga, nama_jenis, tinggi, diameter, keterangan, status_pesanan FROM services JOIN jenis_kayu ON services.jenis_kayu_id = jenis_kayu.id  WHERE customer_id = :id");
            $stmt->execute(array(":id" => $id));
            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <div class="col-12 my-3">
                        <div class="card mb-3">
                            <div class="row no-gutters px-5 py-2">
                                <div class="col-md-12">
                                    <h5 class="card-title"><?php echo($row['ID']); ?></h5>
                                </div>
                                <div class="col-md-9">
                                    <div class="card-body">
                                        <span class="card-text"><b>Harga:</b> <?php echo($row['harga']); ?></span><br>
                                        <span class="card-text"><b>Jenis Kayu:</b> <?php echo($row['nama_jenis']); ?></span><br>
                                        <span class="card-text"><b>Panjang Kayu:</b> <?php echo($row['tinggi']); ?></span><br>
                                        <span class="card-text"><b>Diameter Kayu:</b> <?php echo($row['diameter']); ?></span><br>
                                        <span class="card-text"><b>Deskripsi:</b> <?php echo($row['keterangan']); ?></span><br>
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
                                        <form method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id" value="<?php echo($row['ID']); ?>"/>
                                            <a class="btn btn-danger" name="deleteOrder" onClick="javascript: return confirm('Apakah anda yakin ingin menghapus?');" href="deleteService.php?id=<?php echo($row['ID']); ?>">Hapus</a>
                                            <button class="btn btn-success" name="confirmService">Konfirmasi</button>
                                        </form>
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

        public function setStatus($id, $status)
        {
            try {
                
                $stmt = $this->db->prepare("UPDATE services SET status_pesanan = :statusPesanan WHERE id=:id");

                $stmt->bindparam(":id", $id);

                $stmt->bindparam(":statusPesanan", $status);

                $stmt->execute();

                header( "Location: service.php" );

                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();

                return false;
            }
        }

        
        public function deleteData($id)
        {
            $del = $this->db->prepare("DELETE FROM services WHERE id=:id");

            $del->bindparam(":id", $id);

            $del->execute();

            header("Location: service.php");
        }
 
    }
?>