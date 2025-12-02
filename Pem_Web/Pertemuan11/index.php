<?php
include 'connectdb.php';

$result = mysqli_query($conn, "SELECT * FROM mahasiswa");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1 class="judul">Data Mahasiswa</h1>
    <table class ="table-bordered">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
        <?php
        $no=1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . $row['nama'] . "</td>";
            echo "<td>" . $row['nim'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td><a href='edit.php?nim=" . $row['nim'] . "'>✏️</a> | <a href='delete.php?nim=" . $row['nim'] . "' onclick=\"return confirm('Yakin ingin menghapus data ini?')\">🗑️</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
    <br>
    <a href="add.php">➕ Tambah Data Mahasiswa</a>
