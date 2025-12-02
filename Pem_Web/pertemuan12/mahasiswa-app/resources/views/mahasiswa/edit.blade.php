<!DOCTYPE html>
<html>

<head>
    <title>Tambah Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">
    <h2>Tambah Mahasiswa</h2>
    <a class="btn btn-secondary mb-3" href="{{ route('mahasiswa.index') }}">Kembali</a>


    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>NIM:</label>
            <input type="text" name="nim" class="form-control" placeholder="NIM" value="{{ $mahasiswa->nim }}">
        </div>
        <div class="mb-3">
            <label>Nama:</label>
            <input type="text" name="nama" class="form-control" placeholder="Nama" value="{{ $mahasiswa->nama }}">
        </div>
        <div class="mb-3">
            <label>Jurusan:</label>
            <input type="text" name="jurusan" class="form-control" placeholder="Jurusan"
                value="{{ $mahasiswa->jurusan }}">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>

</html>