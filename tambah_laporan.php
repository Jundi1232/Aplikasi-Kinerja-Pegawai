<?php
include 'koneksi.php';



$Nip = $_GET['NIP'];

if (isset($_POST['submit'])) {
    $tempat    = $_POST['tempat'];
    $tugas    = $_POST['tugas'];
    $rinci   = $_POST['rinci'];
    $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
    $foto = $_FILES['file']['name'];

    $x = explode('.', $foto);
    $foto_baru =  round(microtime(true)) . '.' . end($x);
    $ekstensi = strtolower(end($x));
    $ukuran    = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];

    $cek = mysqli_query($koneksi, "SELECT * FROM laporan_kinerja ") or die(mysqli_error($koneksi));


    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
        if ($ukuran < 1044070) {

            $sql = mysqli_query($koneksi, "INSERT INTO laporan_kinerja(NIP,tempat, detail, tugas_tambahan, foto) VALUES('$Nip', '$tempat','$tugas', '$rinci', '$foto_baru')") or die(mysqli_error($koneksi));

            if ($sql) {
                move_uploaded_file($file_tmp, 'foto/' . $foto_baru);
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
                <h1>Form Laporan Kinerja</h1>
                <table class="form">
                    <Form action="tambah_laporan.php?NIP=<?php echo  $Nip ?>" method="post" enctype="multipart/form-data">

                        <tr>
                            <td><label>Tempat Kegiatan</label></td>
                            <td>:</td>
                            <td><input type="text" name="tempat" class="input" require style="margin: 10px ;"></td>
                        </tr>
                        <tr>
                            <td><label>Rincian Kegiatan</label></td>
                            <td>:</td>
                            <td><textarea name="rinci" class="txarea" require style="margin: 10px ;"> </textarea></td>
                        </tr>
                        <tr>
                            <td><label>Tugas Tambahan</label></td>
                            <td>:</td>
                            <td><input type="text" name="tugas" class="input" style="margin: 10px ;" require></td>
                        </tr>
                        <tr>
                            <td><label>Foto Kegiatan</label></td>
                            <td>:</td>
                            <td class="foto"><input type="file" name="file" class="input" style="margin: 10px ;" require></td>
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