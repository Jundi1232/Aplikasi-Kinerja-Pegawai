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

<body>
    <div class="container">


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
            <h2 style="margin-top: 60px;"> Data Pegawai</h2>
            <div class="table-container">
                <table class="table " border="1">
                    <thead class="thead">
                        <th scope="col" class="th column-primary" data-header="Pegawai"><span>No</span></th>
                        <th scope="col" class="th">NIP</th>
                        <th scope="col" class="th">Nama</th>
                        <th scope="col" class="th">Alamat</th>
                        <th scope="col" class="th">Email</th>
                        <th scope="col" class="th">Password</th>
                        <th scope="col" class="th">Aksi</th>
                    </thead>
                    <tbody>
                        <?php

                        $halaman = 10;
                        $page = (isset($_GET["halaman"])) ? (int)$_GET["halaman"] : 1;
                        $mulai = ($page > 1) ? ($page * $halaman) - $halaman : 0;

                        //query ke database SELECT tabel mahasiswa urut berdasarkan id yang paling besar
                        $sql = mysqli_query($koneksi, "SELECT * FROM pegawai ORDER BY NIP ASC") or die(mysqli_error($koneksi));
                        $total = mysqli_num_rows($sql);
                        $pages = ceil($total / $halaman);
                        $query = mysqli_query($koneksi, "SELECT * FROM  pegawai LIMIT $mulai, $halaman") or die(mysql_error($koneksi));
                        $no = $mulai + 1;

                        //jika query diatas menghasilkan nilai > 0 maka menjalankan script di bawah if...

                        //membuat variabel $no untuk menyimpan nomor urut

                        //melakukan perulangan while dengan dari dari query $sql
                        while ($data = mysqli_fetch_assoc($query)) {
                            //menampilkan data perulangan
                            echo '
						<tr>
							<td class="td">' .   $no++ . '</td>
							<td class="td">' . $data['NIP'] . '</td>
							<td class="td">' . $data['Nama'] . '</td>
							<td class="td">' . $data['Jabatan'] . '</td>
							<td class="td">' . $data['alamat'] . '</td>
                            <td class="td">' . $data['email'] . '</td>
							<td class="td">
                              <table >
                              <thead>
                                 <th><div class="edit"><a href="tambah_pegawai.php?NIP=' . $data['NIP'] . '" >Edit</a></div></th>
								 <th><div class="hapus"><a href="delete_pegawai.php?NIP=' . $data['NIP'] . '"  onclick="return confirm(\'Yakin ingin menghapus data ini?\')">Delete</a> </div></th>
							</table>
                                </td>
						</tr>
						';
                        }
                        //jika query menghasilkan nilai 0


                        ?>
                    </tbody>
                </table>


            </div>
            <div class="page">
                <?php for ($i = 1; $i <= $pages; $i++) { ?>
                    <a href="?halaman=<?php echo $i; ?>" style="margin-top: 220px; position:relative;"><?php echo $i; ?></a>

                <?php } ?>
            </div>



            <div class="link-name">
                <button onclick="add()" style="background-color: #033165; border:0; color:whitesmoke;">Tambah Data</button> &nbsp;&nbsp;
            </div>
            <!-- Form data -->
            <div id="formdata" class="data">
                <center>
                    <h1 style="">Form Data Pegawai</h1>
                </center>
                <?php

                ?>

                <table class="form">
                    <Form action="tambah_pegawai.php" method="post">
                        <tr class="tr">
                            <td><label>NIP</label></td>
                            <td>:</td>
                            <td><input type="text" name="Nip" style="width:400px" require></td>
                        </tr>
                        <tr style="margin-top: 20px;">
                            <td width="250"><label>Nama</label></td>
                            <td>:</td>
                            <td><input type="text" name="nama" style="width:400px" require></td>
                        </tr>
                        <tr class="tr">
                            <td width="250"><label>Jenis Kelamin</label></td>
                            <td>:</td>
                            <td>
                                <input type="radio" name="gender" value="Laki-laki" require> Laki-laki
                                <input type="radio" name="gender" value="Perempuan" require> Perempuan
                            </td>
                        </tr>
                        <tr>
                            <td width="250"><label>Alamat</label></td>
                            <td>:</td>
                            <td><textarea name="alamat" style="width:300px; height:100px" require> </textarea></td>
                        </tr>
                        <tr>
                            <td width="250"><label>Email</label></td>
                            <td>:</td>
                            <td><input type="text" name="email" style="width:400px" require></td>
                        </tr>
                        <tr>
                            <td width="250"><label>Foto</label></td>
                            <td>:</td>
                            <td class="foto"><input type="file" name="foto" style="margin-top: 15px;" require></td>
                        </tr>
                        <tr>
                            <td width="250"></td>
                            <td></td>
                            <td class="submit"><input type="submit" name="submit" style="background-color:#033165 ; color:whitesmoke; font-size: 20px; border: 0;" value="Simpan" require></td>
                        </tr>
                    </Form>
                </table>
            </div>
        </div>
    </div>
    <script>
        function add() {
            rumah = document.querySelector('#formdata');
            rumah.classList.remove('malam');
            rumah.classList.add('siang');

        }
    </script>
</body>

</html>