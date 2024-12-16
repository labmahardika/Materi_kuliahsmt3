<?php
// Membuat Form Mahasiwa
function formMahasiswa()
{
    echo "
<h1>Form Mahasiswa</h1>
<form  method='POST'>
<table border='1'>
<tr><td><label for='nim'>NIM</label></td>
    <td><input type='text' name='nim' id='nim'></td></tr>
<tr><td><label for='nama'>NAMA</label></td>
    <td><input type='text' name='nama' id='nama'></td></tr>
<tr><td><label for='jurusan'>JURUSAN</label></td>
    <td><input type='text' name='jurusan' id='jurusan'></td></tr>
<tr><td><input type='submit' value='Submit'></td>
</table>";
}
