<?php
include 'connectdb.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $email = $_POST['email'];

    $query = "INSERT INTO mahasiswa (nama, nim, email) VALUES ('$nama', '$nim', '$email')";
    if (mysqli_query($conn, $query)) {
        echo "Data berhasil ditambahkan.";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
header("Location: index.php");
?>
