<!DOCTYPE html>
<?php
include 'koneksi.php';
?>
<html>

<head>
    <title>Halaman admin - www.malasngoding.com</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assert/style.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
</head>

<body class="bg_side">
    <?php
    session_start();
    // cek apakah yang mengakses halaman ini sudah login
    if ($_SESSION['level'] == "") {
        header("location:index.php?pesan=gagal");
    }
    ?>
    <!-- header -->
    <div class="header">
        <i class='bx bx-menu' id='btn'></i>
    </div>

    <!-- sidebar -->
    <div class="sidebar">
        <div class="logo_content">
            <div class="logo">
                <!-- icon logo -->
                <div class="logo_name"> Hello </div>
            </div>

        </div>
        <div class="src">
            <!-- icon src -->
            <hr color="white">
        </div>
        <ul class="nav" style="z-index: 2;">
            <li style="z-index: 2;">
                <a href="">
                    <i class='bx bxs-home'></i>
                    <span class="link_name">Home</span>
                </a>
                <span class="tooltip">Home</span>
            </li style="z-index: 2;">
            <li style="margin-top: 30px;">
                <a href="">
                    <i class='bx bx-file'></i>
                    <span class="link_name">Pegawai</span>
                </a>
                <span class="tooltip">Pegawai</span>
            </li style="z-index: 2;">
            <li style="z-index: 2;">
                <a href="">
                    <i class='bx bx-user-circle'></i>
                    <span class="link_name">Profile</span>
                </a>
                <span class="tooltip ">Profile</span>
            </li>
        </ul>
    </div>

    <!-- Main -->
    <div class="home_content">
        <div class="text">Data Pegawai </div>
        <center>
            <table class="table-form">
                <Form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <tr>
                        <td width="150px"><label>Tanggal Kegiatan</label></td>
                        <td>:</td>
                        <td><input type="date" name="tgl" require></td>
                    </tr>
                    <tr>
                        <td width="150"><label>Tempat Kegiatan</label></td>
                        <td>:</td>
                        <td><input type="text" name="tempat" style="width:300px" require></td>
                    </tr>
                    <tr>
                        <td width="150"><label>Rincian Kegiatan</label></td>
                        <td>:</td>
                        <td><textarea name="detail" style="width:300px; height:100px" require> </textarea></td>
                    </tr>
                    <tr>
                        <td width="150"><label>Tugas Tambahan</label> </td>
                        <td>:</td>
                        <td><textarea name="tambahan" style="width:300px; height:100px" require> </textarea></td>
                    </tr>
                </Form>
            </table>
        </center>
    </div>
    <script>
        let btn = document.querySelector('#btn')
        let sidebar = document.querySelector('.sidebar')
        let header = document.querySelector('.header')
        let main = document.querySelector('.home_content')
        let form = document.querySelector('.form_content')
        btn.onclick = function() {
            sidebar.classList.toggle('active');
            header.classList.toggle('active');
            main.classList.toggle('active');
        }
    </script>
</body>

</html>