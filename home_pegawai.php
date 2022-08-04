<!DOCTYPE html>
<?php
include 'koneksi.php';

//membuat variabel $id untuk menyimpan id dari GET id di URL
$Nip = $_GET['NIP'];

$select = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE NIP='$Nip'") or die(mysqli_error($koneksi));

//jika hasil query = 0 maka muncul pesan error
if (mysqli_num_rows($select) == 0) {

    //jika hasil query > 0
} else {
    //membuat variabel $data dan menyimpan data row dari query
    $data = mysqli_fetch_assoc($select);
}

?>


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
        <div class="header">
            <div class="name">
                <p><?php echo $data['Nama'] ?></p>
                <i class='bx bx-chevron-down hover'></i>
            </div>
        </div>
        <h2 style="margin-top: 60px; text-align:center"> Laporan Kinerja Pegawai</h2>
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

                    $halaman = 5;
                    $page = (isset($_GET["halaman"])) ? (int)$_GET["halaman"] : 1;
                    $mulai = ($page > 1) ? ($page * $halaman) - $halaman : 0;

                    //query ke database SELECT tabel mahasiswa urut berdasarkan id yang paling besar
                    $sql = mysqli_query($koneksi, "SELECT * FROM laporan_kinerja ") or die(mysqli_error($koneksi));
                    $total = mysqli_num_rows($sql);
                    $pages = ceil($total / $halaman);
                    $query = mysqli_query($koneksi, "SELECT * FROM  laporan_kinerja LIMIT $mulai, $halaman") or die(mysqli_error($koneksi));
                    $no = $mulai + 1;

                    //jika query diatas menghasilkan nilai > 0 maka menjalankan script di bawah if...

                    //membuat variabel $no untuk menyimpan nomor urut

                    //melakukan perulangan while dengan dari dari query $sql
                    while ($data = mysqli_fetch_assoc($query)) {
                        //menampilkan data perulangan
                    ?>
                        <tr>
                            <td class="td"><?php echo   $no++ ?></td>
                            <td class="td"><?php echo $data['tempat'] ?></td>
                            <td class="td"><?php echo $data['tgl_kegiatan'] ?></td>
                            <td class="td"><?php echo $data['detail'] ?></td>
                            <td class="td"><?php echo $data['tugas_tambahan'] ?></td>
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
                                            <div class="edit"><a href="edit_laporan_kinerja.php?NIP=<?php echo  $data['NIP'] ?>">Edit</a></div>
                                        </th>
                                        <th>
                                            <div class="hapus"><a href="delete_laporan_kinerja.php?NIP=<?php echo  $data['NIP'] ?>" onclick="return confirm(\'Yakin ingin menghapus data ini?\')">Delete</a> </div>
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
            <a href="tambah_laporan.php?NIP=<?php echo  $Nip ?>"> Tambah Data </a>
        </div>
    </div>

</body>

</html>