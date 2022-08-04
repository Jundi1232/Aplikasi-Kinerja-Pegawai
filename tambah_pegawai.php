<?php
include 'koneksi.php';


if (isset($_POST['submit'])) {
    $Nip    = $_POST['Nip'];
    $Nama   = $_POST['nama'];
    $gender    = $_POST['gender'];
    $jabatan   = $_POST['jabatan'];
    $alamat   = $_POST['alamat'];
    $email   = $_POST['email'];
    $ekstensi_diperbolehkan    = array('png', 'jpg', 'jpeg');
    $foto = $_FILES['file']['name'];

    $x = explode('.', $foto);
    $foto_baru =  round(microtime(true)) . '.' . end($x);
    $ekstensi = strtolower(end($x));
    $ukuran    = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];

    $cek = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE NIP='$Nip'") or die(mysqli_error($koneksi));

    if (mysqli_num_rows($cek) == 0) {
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            if ($ukuran < 1044070) {
                move_uploaded_file($file_tmp, 'foto/' . $foto_baru);
                $sql = mysqli_query($koneksi, "INSERT INTO pegawai(NIP , Nama, gender, Jabatan, alamat ,email, foto) VALUES('$Nip', '$Nama', '$gender','$jabatan', '$alamat', '$email', '$foto_baru')") or die(mysqli_error($koneksi));

                if ($sql) {
                    echo '<script>alert("Berhasil menambahkan data."); document.location="home_admin.php";</script>';
                } else {
                    echo '<div class="alert alert-warning">Gagal melakukan proses tambah data.</div>';
                }
            }
        } else {
            echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
        }
    } else {
        echo '<div class="alert alert-warning">Gagal, NIM sudah terdaftar.</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assert/style.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <title>Document</title>
</head>

<body>
    <input type="checkbox" id="check">
    <label for="check">
        <i class='bx bx-menu' id="btn"></i>
        <i class='bx bxs-x-square' id="cancel"></i>
    </label>

    <div class="sidebar">
        <header>
            <Img src=""></Img> My Admin
        </header>
        <ul>
            <li>
                <a href="#">
                    <i class="bx bxs-home"></i>
                    <Span class="link-name">Home</Span>
                </a>
            </li>
            <li>
                <a href="#"><i class='bx bxs-group'></i>
                    <span class="link-name"> Data Pegawai</span>
                </a>
            </li>
            <li>
                <a href="#"><i class='bx bxs-book'></i></i>
                    <span class="link-name">Daftar Kehadiran</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="main-content">
        <div class="header">

        </div>
        <center>
            <div id="formdata" class="addform">

                <h1 style="">Form Data Pegawai</h1>


                <table class="form">
                    <Form action="tambah_pegawai.php" method="post" enctype="multipart/form-data">
                        <tr>
                            <td><label>NIP</label></td>
                            <td>:</td>
                            <td><input type="text" name="Nip" class="input" require></td>
                        </tr>
                        <tr>
                            <td><label>Nama</label></td>
                            <td>:</td>
                            <td><input type="text" name="nama" class="input" require></td>
                        </tr>
                        <tr>
                            <td><label>Jenis Kelamin</label></td>
                            <td>:</td>
                            <td>
                                <input type="radio" name="gender" value="Laki-laki" require> Laki-laki
                                <input type="radio" name="gender" value="Perempuan" require> Perempuan
                            </td>
                        </tr>
                        <tr>
                            <td><label>Jabatan</label></td>
                            <td>:</td>
                            <td><select name="jabatan" class="input">
                                    <option value="" selected>--Pilih Jabatan--</option>
                                    <option value="Keamanan">1. Keamanan </option>
                                    <option value="Kebersihan">2. Kebersihan</option>
                                    <option value="Staf">3. Staf</option>
                                    <option value="Admin">4. Admin</option>
                                    <option value="Kepala bagian">5. Kepala bagian</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Alamat</label></td>
                            <td>:</td>
                            <td><textarea name="alamat" class="txarea" require> </textarea></td>
                        </tr>
                        <tr>
                            <td><label>Email</label></td>
                            <td>:</td>
                            <td><input type="text" name="email" class="input" require></td>
                        </tr>
                        <tr>
                            <td><label>Foto</label></td>
                            <td>:</td>
                            <td class="foto"><input type="file" name="file" class="input" style="margin-top: 15px;" require></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td class="submit"><input type="submit" name="submit" style="background-color:#033165 ; color:whitesmoke; font-size: 20px; border: 0;" value="Simpan" require></td>
                        </tr>
                    </Form>
                </table>

            </div>
        </center>
    </div>
</body>

</html>