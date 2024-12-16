<?php
// Memnaggil File dbConnection.php sebagai Global Var
include "dbConnection.php";
// Membuat Operasi Delete Data
if (isset($_GET['delete'])) {
    $nim = $_GET['delete'];
    $sql = "DELETE FROM tbl_mahasiswa WHERE nim = '$nim'";
    $connect->query($sql);
    header("Location: index.php");
    exit();
}
// Membuat Operasi Insert dan Update
$editData = null;
if (isset($_GET['edit'])) {
    $nim = $_GET['edit'];
    $result = $connect->query("SELECT * FROM tbl_mahasiswa WHERE nim = $nim");
    if ($result->num_rows > 0) {
        $editData = $result->fetch_assoc();
    }
}
// Membuat Operasi Insert dan Update
if (isset($_POST['submit'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];
    if (isset($_POST['nim']) && $_POST['nim'] != "") {
        $nim = $_POST['nim'];
        $sql = "UPDATE tbl_mahasiswa SET nama = '$nama', jurusan = '$jurusan' WHERE nim = $nim";
    } else {
        $sql = "INSERT INTO tbl_mahasiswa (nim, nama, jurusan) VALUES ('$nim', '$nama', '$jurusan')";
    }
    $connect->query($sql);
    header("Location: index.php");
    exit();
}
// Membuat Form Mahasiwa
function formMahasiswa($data = null)
{
    $id = $data ? $data['nim'] : '';
    $name = $data ? $data['nama'] : '';
    $jurusan = $data ? $data['jurusan'] : '';
    $buttonLabel = $data ? 'Edit' : 'Submit';
    echo "
<h1>Form Mahasiswa</h1>
<form  method='POST'>
<table border='1'>
<tr><td><label for='nim' >NIM</label></td>
    <td><input type='text' value='$id' name='nim' id='nim'></td></tr>
<tr><td><label for='nama'>NAMA</label></td>
    <td><input type='text' name='nama' value='$name' id='nama'></td></tr>
<tr><td><label for='jurusan'>JURUSAN</label></td>
    <td><input type='text' name='jurusan' value='$jurusan' id='jurusan'></td></tr>
<tr><td></td><td><button type='submit' name='submit'>$buttonLabel</button></td></tr>
</table>
</form>";
}
function tampilTabel($connect)
{
    echo "
    <h1>Tabel Mahasiswa</h1>
    <table border='1'>
    <tr>
    <th>No</th>
    <th>NIM</th>
    <th>NAMA</th>
    <th>JURUSAN</th>
    <th>Aksi</th>
    </tr>
    ";
    $result = $connect->query("SELECT * FROM tbl_mahasiswa");
    if ($result->num_rows > 0) {
        $no = 1;
        while ($row = $result->fetch_assoc()) {
            echo "
            <tr>
            <td>{$no}</td>
            <td>{$row['nim']}</td>
            <td>{$row['nama']}</td>
            <td>{$row['jurusan']}</td>
            <td><a href='?delete={$row['nim']}' onClick='return confirm(`Are you sure?`)'>Delete</a>
            <a href='?edit={$row['nim']}'>Edit</a></td>
            </tr>
            ";
            $no++;
        }
    } else {
        echo "0 results";
    }
    echo "</table>";
}
// Panggil Function
formMahasiswa($editData);
tampilTabel($connect);
