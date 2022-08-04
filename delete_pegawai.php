<?php
//include file config.php
include('koneksi.php');

//jika benar mendapatkan GET id dari URL

//membuat variabel $id yang menyimpan nilai dari $_GET['id']
$Nip = $_GET['NIP'];


//melakukan query ke database, dengan cara SELECT data yang memiliki id yang sama dengan variabel $id
$cek = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE NIP='$Nip'") or die(mysqli_error($koneksi));
// Mengubah data yang diambil menjadi Array
$foto_lama = mysqli_fetch_array($cek);

// Menghapus Foto lama didalam folder FOTO
if ($foto_lama['foto' != ""]) {
    unlink("foto/" . $foto_lama['foto']);
    //jika query menghasilkan nilai > 0 maka eksekusi script di bawah
    if (mysqli_num_rows($cek) > 0) {
        //query ke database DELETE untuk menghapus data dengan kondisi id=$id
        $del = mysqli_query($koneksi, "DELETE FROM pegawai WHERE NIP='$Nip'") or die(mysqli_error($koneksi));
        if ($del) {
            echo '<script>alert("Berhasil menghapus data."); document.location="home_admin.php";</script>';
        } else {
            echo '<script>alert("Gagal menghapus data."); document.location="home_admin.php";</script>';
        }
    } else {
        echo '<script>alert("ID tidak ditemukan di database."); document.location="home_admin.php";</script>';
    }
} else {
    if (mysqli_num_rows($cek) > 0) {
        //query ke database DELETE untuk menghapus data dengan kondisi id=$id
        $del = mysqli_query($koneksi, "DELETE FROM pegawai WHERE NIP='$Nip'") or die(mysqli_error($koneksi));
        if ($del) {
            echo '<script>alert("Berhasil menghapus data."); document.location="home_admin.php";</script>';
        } else {
            echo '<script>alert("Gagal menghapus data."); document.location="home_admin.php";</script>';
        }
    } else {
        echo '<script>alert("ID tidak ditemukan di database."); document.location="home_admin.php";</script>';
    }
}
