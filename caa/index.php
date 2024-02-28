<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Gallery Cia</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Dropdown</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="login.php">Login</a></li>
            <li><a class="dropdown-item" href="daftar.php">Daftar</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- Carousel -->
<div id="demo" class="carousel slide" data-bs-ride="carousel">

  <!-- Indicators/dots -->
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
  </div>
  
  <!-- The slideshow/carousel -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/planet.jpg" alt="Los Angeles" class="d-block" style="width:100%">
      <div class="carousel-caption">
        <h3>Gallery Cia</h3>
        <p></p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="img/planetungu.jpg" alt="Chicago" class="d-block" style="width:100%">
      <div class="carousel-caption">
      </div> 
    </div>
    <div class="carousel-item">
      <img src="img/bulan.jpg" alt="New York" class="d-block" style="width:100%">
      <div class="carousel-caption">
      </div>  
    </div>
  </div>
  
  <!-- Left and right controls/icons -->
  <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
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