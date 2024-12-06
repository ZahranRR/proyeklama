<?php
include 'uas.php';

$c = mysqli_connect('localhost','root','','uas');

if(isset($_POST['subkontak'])){
    $nama=$_POST['nama_lengkap'];
    $email=$_POST['email'];
    $alamat=$_POST['alamat'];
    $pesan=$_POST['pesan'];

    $insert = mysqli_query($c,"insert into kontak (nama_lengkap, email, alamat, pesan) values ('$nama', '$email', '$alamat', '$pesan')");  


}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<form method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Nama Lengkap</label>
    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap" required>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Alamat</label>
    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" required>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Pesan</label>
    <input type="text" class="form-control" id="pesan" name="pesan" placeholder="Pesan" required>
  </div>
  <button type="submit" class="btn btn-primary" name="subkontak">Kirim</button>
</form>
</body>
</html>