<?php include"header.php" ?>
            <?php
      include 'koneksi.php';
      $id = $_GET['id_foto'];
      $data = mysqli_query($koneksi,"SELECT * FROM album where id_album='$id'");
      while($d = mysqli_fetch_array($data)){
        ?>

        <div class="row">
          <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
            <?php echo "<img src='img/$d[foto]' width='100%'/>" ?>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
            <p class="fst-italit">
               
            <tr>
              <center><h3><td><?php echo $d['judul']; ?></td><br><br></h3>
              <td> tanggal : <?php echo $d['tanggal']; ?></td><br>


               <?php
               $kalimat=$d['diskripsi'];
             
               $cetak = substr($kalimat, 0, );
               echo $cetak; ?>
           </tr>

             <?php
           }
           ?>
          </div>
        </div>

      </div>
