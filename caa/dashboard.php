<?php include"header.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>

<div class="container-fluid mt-3">
  <center><h3>Selamat Datang Di Gallery Cia</h3></center>
</div>
<main id="main">
  <?php
       include 'koneksi.php';
       $data = mysqli_query($koneksi, "SELECT * FROM foto limit 1");
       while($d = mysqli_fetch_array($data)){

        ?>

        <div class="row">
          <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
            <?php echo "<img src='img/$d[foto]' width='100%'/>" ?>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
            
            <p class="fst-italic">
              <tr>
                <center><h3><td><?php echo $d['judul']; ?></td><br><br></h3>
                <td> Tanggal : <?php echo $d['tanggal']; ?></td><br>
                </center>
              <?php
             $kalimat=$d['diskripsi'];
             $jumlahkarakter=1000;
             $cetak = substr($kalimat, 0, $jumlahkarakter);
             echo $cetak;
              ?> </tr>
              
              <?php
            }
            ?>
           
</body>
</html>