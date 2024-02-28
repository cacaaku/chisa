
 <?php 
session_start();
if(!isset($_SESSION['session_name']) || (isset($_SESSION['session_name']) && empty($_SESSION['session_name'])))
header("location: login.php");
// Require/Include DB Connection
require_once('./db-connect.php');
if(isset($_GET['logout']) && $_GET['logout'] == 'true'){
    session_destroy();
    header("location:../login.php");
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
   extract($_POST);
   //Disini, real_escape_string digunakan untuk menghindari serangan SQL injection dengan membersihkan dan melarang karakter-karakter khusus yang dapat dieksekusi dalam string SQL//
   $sql = "INSERT INTO `post_list` (`title`, `author`, `content`) VALUES ('{$conn->real_escape_string($title)}','{$conn->real_escape_string($session_name)}', '{$conn->real_escape_string($content)}')";
   $save= $conn->query($sql);
   if($save){
        echo "<script> alert('Post has been inserted successfully.'); location.replace('index.php'); </script>";
    }else{
        echo "<script> alert('Post has failed to insert. Error: '.$conn->error); location.replace('index.php'); </script>";
    }
    echo "<script> location.replace('index.php'); </script>";
}
if(isset($_GET['post_id'])){
   extract($_GET);
    $get = $conn->query("SELECT * FROM `like_list` where post_id = '{$post_id}' and session_name = '{$_SESSION['session_name']}'");
    if($get->num_rows > 0){
        $sql = "DELETE FROM `like_list` where post_id = '{$post_id}' and session_name = '{$_SESSION['session_name']}' ";
    }else{
        $sql = "INSERT INTO `like_list` set post_id = '{$post_id}', session_name = '{$_SESSION['session_name']}' ";
    }
    //Mengecek apakah operasi (DELETE atau INSERT) berhasi
    $process= $conn->query($sql);
    if($process){
        echo "<script> alert('Post Like has been updated.'); location.replace('index.php'); </script>";
    }else{
        echo "<script> alert('Post Like/Unlike has failed.'); location.replace('index.php'); </script>";
    }
 
}
if(isset($_GET['delete_post'])){
   extract($_GET);
    $sql = "DELETE FROM `post_list` where id = '{$delete_post}'";
    $delete = $conn->query($sql);
    if($delete){
        echo "<script> alert('Post has been deleted successfully.'); location.replace('index.php'); </script>";
    }else{
        echo "<script> alert('Post has failed to delete. Error: '.$conn->error); location.replace('index.php'); </script>";
    }
}
 
?><!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Counting Likes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./js/bootstrap.min.js"></script>
 
</head>
 <style>
    html, body{
        height:100%;
        width:100%;
    }
 </style>
<body class="bg-gradient bg-dark bg-opacity-50">
    <script>
        start_loader()
    </script>
    <nav class="navbar navbar-expand-sm navbar-dark bg-gradient bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="./">Like dan Komen Album</a>
 
            <div>
                <a href="./?logout=true" class="text-light fw-bolder text-decoration-none"><i class="fa fa-sign-out"></i> <?= $_SESSION['session_name'] ?></a>
            </div>
            </div>
        </div>
        </nav>
    <main>
        <div class="container w-100 mt-3">
            <div class="d-flex w-100 align-items-center mb-3">
                <div class="col-auto flex-shrink-1 flex-grow-1">
                    <h3 class="text-center fw-bolder text-light">Album</h3>
                </div>
                
            </div>
            <?php 
            $posts = $conn->query("SELECT *,COALESCE((SELECT COUNT(id) FROM like_list where post_id = post_list.id), 0) as `likes` FROM `post_list` order by unix_timestamp(date_created) desc");
            while($row = $posts->fetch_assoc()):
                //Menjalankan query SQL untuk memeriksa apakah pengguna saat ini (session_name) sudah memberikan "like" pada posting yang sedang diproses ($row['id']).//
                $is_liked = $conn->query("SELECT * FROM `like_list` where post_id = '{$row['id']}' and session_name = '{$_SESSION['session_name']}'")->num_rows;
 
            ?>

            <div class="card card-default rounded-0 mb-4">
                <div class="card-header py-1">
                    <div class="card-title fw-light text-muted d-flex w-100">
                        <div class="col-auto flex-shricnk-1 flex-grow-1"><?= $row['author'] ?></div>
                        <div class="col-auto"><?= date("F d, Y h:i A", strtotime($row['date_created'])) ?></div>
                    </div>
                </div>
                <div class="card-body">
                    <h3 class="fw-bolder"><?= $row['title'] ?></h3>
                    <div>
                        <?= $row['content'] ?>
                    </div>
                </div>
                <div class="card-footer py-1">
                    <div class="d-flex w-100">
                        <div class="col-auto flex-shrink-1 flex-grow-1">
                            <?php if($is_liked > 0): ?>
                            <a href="index.php?post_id=<?= $row['id'] ?>" class="text-decoration-none text-reset me-3"><i class="fa fa-thumbs-up text-primary"></i></a>
                            <?php else: ?>
                            <a href="index.php?post_id=<?= $row['id'] ?>" class="text-decoration-none text-reset me-3"><i class="far fa-thumbs-up"></i></a>
                            <?php endif; ?>
                            <span class="fw-bolder"><?= $row['likes'] ?> Like<?= $row['likes'] > 1 ? "s" : "" ?></span>
                        </div>
                        <div class="col-auto">
                            <?php if($_SESSION['session_name'] == $row['author']): ?>
                                <a href="./?delete_post=<?= $row['id'] ?>" onclick="if(confirm('Are you sure to delete this post?') == false){ event.preventDefault() }" class="btn btn-flat btn-danger rounded-0"><i class="fa fa-trash"></i> Delete</a>
                            <?php endif; ?>
                        </div>
                    </div>
 
                </div>
            </div>
            <?php endwhile; ?>
 
        </div>
        <div class="modal fade" id="postFormModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="postFormModallabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="postFormModallabel">New Member Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="index.php" method="POST" id="new_post">
                            <input type="hidden" name="session_name" value="<?= $_SESSION['session_name'] ?>">
                            <div class="border-top border-bottom item py-2">
                                <div class="form-group mb-3">
                                    <label for="id_album">Select Judul:</label>
        <select name="id_album" required>
            <!-- Populate with existing photos -->
            <?php include 'get_photo_options.php'; ?>
        </select><br>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="content" class="control-label">Coment</label>
                                    <textarea rows="4" class="form-control form-control-sm rounded-0" id="content" name="content" required="required"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm rounded-0" form="new_post">Save Coment</button>
                        <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>