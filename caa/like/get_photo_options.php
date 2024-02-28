<?php
// get_photo_options.php

// Sambungkan ke database
$conn = new mysqli("localhost", "root", "", "galericaca");

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data foto dari database
$sql = "SELECT id_album, judul FROM album";
$result = $conn->query($sql);

// Tampilkan pilihan foto
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id_foto = $row["id_album"];
        $judul = $row["judul"];
        echo "<option value='$id_foto'>$judul</option>";
    }
} else {
    echo "<option value=''>No judul found</option>";
}

// Tutup koneksi
$conn->close();
?>
