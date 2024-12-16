<?php
include('dbConnection.php'); // Memanggil file koneksi database

// Proses AJAX Request
if (isset($_POST['action'])) {
    $response = ["status" => "error", "message" => "Invalid action"];

    switch ($_POST['action']) {
        case 'create_or_update':
            $nim = htmlspecialchars(trim($_POST['nim']));
            $nama = htmlspecialchars(trim($_POST['nama']));
            $jurusan = htmlspecialchars(trim($_POST['jurusan']));
            $old_nim = $_POST['old_nim'] ?? null;

            if ($old_nim) {
                // Update Data
                $stmt = $connect->prepare("UPDATE tbl_mahasiswa SET nama = ?, jurusan = ? WHERE nim = ?");
                $stmt->bind_param("sss", $nama, $jurusan, $old_nim);
            } else {
                // Create Data
                $stmt = $connect->prepare("INSERT INTO tbl_mahasiswa (nim, nama, jurusan) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $nim, $nama, $jurusan);
            }

            if ($stmt->execute()) {
                $response = ["status" => "success", "message" => "Data berhasil " . ($old_nim ? "diperbarui" : "ditambahkan")];
            } else {
                $response = ["status" => "error", "message" => "Terjadi kesalahan: " . $stmt->error];
            }
            $stmt->close();
            break;

        case 'delete':
            $nim = $_POST['nim'];
            $stmt = $connect->prepare("DELETE FROM tbl_mahasiswa WHERE nim = ?");
            $stmt->bind_param("s", $nim);

            if ($stmt->execute()) {
                $response = ["status" => "success", "message" => "Data berhasil dihapus."];
            } else {
                $response = ["status" => "error", "message" => "Terjadi kesalahan: " . $stmt->error];
            }
            $stmt->close();
            break;

        case 'fetch':
            $result = $connect->query("SELECT * FROM tbl_mahasiswa");
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $response = ["status" => "success", "data" => $data];
            break;
    }

    echo json_encode($response);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Mahasiswa</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Form Mahasiswa</h1>
    <form id="mahasiswaForm">
        <input type="hidden" name="old_nim" id="old_nim">
        <table>
            <tr>
                <td>NIM</td>
                <td><input type="text" name="nim" id="nim" required></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" id="nama" required></td>
            </tr>
            <tr>
                <td>Jurusan</td>
                <td><input type="text" name="jurusan" id="jurusan" required></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit">Simpan</button></td>
            </tr>
        </table>
    </form>

    <h1>Data Mahasiswa</h1>
    <table border="1" cellspacing="0" cellpadding="5" id="mahasiswaTable">
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Jurusan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <script>
        function fetchData() {
            $.post('', { action: 'fetch' }, function(response) {
                if (response.status === 'success') {
                    let rows = '';
                    response.data.forEach((item, index) => {
                        rows += `<tr>
                            <td>${index + 1}</td>
                            <td>${item.nim}</td>
                            <td>${item.nama}</td>
                            <td>${item.jurusan}</td>
                            <td>
                                <button onclick="editData('${item.nim}', '${item.nama}', '${item.jurusan}')">Edit</button>
                                <button onclick="deleteData('${item.nim}')">Delete</button>
                            </td>
                        </tr>`;
                    });
                    $('#mahasiswaTable tbody').html(rows);
                }
            }, 'json');
        }

        function editData(nim, nama, jurusan) {
            $('#old_nim').val(nim);
            $('#nim').val(nim).prop('readonly', true);
            $('#nama').val(nama);
            $('#jurusan').val(jurusan);
        }

        function deleteData(nim) {
            if (confirm('Yakin ingin menghapus?')) {
                $.post('', { action: 'delete', nim }, function(response) {
                    alert(response.message);
                    if (response.status === 'success') fetchData();
                }, 'json');
            }
        }

        $('#mahasiswaForm').submit(function(e) {
            e.preventDefault();
            const data = $(this).serializeArray();
            data.push({ name: 'action', value: 'create_or_update' });

            $.post('', $.param(data), function(response) {
                alert(response.message);
                if (response.status === 'success') {
                    $('#mahasiswaForm')[0].reset();
                    $('#nim').prop('readonly', false);
                    fetchData();
                }
            }, 'json');
        });

        $(document).ready(fetchData);
    </script>
</body>
</html>
