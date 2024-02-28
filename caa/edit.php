<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
 
	<h2>EDIT DATA</h2>
	<br/>
	<a href="lain-lain.php">KEMBALI</a>
	<br/>
	<br/>
	<h3>EDIT DATA FOTO</h3>
 
	<?php
	include 'koneksi.php';
	$id_album = $_GET['id_album'];
	$data = mysqli_query($koneksi,"select * from album where id_album='$id_album'");
	while($d = mysqli_fetch_array($data)){
		?>
		<form method="post" action="update.php">
			<table>
				<tr>			
					<td>Judul</td>
					<td>
						<input type="hidden" name="id_album" value="<?php echo $d['id_album']; ?>">
						<input type="text" name="judul" value="<?php echo $d['judul']; ?>">
					</td>
				</tr>
				<tr>
					<td>Diskripsi</td>
					<td><input type="text" name="diskripsi" value="<?php echo $d['diskripsi']; ?>"></td>
				</tr>
				
				<tr>
					<td></td>
					<td><input type="submit" value="SIMPAN"></td>
				</tr>		
			</table>
		</form>
		<?php 
	}
	?>
 
</body>
</html>

