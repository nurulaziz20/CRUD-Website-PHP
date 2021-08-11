<?php
include("enc_header.php");
?>
<h1>Halaman Mahasiswa</h1>
Selamat datang di Halaman Mahasiswa
<?php
include("enc_footer.php");
?>

<?php
if (isset($_GET['op'])) {
$op = $_GET['op'];
} else {
$op = '';
}

if($op == 'delete'){
$id = $_GET['id'];
$sql1 = "delete from mahasiswa where id = '$id'";
$q1 = mysqli_query($koneksi,$sql1);
if($q1){
$sukses = "Berhasil hapus data";
}else{
$error = "Gagal melakukan delete data";
}
}



if ($op == 'edit') {
$id = $_GET['id'];
$sql1 = "select * from mahasiswa where id = '$id'";
$q1 = mysqli_query($koneksi, $sql1);
$r1 = mysqli_fetch_array($q1);
$nim = $r1['nim'];
$nama = $r1['nama'];
$alamat = $r1['alamat'];
$jurusan = $r1['jurusan'];

if ($nim == '') {
$error = "Data tidak ditemukan";
}
}


//Untuk Create
if (isset($_POST['simpan'])) {
$nim = $_POST['nim'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$jurusan = $_POST['jurusan'];

if ($nim && $nama && $alamat && $jurusan) {

if ($op == 'edit') { //untuk update
$sql1 = "update mahasiswa set nim = '$nim',nama='$nama',alamat = '$alamat',jurusan='$jurusan' where id = '$id'";
$q1 = mysqli_query($koneksi, $sql1);
if ($q1) {
$sukses = "Data berhasil diupdate";
} else {
$error = "Data gagal diupdate";
}
} else { // insert
$sql1 = "insert into mahasiswa(nim,nama,alamat,jurusan) values('$nim','$nama', '$alamat','$jurusan')";
$q1 = mysqli_query($koneksi, $sql1);

if ($q1) {
$sukses = "Berhasil memasukan data baru";
} else {
$error = "Gagal Memasukan data";
}
}
} else {
$error = 'Silakan masukan semua data';
}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dosen</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        .max-auto {
            width: 650px;
            margin: auto;
            padding: 10px;
            border-radius: 5px;
        }

        .card {
            margin-top: 10px;
        }
    </style>


</head>

<body>
    <div class="max-auto">
        <!-- Memasukan Data -->
        <div class="card">
            <div class="card-header">
                Create / Edit Data
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                }
                ?>
                <form action="" method="POST">
                    <div class="form-group row">
                        <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nim" name="nim" value="<?php echo $nim ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                        <div class="col-sm-10">
                            <select class="form-control" name='jurusan' id="Jurusan">
                                <option value="">-Pilih Jurusan-</option>
                                <option value="SI" <?php if ($jurusan == 'Sistem Informasi') echo "selected" ?>> Sistem Informasi</option>
                                <option value="TI" <?php if ($jurusan == 'Teknik Informasi') echo "selected" ?>> Teknik Informasi</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary">
                    </div>



                </form>
            </div>
        </div>
        <!-- Mengeluarkan Data-->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Data Mahasiswa
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"> No</th>
                            <th scope="col"> NIM</th>
                            <th scope="col"> Nama</th>
                            <th scope="col"> alamat</th>
                            <th scope="col"> Jurusan</th>
                            <th scope="col"> Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $sql2   = "select * from mahasiswa order by id desc";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id         = $r2['id'];
                            $nim        = $r2['nim'];
                            $nama       = $r2['nama'];
                            $alamat     = $r2['alamat'];
                            $jurusan   = $r2['jurusan'];

                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $nim ?></td>
                                <td scope="row"><?php echo $nama ?></td>
                                <td scope="row"><?php echo $alamat ?></td>
                                <td scope="row"><?php echo $jurusan ?></td>
                                <td scope="row">
                                    <a href="admin_mhs.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>

                                    <a href="admin_mhs.php?op=delete&id=<?php echo $id ?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</body>

</html>