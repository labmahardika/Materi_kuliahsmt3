<?php
include 'connectdb.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="card">
    <h1>Tambah Data Mahasiswa</h1>
    <form action="insert.php" method="POST" class="form">
        <label for="nama">Nama:</label><br>
        <input type="text" id="nama" name="nama" required><br><br>
        <label for="nim">NIM:</label><br>
        <input type="text" id="nim" name="nim" required><br><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <input type="submit" value="Simpan">
    </form>
    <br>
    <a href="index.php">Kembali ke Data Mahasiswa</a>
    </div>
</body>
</html>


