<?php
include("enc_header.php");
?>
<h1>Halaman Matakuliah</h1>
Selamat datang di Halaman Matakuliah
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
    $sql_matkul1 = "delete from matkul where id = '$id'";
    $q_matkul1 = mysqli_query($koneksi, $sql_matkul1);
    if ($q_matkul1) {
        $sukses = "Berhasil hapus data";
    } else {
        $error = "Gagal melakukan delete data";
    }
}



if ($op == 'edit') {
    $id = $_GET['id'];
    $sql_matkul1 = "select * from matkul where id = '$id'";
    $q_matkul1 = mysqli_query($koneksi, $sql_matkul1);
    $r_matkul1 = mysqli_fetch_array($q_matkul1);
    $kode_matkul = $r_matkul1['kode_matkul'];
    $nama_matkul = $r_matkul1['nama_matkul'];
    $sks = $r_matkul1['sks'];

    if ($kode_matkul == '') {
        $error = "Data tidak ditemukan";
    }
}


//Untuk Create
if (isset($_POST['simpan'])) {
    $kode_matkul = $_POST['kode_matkul'];
    $nama_matkul = $_POST['nama_matkul'];
    $sks = $_POST['sks'];

    if ($kode_matkul && $nama_matkul && $sks) {

        if ($op == 'edit') { //untuk update
            $sql_matkul1 = "update matkul set kode_matkul = '$kode_matkul',nama_matkul='$nama_matkul',sks='$sks' where id = '$id'";
            $q_matkul1 = mysqli_query($koneksi, $sql_matkul1);
            if ($q_matkul1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error = "Data gagal diupdate";
            }
        } else { // insert
            $sql_matkul1 = "insert into matkul(kode_matkul,nama_matkul,sks) values('$kode_matkul','$nama_matkul','$sks')";
            $q_matkul1 = mysqli_query($koneksi, $sql_matkul1);

            if ($q_matkul1) {
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
                        <label for="kode_matkul" class="col-sm-2 col-form-label">Kode Matkul</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kode_matkul" name="kode_matkul" value="<?php echo $kode_matkul ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_matkul" class="col-sm-2 col-form-label">Nama Matkul</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_matkul" name="nama_matkul" value="<?php echo $nama_matkul ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="sks" class="col-sm-2 col-form-label">SKS</label>
                        <div class="col-sm-10">
                            <select class="form-control" name='sks' id="sks">
                                <option value="">-Pilih SKS-</option>
                                <option value="1" <?php if ($sks == '1') echo "selected" ?>> 1 </option>
                                <option value="2" <?php if ($sks == '1') echo "selected" ?>> 2 </option>
                                <option value="3" <?php if ($sks == '1') echo "selected" ?>> 3 </option>
                                <option value="4" <?php if ($sks == '1') echo "selected" ?>> 4 </option>
                                <option value="5" <?php if ($sks == '1') echo "selected" ?>> 5 </option>
                            
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
                Data matkul
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"> No</th>
                            <th scope="col"> Kode Matkul</th>
                            <th scope="col"> Nama Matkul</th>
                            <th scope="col"> SKS</th>
                            <th scope="col"> Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $sql_matkul2   = "select * from matkul order by id desc";
                        $q_matkul2     = mysqli_query($koneksi, $sql_matkul2);
                        $urut   = 1;
                        while ($r_matkul2 = mysqli_fetch_array($q_matkul2)) {
                            $id         = $r_matkul2['id'];
                            $kode_matkul        = $r_matkul2['kode_matkul'];
                            $nama_matkul       = $r_matkul2['nama_matkul'];
                            $sks   = $r_matkul2['sks'];

                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $kode_matkul ?></td>
                                <td scope="row"><?php echo $nama_matkul ?></td>
                                <td scope="row"><?php echo $sks ?></td>
                                <td scope="row">
                                    <a href="admin_matkul.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>

                                    <a href="admin_matkul.php?op=delete&id=<?php echo $id ?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>
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