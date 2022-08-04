<!DOCTYPE html>
<?php
include 'koneksi.php';
session_start();
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
                    <th scope="col" class="th">Jabatan</th>
                    <th scope="col" class="th">Alamat</th>
                    <th scope="col" class="th">Email</th>
                    <th scope="col" class="th">Foto</th>
                    <th scope="col" class="th">Aksi</th>
                </thead>
                <tbody>
                    <?php

                    $halaman = 5;
                    $page = (isset($_GET["halaman"])) ? (int)$_GET["halaman"] : 1;
                    $mulai = ($page > 1) ? ($page * $halaman) - $halaman : 0;

                    //query ke database SELECT tabel mahasiswa urut berdasarkan id yang paling besar
                    $sql = mysqli_query($koneksi, "SELECT * FROM pegawai ORDER BY NIP ASC") or die(mysqli_error($koneksi));
                    $total = mysqli_num_rows($sql);
                    $pages = ceil($total / $halaman);
                    $query = mysqli_query($koneksi, "SELECT * FROM  pegawai LIMIT $mulai, $halaman") or die(mysqli_error($koneksi));
                    $no = $mulai + 1;

                    //jika query diatas menghasilkan nilai > 0 maka menjalankan script di bawah if...

                    //membuat variabel $no untuk menyimpan nomor urut

                    //melakukan perulangan while dengan dari dari query $sql
                    while ($data = mysqli_fetch_assoc($query)) {
                        //menampilkan data perulangan
                    ?>
                        <tr>
                            <td class="td"><?php echo   $no++ ?></td>
                            <td class="td"><?php echo $data['NIP'] ?></td>
                            <td class="td"><?php echo $data['Nama'] ?></td>
                            <td class="td"><?php echo $data['Jabatan'] ?></td>
                            <td class="td"><?php echo $data['alamat'] ?></td>
                            <td class="td"><?php echo $data['email'] ?></td>
                            <td class="td">
                                <?php
                                if ($data['foto'] == "") { ?>
                                    <img src="https://via.placeholder.com/500x500.png?text=PAS+FOTO+SISWA" class="foto">
                                <?php } else { ?>
                                    <img src="foto/<?php echo $data['foto']; ?>" class="foto">
                                <?php } ?>
                            </td>
                            <td class="td">
                                <table>
                                    <thead>
                                        <th>
                                            <div class="edit"><a href="edit_pegawai.php?NIP=<?php echo  $data['NIP'] ?>">Edit</a></div>
                                        </th>
                                        <th>
                                            <div class="hapus"><a href="delete_pegawai.php?NIP=<?php echo  $data['NIP'] ?>" onclick="return confirm(\'Yakin ingin menghapus data ini?\')">Delete</a> </div>
                                        </th>
                                </table>
                            </td>
                        </tr>
                    <?php } ?>


                </tbody>
            </table>


        </div>
        <div class="page">
            <?php for ($i = 1; $i <= $pages; $i++) { ?>
                <a href="?halaman=<?php echo $i; ?>" style="margin-top: 220px; position:relative;"><?php echo $i; ?></a>

            <?php } ?>
        </div>



        <div class="link-name">
            <a href="tambah_pegawai.php">Tambah Data</a>
        </div>
        <!-- Form data -->

    </div>


</body>

</html>