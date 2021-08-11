<?php
include("enc_header.php");
?>
<h1>Halaman Dosen</h1>
Selamat datang di Halaman Dosen
<?php
include("enc_footer.php");
?>

<?php
if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = '';
}

if ($op == 'delete') {
    $id = $_GET['id'];
    $sql_dosen1 = "delete from dosen where id = '$id'";
    $q_dosen1 = mysqli_query($koneksi, $sql_dosen1);
    if ($q_dosen1) {
        $sukses = "Berhasil hapus data";
    } else {
        $error = "Gagal melakukan delete data";
    }
}



if ($op == 'edit') {
    $id = $_GET['id'];
    $sql_dosen1 = "select * from dosen where id = '$id'";
    $q_dosen1 = mysqli_query($koneksi, $sql_dosen1);
    $r1_dosen = mysqli_fetch_array($q_dosen1);
    $nind = $r1_dosen['nind'];
    $nama_dosen = $r1_dosen['nama_dosen'];
    $alamat_dosen = $r1_dosen['alamat_dosen'];
    $jenkel_dosen = $r1_dosen['jenkel_dosen'];

    if ($nind == '') {
        $error = "Data tidak ditemukan";
    }
}


//Untuk Create
if (isset($_POST['simpan'])) {
    $nind = $_POST['nind'];
    $nama_dosen = $_POST['nama_dosen'];
    $alamat_dosen = $_POST['alamat_dosen'];
    $jenkel_dosen = $_POST['jenkel_dosen'];

    if ($nind && $nama_dosen && $alamat_dosen && $jenkel_dosen) {

        if ($op == 'edit') { //untuk update
            $sql_dosen1 = "update dosen set nind = '$nind',nama_dosen='$nama_dosen',alamat_dosen = '$alamat_dosen',jenkel_dosen='$jenkel_dosen' where id = '$id'";
            $q_dosen1 = mysqli_query($koneksi, $sql_dosen1);
            if ($q_dosen1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error = "Data gagal diupdate";
            }
        } else { // insert
            $sql_dosen1 = "insert into dosen(nind,nama_dosen,alamat_dosen,jenkel_dosen) values('$nind','$nama_dosen', '$alamat_dosen','$jenkel_dosen')";
            $q_dosen1 = mysqli_query($koneksi, $sql_dosen1);

            if ($q_dosen1) {
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
            width: 600px;
            width: 600px;
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
                        <label for="nind" class="col-sm-2 col-form-label">NIND</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nind" name="nind" value="<?php echo $nind ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_dosen" class="col-sm-2 col-form-label">Nama dosen</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_dosen" name="nama_dosen" value="<?php echo $nama_dosen ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat_dosen" class="col-sm-2 col-form-label">Alamat Dosen</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="alamat_dosen" name="alamat_dosen" value="<?php echo $alamat_dosen ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jenkel_dosen" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <select class="form-control" name='jenkel_dosen' id="jenkel_dosen">
                                <option value="">-Pilih Jenis Kelamin-</option>
                                <option value="L" <?php if ($jenkel_dosen == 'Laki-laki') echo "selected" ?>> Laki-laki</option>
                                <option value="P" <?php if ($jenkel_dosen == 'Perempuan') echo "selected" ?>> Perempuan</option>
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
                Data dosen
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"> No</th>
                            <th scope="col"> NIND</th>
                            <th scope="col"> Nama Dosen</th>
                            <th scope="col"> Alamat Dosen</th>
                            <th scope="col"> Jenis kelamin</th>
                            <th scope="col"> Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $sql_dosen2  = "select * from dosen order by id desc";
                        $q_dosen2     = mysqli_query($koneksi, $sql_dosen2);
                        $urut   = 1;
                        while ($r2_dosen = mysqli_fetch_array($q_dosen2)) {
                            $id         = $r2_dosen['id'];
                            $nind        = $r2_dosen['nind'];
                            $nama_dosen       = $r2_dosen['nama_dosen'];
                            $alamat_dosen     = $r2_dosen['alamat_dosen'];
                            $jenkel_dosen   = $r2_dosen['jenkel_dosen'];

                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $nind ?></td>
                                <td scope="row"><?php echo $nama_dosen ?></td>
                                <td scope="row"><?php echo $alamat_dosen ?></td>
                                <td scope="row"><?php echo $jenkel_dosen ?></td>
                                <td scope="row">
                                    <a href="admin_dosen.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>

                                    <a href="admin_dosen.php?op=delete&id=<?php echo $id ?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>
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