<?php
session_start();
if (isset($_SESSION['admin_username'])){
    header("location:admin_depan.php");
}
include("koneksi.php");
$username   = "";
$password   = "";
$err        = "";

if(isset($_POST['login'])){
    $username   = $_POST ['username'];
    $password   = $_POST ['password'];
    if($username =='' or $password == '' ){
        $err .= "<li> Silakan masukan username dan password </li>";
    }
    if(empty($err)){
        $sql1 = "select * from login where username = '$username'";
        $q1 = mysqli_query($koneksi, $sql1);
        $r1 = mysqli_fetch_array($q1);
        if($r1['password'] != md5($password))
        {
            $err .= "<li> Akun tidak ada</li>";
        }
    }
    if(empty($err)){
        $_SESSION['admin_username']= $username;
        header("location:admin_depan.php");
        exit();

    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="app">
        <h1> Halaman Login</h1>
        <?php
        if($err){
            echo "<ul>$err</ul>";
        }
        ?>
        <form action="" method="post">
            <input type="text" value="<?php echo $username ?>" name="username" class="input" placeholder="Mohon isi username"/> <br> <br>
            <input type="password" name="password" class="input" placeholder="Isi password"/> <br> <br>
            <input type="submit" name="login" value="Masuk ke Sistem"/>
            
        </form>
    </div>
</body>
</html>