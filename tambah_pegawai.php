<?php
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $Nip    = $_POST['Nip'];
    $Nama   = $_POST['nama'];
    $gender    = $_POST['gender'];
    $alamat   = $_POST['alamat'];
    $email   = $_POST['email'];

    $cek = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE NIP='$Nip'") or die(mysqli_error($koneksi));

    if (mysqli_num_rows($cek) == 0) {
        $sql = mysqli_query($koneksi, "INSERT INTO pegawai(NIP , Nama, gender, alamat ,email) VALUES('$Nip', '$Nama', '$gender', '$alamat', '$email')") or die(mysqli_error($koneksi));

        if ($sql) {
            echo '<script>alert("Berhasil menambahkan data."); document.location="home_admin.php";</script>';
        } else {
            echo '<div class="alert alert-warning">Gagal melakukan proses tambah data.</div>';
        }
    } else {
        echo '<div class="alert alert-warning">Gagal, NIM sudah terdaftar.</div>';
    }
}
