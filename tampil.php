<?php

require_once __DIR__ . '/koneksi.php';

$koneksi = new Koneksi();
$koneksi = $koneksi->getConnection();

$query = $koneksi->prepare("SELECT * FROM komentar");
$query->execute();
$data = $query->fetchAll();
$listData = array();
if (isset($_POST["cari"])){
    foreach ($data as $key => $value) {
        if (preg_match("/" . $_POST["cari"] . "/i", $value["komentar"])) {
            $listData[] = $value;
        }
    }
} else {
    $listData = $data;
}
$limitPage = 5;
$jumlahHalaman = ceil(count($listData) / $limitPage);
$halamanAktif = (isset($_GET["page"])) ? $_GET["page"] : 1;
$awalData = ($limitPage * $halamanAktif) - $limitPage;
$listData = array_slice($listData, $awalData, $limitPage);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
    <div class="header">
        <div class="judul">
            <h1>Buku Tamu</h1>
        </div>
        <div class="box">
            <a href="home.html">Home</a>
            <a href="tambah.php">Tambah</a>
            <a href="tampil.php">Buku Tamu</a>
        </div>
    </div>
    <div class="box-middle" style="flex-direction: column;">
    <div class="form">
        <form action="tampil.php" method="post">
            <input type="text" name="cari" placeholder="Cari Nama">
            <input type="submit" value="Cari">
        </form>
    </div>
    <div class="tabel" style="font-size:20px;margin-top:5px;">
        <table border="1">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Komentar</th>
                <th>Email</th>
            </tr>
            <?php
            $no = 1;
            foreach ($listData as $key => $value) {
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $value["nama"]; ?></td>
                <td><?php echo $value["komentar"]; ?></td>
                <td><?php echo $value["email"]; ?></td>
            </tr>
            <?php
            }
            ?>
        </table>
        <div class="page">
            <?php
            for ($i = 1; $i <= $jumlahHalaman; $i++) {
                if ($i == $halamanAktif) {
                    echo "<a href='?page=$i' style='background-color: #000; color: #fff;'>" . $i . "</a>";
                } else {
                    echo "<a href='?page=$i'>" . $i . "</a>";
                }
            }
            ?>
        </div>
    </div>

</body>
</html>



