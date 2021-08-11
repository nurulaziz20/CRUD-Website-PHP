<?php
include("enc_header.php");
?>
<h1>Halaman Nilai</h1>
Selamat datang di Halaman Nilai
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
    $sql_nilai1 = "delete from nilai where id = '$id'";
    $q_nilai1 = mysqli_query($koneksi, $sql_nilai1);
    if ($q_nilai1) {
        $sukses = "Berhasil hapus data";
    } else {
        $error = "Gagal melakukan delete data";
    }
}



if ($op == 'edit') {
    $id = $_GET['id'];
    $sql_nilai1 = "select * from nilai where id = '$id'";
    $q_nilai1 = mysqli_query($koneksi, $sql_nilai1);
    $r_nilai1 = mysqli_fetch_array($q_nilai1);
    $nim_nilai = $r_nilai1['nim_nilai'];
    $kode_matkul_nilai = $r_nilai1['kode_matkul_nilai'];
    $semester = $r_nilai1['semester'];
    $nilai = $r_nilai1['nilai'];

    if ($nim_nilai == '') {
        $error = "Data tidak ditemukan";
    }
}


//Untuk Create
if (isset($_POST['simpan'])) {
    $nim_nilai = $_POST['nim_nilai'];
    $kode_matkul_nilai = $_POST['kode_matkul_nilai'];
    $semester = $_POST['semester'];
    $nilai = $_POST['nilai'];

    if ($nim_nilai && $kode_matkul_nilai && $semester && $nilai) {

        if ($op == 'edit') { //untuk update
            $sql_nilai1 = "update nilai set nim_nilai = '$nim_nilai',kode_matkul_nilai='$kode_matkul_nilai',semester = '$semester',nilai='$nilai' where id = '$id'";
            $q_nilai1 = mysqli_query($koneksi, $sql_nilai1);
            if ($q_nilai1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error = "Data gagal diupdate";
            }
        } else { // insert
            $sql_nilai1 = "insert into nilai(nim_nilai,kode_matkul_nilai,semester,nilai) values('$nim_nilai','$kode_matkul_nilai', '$semester','$nilai')";
            $q_nilai1 = mysqli_query($koneksi, $sql_nilai1);

            if ($q_nilai1) {
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
                        <label for="nim_nilai" class="col-sm-2 col-form-label">NIM</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nim_nilai" name="nim_nilai" value="<?php echo $nim_nilai ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kode_matkul_nilai" class="col-sm-2 col-form-label">Kode Matkul Nilai</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kode_matkul_nilai" name="kode_matkul_nilai" value="<?php echo $kode_matkul_nilai ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nilai" class="col-sm-2 col-form-label">Nilai</label>
                        <div class="col-sm-10">
                            <select class="form-control" name='nilai' id="nilai">
                                <option value="">-Pilih nilai-</option>
                                <option value="1" <?php if ($nilai == '1') echo "selected" ?>> 1</option>
                                <option value="2" <?php if ($nilai == '2') echo "selected" ?>> 2</option>
                                <option value="3" <?php if ($nilai == '3') echo "selected" ?>> 3</option>
                                <option value="4" <?php if ($nilai == '4') echo "selected" ?>> 4</option>
                                <option value="5" <?php if ($nilai == '5') echo "selected" ?>> 5</option>
                                <option value="6" <?php if ($nilai == '6') echo "selected" ?>> 6</option>
                                <option value="7" <?php if ($nilai == '7') echo "selected" ?>> 7</option>
                                <option value="8" <?php if ($nilai == '8') echo "selected" ?>> 8</option>
                                <option value="9" <?php if ($nilai == '8') echo "selected" ?>> 9</option>
                                <option value="10" <?php if ($nilai == '8') echo "selected" ?>> 10</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nilai" class="col-sm-2 col-form-label">Semester</label>
                        <div class="col-sm-10">
                            <select class="form-control" name='semester' id="semester">
                                <option value="">-Pilih nilai-</option>
                                <option value="1" <?php if ($semester == '1') echo "selected" ?>> 1</option>
                                <option value="2" <?php if ($semester == '2') echo "selected" ?>> 2</option>
                                <option value="3" <?php if ($semester == '3') echo "selected" ?>> 3</option>
                                <option value="4" <?php if ($semester == '4') echo "selected" ?>> 4</option>
                                <option value="5" <?php if ($semester == '5') echo "selected" ?>> 5</option>
                                <option value="6" <?php if ($semester == '6') echo "selected" ?>> 6</option>
                                <option value="7" <?php if ($semester == '7') echo "selected" ?>> 7</option>
                                <option value="8" <?php if ($semester == '8') echo "selected" ?>> 8</option>
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
                Data nilai
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"> No</th>
                            <th scope="col"> Nim </th>
                            <th scope="col"> Kode Matkul</th>
                            <th scope="col"> Semester</th>
                            <th scope="col"> Nilai</th>
                            <th scope="col"> Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $sql_nilai2   = "select * from nilai order by id desc";
                        $q_nilai2     = mysqli_query($koneksi, $sql_nilai2);
                        $urut   = 1;
                        while ($r_nilai2 = mysqli_fetch_array($q_nilai2)) {
                            $id         = $r_nilai2['id'];
                            $nim_nilai        = $r_nilai2['nim_nilai'];
                            $kode_matkul_nilai       = $r_nilai2['kode_matkul_nilai'];
                            $semester     = $r_nilai2['semester'];
                            $nilai   = $r_nilai2['nilai'];

                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $nim_nilai ?></td>
                                <td scope="row"><?php echo $kode_matkul_nilai ?></td>
                                <td scope="row"><?php echo $semester ?></td>
                                <td scope="row"><?php echo $nilai ?></td>
                                <td scope="row">
                                    <a href="admin_nilai.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>

                                    <a href="admin_nilai.php?op=delete&id=<?php echo $id ?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>
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