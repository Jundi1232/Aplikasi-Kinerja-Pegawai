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
    <input type="checkbox" id="check">
    <label for="check">
        <i class='bx bx-menu' id="btn"></i>
        <i class='bx bxs-x-square' id="cancel"></i>
    </label>
    <div class="header">

    </div>
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
                <a href="#">
                    <i class='bx bx-file'></i>
                    <span class="link-name"> Laporan kinerja</span>
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
        <h2> Laporan Kinerja Pegawai</h2>
        <div class="table-container">
            <table class="table " border="1">
                <thead class="thead">
                    <th scope="col" class="th column-primary" data-header="Pegawai"><span>No</span></th>
                    <th scope="col" class="th">Tempat Kegiatan</th>
                    <th scope="col" class="th">Tanggal Kegiatan</th>
                    <th scope="col" class="th">Rincian Kegiatan</th>
                    <th scope="col" class="th">Tugas Tambahan</th>
                    <th scope="col" class="th">Foto Kegiatan</th>
                    <th scope="col" class="th">Aksi</th>
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
							<td class="td">' . $no . '</td>
							<td class="td">' . $data['NIP'] . '</td>
							<td class="td">' . $data['Nama'] . '</td>
							<td class="td">' . $data['Jabatan'] . '</td>
							<td class="td">' . $data['alamat'] . '</td>
                            <td class="td">' . $data['email'] . '</td>
							<td class="td">
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

        <div class="link-name">
            <button onclick="add()" style="background-color: #033165; border:0; color:whitesmoke;">Tambah Data</button> &nbsp;&nbsp;
        </div>
        <!-- Form data -->
        <div id="formdata" class="data">
            <center>
                <h1>Form Laporan Kinerja</h1>
            </center>
            <table class="form">
                <Form action="tambah_pegawai.php" method="post">
                    <tr class="tr">
                        <td><label>Tempat Kegiatan</label></td>
                        <td>:</td>
                        <td><input type="text" name="tempat" style="width:400px" require></td>
                    </tr>
                    <tr style="margin-top: 20px;">
                        <td><label>Tanggal Kegiatan</label></td>
                        <td>:</td>
                        <td><input type="date" name="tgl" style="width:400px" require></td>
                    </tr>
                    <tr>
                        <td width="250"><label>Rincian Kegiatan</label></td>
                        <td>:</td>
                        <td><textarea name="rinci" style="width:300px; height:100px" require> </textarea></td>
                    </tr>
                    <tr>
                        <td width="250"><label>Tugas Tambahan</label></td>
                        <td>:</td>
                        <td><input type="text" name="tugas" style="width:400px" require></td>
                    </tr>
                    <tr>
                        <td width="250"><label>Foto Kegiatan</label></td>
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
    <script>
        function add() {
            rumah = document.querySelector('#formdata');
            rumah.classList.remove('malam');
            rumah.classList.add('siang');

            document.location = "#form";
        }
    </script>
</body>

</html>