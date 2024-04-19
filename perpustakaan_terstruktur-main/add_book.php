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

$error = '';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $judul = $_POST['judul'];

    $sql = "INSERT INTO buku (judul) VALUES ('$judul')";
    
    if(mysqli_query($link, $sql)){
        header("location: fitur.php");
        exit();
    } else{
        $error = "Error: " . mysqli_error($link);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Buku</title>
</head>
<body>
    <h2>Tambah Buku</h2>
    <form method="post">
        <label for="judul">Judul:</label><br>
        <input type="text" id="judul" name="judul" required><br><br>
        <input type="submit" value="Tambah Buku">
    </form>
    <?php echo $error; ?>
    <button onclick="window.location.href='fitur.php'">Kembali</button>
</body>
</html>
