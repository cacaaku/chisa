<?php 
// koneksi database
include 'koneksi.php';
 
// menangkap data yang di kirim dari form
$id_album = $_POST['id_album'];
$judul = $_POST['judul'];
$diskripsi = $_POST['diskripsi'];


// update data ke database
mysqli_query($koneksi,"update album set judul='$judul', diskripsi='$diskripsi' where id_album='$id_album'");
 
// mengalihkan halaman kembali ke index.php
header("location:lain-lain.php");
 
?>