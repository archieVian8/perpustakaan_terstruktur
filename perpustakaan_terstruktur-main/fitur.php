<?php
session_start();

if(!isset($_SESSION['username'])){
    header("location: login.php");
    exit();
}

include "cari.php";

$fitur = $_GET['fitur'] ?? null;

switch ($fitur) {
    case 'pinjam':
        header('location: pinjam/pinjam.php?fitur=read');
        exit;
    case 'cari':
    default:
        $keyword = $_GET['keyword'] ?? null;
        $listbuku = cari($keyword);
        display($listbuku);
        
        if($_SESSION['role'] == 'admin'){
            echo "<button onclick=\"window.location.href='add_book.php'\">Tambah Buku</button>";
            echo "<button onclick=\"window.location.href='delete_book.php'\">Hapus Buku</button>";
        }
        echo "<button onclick=\"window.location.href='login.php'\">Logout</button>";
        break;
        break;
}
?>
