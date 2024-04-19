<?php
function save()
{
    $cookie_name = "cart";
    if (isset($_COOKIE[$cookie_name])) {
        $cart = json_decode($_COOKIE[$cookie_name], true);
        $link =new mysqli(
            "127.0.0.1", "root", "", "perpustakaan");
            $query ="insert into peminjaman values(null,current_timestamp())";            
            $result =$link->query($query);
            $id=$link->insert_id;
        foreach ($cart as $row) {
            $idbuku=$row[0];
            $query =
            "insert into dipinjam(peminjaman_id, buku_id, hari) values($id,$idbuku,1)";
            $result =$link->query($query);
        }
        $link->close();  
    }
}
?>