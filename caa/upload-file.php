<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>
	<div class="container">
		<h2 style="text-align: center;">Tambah Data Foto</h2>
		<form action="upload-simpan.php" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label>Nama :</label>
				<input type="text" class="form-control" placeholder="Masukkan Nama" name="judul" required="required">
			</div>
			<div class="form-group">
				<label>Diskripsi :</label>
				<input type="text" class="form-control" placeholder="Masukkan Nama" name="diskripsi" required="required">
			</div>
			<div class="form-group">
				<label>Tanggal :</label>
				<input type="date" class="form-control" placeholder="Masukkan Tanggal" name="tanggal" required="required">
			</div>
			<div class="form-group">
				<label>Foto :</label>
				<input type="file" name="foto" required="required">
				<p style="color: red">Ekstensi yang diperbolehkan .png | .jpg | .jpeg | .gif</p>
			</div>			
			<input type="submit" name="" value="Simpan" class="btn btn-primary">
		</form>
	</div>
 
</body>
</html>