<?php 
include 'koneksi.php';
$album = $_POST['judul'];
$diskripsi = $_POST['diskripsi'];
$tanggal = $_POST['tanggal'];
$id_user = $_POST['id_user'];

$rand = rand();
$ekstensi =  array('png','jpg','jpeg','gif');
$filename = $_FILES['foto']['name'];
$ukuran = $_FILES['foto']['size'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);
 
if(!in_array($ext,$ekstensi) ) {
	header("location:index.php?alert=gagal_ekstensi");
}else{
	if($ukuran < 1044070){		
		$xx = $rand.'_'.$filename;
		move_uploaded_file($_FILES['foto']['tmp_name'], 'img/'.$rand.'_'.$filename);
		mysqli_query($koneksi, "INSERT INTO album VALUES('','$album','$diskripsi','$tanggal','$xx','$id_user')");
		header("location:lain-lain.php?alert=berhasil");
	}else{
		header("location:dashboard.php?alert=gagak_ukuran");
	}
}