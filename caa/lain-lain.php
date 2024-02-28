<?php 
  session_start();
  error_reporting(0);
  include 'koneksi.php';
  if(!isset($_SESSION['username'])){
    header('location:dashboard.php');
  }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/hwn/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/hwn/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>





<?php include"header.php" ?>
<div class="container mt-3">
  <h2>Lain-Lain</h2>
  <p></p>


       <?php include 'koneksi.php'; ?>

    <table class="table table-bordered">
      <thead class="thead-dark">
        <tr>
          <th>Nomor</th>
          <th>Tanggal Terbit</th>
          <th>Judul</th>
          <th>User</th>
          <th>Diskripsi</th>
          <th>Foto</th>
          <th>Aksi</th>
        </tr>
        </tr>
      </thead>

      <tbody>
        

<?php 
        $batas = 10;
        $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
        $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;  
 
        $previous = $halaman - 1;
        $next = $halaman + 1;
        
        $data = mysqli_query($koneksi,"select * from album");
        $jumlah_data = mysqli_num_rows($data);
        $total_halaman = ceil($jumlah_data / $batas);

              
        $data_pegawai = mysqli_query($koneksi,"select * from album limit $halaman_awal, $batas");
        $nomor = $halaman_awal +1;
        while($d = mysqli_fetch_array($data_pegawai)){
          ?>
          <tr>
            <td><?php echo $nomor++; ?></td>
            <td><?php echo $d['tanggal']; ?></td>
            <td><?php echo $d['judul']; ?></td>
            <td><?php echo $d['id_user']; ?></td>
            <td>
  

            <?php
             $kalimat=$d['diskripsi'];
             $jumlahkarakter=100;
             $cetak = substr($kalimat, 0, $jumlahkarakter);
             echo $cetak;
              ?>
            </td>
            <td>
              
            <a href="tampil-foto.php?id_foto=<?php echo $d['id_album']; ?>">
            <?php echo "<img src='img/$d[foto]' width='150' height='100' />";?></td>

          <td>
         <a type="button" class="btn btn-outline-dark" href="hapus.php?id_album=<?php echo $d['id_album']; ?>">Hapus</a>
         <td>
          <a type="button" class="btn btn-outline-dark" href="edit.php?id_album=<?php echo $d['id_album']; ?>">Edit</a>
         <td>
         <a class="btn btn-outline-danger" href="like/login.php?id=<?= $row['id'] ?>" onclick="return confirm('Sukses')">Komen</a>
           </td>
         </tr>
            </td>
             </a>
          </tr>
      </tr>
      
    <?php } ?>
      </tbody>
    </table>
      <nav>
      <ul class="pagination justify-content-center">
        <li class="page-item">
          
        </li>
        <?php 
        for($x=1;$x<=$total_halaman;$x++){
          ?> 
          <li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
          <?php
        }
        ?>        
        <li class="page-item">
          <a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?halaman=$next'"; } ?>>Next</a>
        </li>
      </ul>
    </nav>  
  </div>

<tbody>



</div>
</body>
</html>