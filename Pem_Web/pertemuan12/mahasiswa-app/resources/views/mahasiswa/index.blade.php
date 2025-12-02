<!DOCTYPE html>
<html>

<head>
    <title>Daftar Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">
    <h1>Daftar Mahasiswa</h1>
    <a class="btn btn-success" href="{{ route('mahasiswa.create') }}"> Tambah Mahasiswa</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Jurusan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mahasiswas as $mhs)
                <tr>
                    <td>{{ $mhs->id }}</td>
                    <td>{{ $mhs->nim }}</td>
                    <td>{{ $mhs->nama }}</td>
                    <td>{{ $mhs->jurusan }}</td>
                    <td>
                        <form action="{{ route('mahasiswa.destroy', $mhs->id) }}" method="POST">

                            <a class="btn btn-primary" href="{{ route('mahasiswa.edit', $mhs->id) }}">Edit</a>


                            @csrf
                            @method('DELETE')


                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Yakin hapus?')">Delete</button>
                        </form>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>