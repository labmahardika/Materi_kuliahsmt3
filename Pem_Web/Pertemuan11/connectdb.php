<?php
$host = "127.0.0.1";
$user = "root";
$pass = "";
$dbname = "db_crud";

$conn = mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());

}
// else {
//     echo "Koneksi berhasil";
// }


?>

