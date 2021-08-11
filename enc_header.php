<?php
session_start();
include("koneksi.php");
if(!isset($_SESSION['admin_username'])){
    header("location:login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="app">
        <nav>
            <ul>
                <li><a href="admin_depan.php">Halaman Depan</a></li>
                <li><a href="admin_dosen.php">Halaman Dosen</a></li>
                <li><a href="admin_mhs.php">Halaman Mahasiswa</a></li>
                <li><a href="admin_nilai.php">Nilai </a></li>
                <li><a href="admin_matkul.php">Mata Kuliah </a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>