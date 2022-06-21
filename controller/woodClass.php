<?php
class wood{
    private $db;

    public function __construct($con)
    {
        $this->db = $con;
    }

    public function insertData($nama)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO jenis_kayu(nama_jenis) VALUES(:nama)");

            $stmt->bindparam(":nama", $nama);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();

            return false;
        }
    }

    public function viewData()
    {
        $stmt = $this->db->prepare("SELECT * FROM jenis_kayu");

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>

                <tr id='<?php echo($row['id']); ?>'>

                    <td><?php echo($row['id']); ?></td>

                    <td><?php echo($row['nama_jenis']); ?></td>

                    <td align="center">
                        <a type="button" class="btn btn-danger btn-sm" onClick="javascript: return confirm('Apakah anda yakin ingin menghapus?');" href="deleteWood.php?id=<?php echo($row['id']); ?>">HAPUS</a>
                    </td>

                </tr>

            <?php
            }
        } else {
            ?>

            <tr>

                <td>Data tidak ditemukan...</td>

            </tr>

        <?php
        }
    }
    public function viewDataSelect()
    {
        $stmt = $this->db->prepare("SELECT * FROM jenis_kayu");

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
    public function deleteData($id)
    {
        $item = $this->db->prepare("SELECT * FROM products WHERE jenis_kayu_id = $id");

        $item->bindparam(":id", $id);

        $item->execute();

        if ($item->rowCount() == 0) {
            $service = $this->db->prepare("SELECT * FROM services WHERE jenis_kayu_id = $id");

            $service->bindparam(":id", $id);

            $service->execute();

            if ($service->rowCount() == 0) {

                $stmt = $this->db->prepare("DELETE FROM jenis_kayu WHERE id=:id");

                $stmt->bindparam(":id", $id);

                $stmt->execute(); 
                header("Location: wood.php");
            }
            else{
                echo "<script type='text/javascript'>alert('Data sedang digunakan di proses lain'); location.href = 'wood.php'</script>";
                // header("Location: index.php");
            }
        }
        else{
            echo "<script type='text/javascript'>alert('Data sedang digunakan di proses lain'); location.href = 'wood.php'</script>";
            // header("Location: index.php");
        }
    }
}
?>