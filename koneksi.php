<?php
$db_host    = "localhost";
$db_user    = "root";
$db_pass    = "";
$db_name    = "stmikids";

$koneksi    = mysqli_connect($db_host,$db_user, $db_pass, $db_name);

if (!$koneksi) {
    die("Koneksi Gagal");
}

//mahasiswa
$nim            = '';
$nama           = '';
$alamat         = '';
$jurusan        = '';
$sukses         = '';
$error          = '';
//dosen
$nind           = '';
$nama_dosen     = '';
$jenkel_dosen   = '';
$alamat_dosen   = '';
//Matakuliah
$kode_matkul    = '';
$nama_matkul    = '';
$sks            = '';
//nilai
$nim_nilai          = '';
$kode_matkul_nilai  = '';
$semester           = '';
$nilai              = '';

?>