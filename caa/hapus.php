<?php 
// koneksi database
include 'koneksi.php';
 
// menangkap data id yang di kirim dari url
$id_album = $_GET['id_album'];
 
 
// menghapus data dari database
mysqli_query($koneksi,"delete from album where id_album='$id_album'");
 
// mengalihkan halaman kembali ke index.php
header("location:lain-lain.php");
 
?>