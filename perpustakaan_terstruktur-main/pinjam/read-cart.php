<?php
function read()
{
    $cookie_name = "cart";
    if (!isset($_COOKIE[$cookie_name])) {
        echo "cart kosong";
    } else {
        $cart = json_decode($_COOKIE[$cookie_name], true);
        echo "<table border=1>";
        echo "<tr><td>No</td><td>ID</td><td> Judul </td><td></td></tr>";
        $i=0;
        foreach ($cart as $row) {                     
            echo "<tr><td>$i</td><td>$row[0]</td><td> $row[1] </td><td><a href='./pinjam.php?fitur=delete&idbuku=$i'>hapus</td></tr>";
            $i++;   
        }
        echo "</table>";
        echo "<a href='../fitur.php'>CARI</a> <br>";
        echo "<a href='pinjam.php?fitur=save'>SIMPAN</a>";
    }
}
?>