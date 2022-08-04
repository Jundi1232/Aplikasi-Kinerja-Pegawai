<?php
include 'koneksi.php';

if (isset($_GET['NIP'])) {
    //membuat variabel $id untuk menyimpan id dari GET id di URL
    $Nip = $_GET['NIP'];

    //query ke database SELECT tabel mahasiswa berdasarkan id = $id
    $select = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE NIP='$Nip'") or die(mysqli_error($koneksi));

    //jika hasil query = 0 maka muncul pesan error
    if (mysqli_num_rows($select) == 0) {

        //jika hasil query > 0
    } else {
        //membuat variabel $data dan menyimpan data row dari query
        $data = mysqli_fetch_assoc($select);
    }
}


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
    $foto_baru = round(microtime(true)) . '.' . end($x);
    $ekstensi = strtolower(end($x));
    $ukuran    = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];


    $cek = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE NIP='$Nip'") or die(mysqli_error($koneksi));
    $foto_lama = mysqli_fetch_array($cek);
    if ($foto_lama['foto'] != "") {
        unlink("foto/" . $foto_lama['foto']);
    }
    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
        if ($ukuran < 1044070) {

            move_uploaded_file($file_tmp, 'foto/' . $foto_baru);
            $sql = mysqli_query($koneksi, "UPDATE pegawai  SET Nama='$Nama', gender='$gender', jabatan='$jabatan',alamat='$alamat', email='email', foto='$foto_baru' where NIP='$Nip'") or die(mysqli_error($koneksi));

            if ($sql) {
                echo '<script>alert("Berhasil menambahkan data."); document.location="home_admin.php";</script>';
            } else {
                echo '<div class="alert alert-warning">Gagal melakukan proses tambah data.</div>';
            }
        }
    } else {
        echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
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
                    <Form action="edit_pegawai.php" method="post" enctype="multipart/form-data">
                        <tr class="tr">
                            <td><label>NIP</label></td>
                            <td>:</td>
                            <td><input type="text" name="Nip" class="input" value="<?php echo $data['NIP'] ?>" require></td>
                        </tr>
                        <tr style="margin-top: 20px;">
                            <td><label>Nama</label></td>
                            <td>:</td>
                            <td><input type="text" name="nama" class="input" value="<?php echo $data['Nama'] ?>" require></td>
                        </tr>
                        <tr class="tr">
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
                            <td><input type="text" name="email" class="input" value="<?php echo $data['email'] ?>" require></td>
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