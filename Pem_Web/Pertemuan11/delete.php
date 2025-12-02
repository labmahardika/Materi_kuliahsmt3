<?php
include 'connectdb.php';

if (isset($_GET['nim'])) {
    $nim = $_GET['nim'];
    $query = "DELETE FROM mahasiswa WHERE nim='$nim'";
    if (mysqli_query($conn, $query)) {
        echo "Data berhasil dihapus.";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
header("Location: index.php");
?>
