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
        <ul class="nav">
            <li>
                <a href="">
                    <i class='bx bxs-home'></i>
                    <span class="link_name">Home</span>
                </a>
                <span class="tooltip">Home</span>
            </li>
            <li style="margin-top: 30px;">
                <a href="">
                    <i class='bx bx-file'></i>
                    <span class="link_name">Pegawai</span>
                </a>
                <span class="tooltip">Pegawai</span>
            </li>
            <li>
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
        <div class="add">
            <a href="#form">
                <div>

                    <p>Tambah Data</p>
                </div>

            </a>

        </div>


        <table class="table">
            <thead class="th">
                <th>NO</th>
                <th>NIP</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Alamat</th>
                <th>email</th>
                <th width="100px">Aksi</th>
            </thead>
            <tbody>
                <?php
                //query ke database SELECT tabel mahasiswa urut berdasarkan id yang paling besar
                $sql = mysqli_query($koneksi, "SELECT * FROM pegawai ORDER BY NIP ASC") or die(mysqli_error($koneksi));
                //jika query diatas menghasilkan nilai > 0 maka menjalankan script di bawah if...
                if (mysqli_num_rows($sql) > 0) {
                    //membuat variabel $no untuk menyimpan nomor urut
                    $no = 1;
                    //melakukan perulangan while dengan dari dari query $sql
                    while ($data = mysqli_fetch_assoc($sql)) {
                        //menampilkan data perulangan
                        echo '
						<tr>
							<td>' . $no . '</td>
							<td>' . $data['NIP'] . '</td>
							<td>' . $data['Nama'] . '</td>
							<td>' . $data['Jabatan'] . '</td>
							<td>' . $data['alamat'] . '</td>
                            <td>' . $data['email'] . '</td>
							<td >
                              <table >
                              <thead>
                                 <th><div class="edit"><a href="tambah_mahasiswa.php?NIP=' . $data['NIP'] . '" >Edit</a></div></th>
								 <th><div class="hapus"><a href="delete_mahasiswa.php?NIP=' . $data['NIP'] . '"  onclick="return confirm(\'Yakin ingin menghapus data ini?\')">Delete</a> </div></th>
							</table>
                                </td>
						</tr>
						';
                        $no++;
                    }
                    //jika query menghasilkan nilai 0
                } else {
                    echo '
					<tr>
						<td>Tidak ada data.</td>
					</tr>
					';
                }
                ?>
            </tbody>
        </table>

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