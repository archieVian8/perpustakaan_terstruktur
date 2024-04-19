<?php
session_start();

if(!isset($_SESSION['username'])){
    header("location: login.php");
    exit();
}

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'perpustakaan');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$sql = "SELECT id, judul FROM buku";
$result = mysqli_query($link, $sql);

if(mysqli_num_rows($result) > 0) {
    echo "<h2>Daftar Buku</h2>";
    echo "<table border='1'>";
    echo "<tr><th>No</th><th>ID</th><th>Judul Buku</th><th>Action</th></tr>";
    $no = 1;
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>".$no."</td>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['judul']."</td>";
        echo "<td><a href='delete_book.php?id=".$row['id']."'>Hapus</a></td>";
        echo "</tr>";
        $no++;
    }
    echo "</table>";
} else {
    echo "Tidak ada buku yang ditemukan.";
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql_delete = "DELETE FROM buku WHERE id = $id";
    if(mysqli_query($link, $sql_delete)){
        echo "<p>Buku dengan ID $id berhasil dihapus.</p>";
    } else {
        echo "Error: " . mysqli_error($link);
    }
}

mysqli_close($link);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Book</title>
</head>
<body>
    <br>
    <button onclick="window.location.href='fitur.php'">Kembali</button>
</body>
</html>
