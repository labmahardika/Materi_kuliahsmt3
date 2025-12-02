<?php
include 'connectdb.php';
$nim = $_GET['nim'];
$result = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nim='$nim'");
$row = mysqli_fetch_assoc($result);
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];

    $query = "UPDATE mahasiswa SET nama='$nama', email='$email' WHERE nim='$nim'";
    if (mysqli_query($conn, $query)) {
        echo "Data berhasil diupdate.";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
    header("Location: index.php");
}   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Edit Data Mahasiswa</h1>
    <form action="" method="POST" class="form">
        <label for="nim">NIM:</label><br>
        <input type="text" id="nim" name="nim" value="<?php echo $row['nim']; ?>"  readonly><br><br>
        <label for="nama">Nama:</label><br>
        <input type="text" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required><br><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" width="30"  name="email" value="<?php echo $row['email']; ?>" required><br><br>
        <input type="submit" name="submit" value="Update">
    </form>
    <br>
    <a href="index.php">Kembali ke Data Mahasiswa</a>
</body>
</html>
