<?php

require_once __DIR__ . '/koneksi.php';

if(isset($_POST['submit'])){
    try {
        $koneksi = new Koneksi();
        $koneksi = $koneksi->getConnection();
        $nama = $_POST['nama'];
        $komentar = $_POST['komentar'];
        $email = $_POST['email'];
    
        $sql = "INSERT INTO komentar (nama, komentar, email) VALUES ('$nama', '$komentar', '$email')";
        $query = $koneksi->prepare($sql);
        $query->execute();
        if ($query) {
            echo "<script>alert('Data Berhasil Disimpan');</script>";
        } else {
            echo "<script>alert('Data Gagal Disimpan');</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Gagal terkoneksi ke database');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
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
    <div class="content">
        <div class="box-middle">
            <div class="form">
                <form action="tambah.php" method="post">
                    <table>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td><input type="text" name="nama" id="nama"></td>
                        </tr>
                        <tr>
                            <td>Komentar</td>
                            <td>:</td>
                            <td><textarea name="komentar" id="komentar" cols="30" rows="10"></textarea></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td><input type="email" name="email" id="email"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td><input type="submit" name="submit" value="Kirim"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
</body>
</html>