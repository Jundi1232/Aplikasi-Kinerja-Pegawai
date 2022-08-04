<?php
// mengaktifkan session pada php
session_start();
// menghubungkan php dengan koneksi database
require('koneksi.php');

// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];


// menyeleksi data user dengan username dan password yang sesuai

$login = mysqli_query($koneksi, "SELECT login.email,level,login.password,NIP 
FROM login INNER JOIN pegawai ON login.email=pegawai.email where login.email='$username' and login.password='$password'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);

// cek apakah username dan password di temukan pada database
if ($cek > 0) {

    $data = mysqli_fetch_assoc($login);

    // cek jika user login sebagai admin
    if ($data['level'] == "admin") {

        // buat session login dan username
        $_SESSION['email'] = $username;
        $_SESSION['level'] = "admin";
        // alihkan ke halaman dashboard admin
        header("location:home_admin.php");

        // cek jika user login sebagai pegawai
    } else if ($data['level'] == "pegawai") {
        // buat session login dan username
        $_SESSION['email'] = $username;
        $_SESSION['level'] = "pegawai";
        // alihkan ke halaman dashboard pegawai
        header("location:home_pegawai.php?NIP=$data[NIP]");

        // cek jika user login sebagai pengurus
    } else if ($data['level'] == "manager") {
        // buat session login dan username
        $_SESSION['email'] = $username;
        $_SESSION['level'] = "manager";
        // alihkan ke halaman dashboard pengurus
        header("location:halaman_manager.php");
    } else {

        // alihkan ke halaman login kembali
        header("location:index.php?pesan=gagal");
    }
} else {
    header("location:index.php?pesan=gagal");
}
