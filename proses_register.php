<?php
include "koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

$sql = "INSERT INTO users (username,password,role,gmail) VALUES ('$username',md5('$password'),'customer','$email')";
$query = mysqli_query($koneksi,$sql);

if($query){
    header("location:login.php?buatAkunSukses");
}else{
    header("location:register.php?buatAkunGagal");
}
?>