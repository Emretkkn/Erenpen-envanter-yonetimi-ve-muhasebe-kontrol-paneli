<?php

if ($_GET)
{

include("db_conn.php"); // veritabanı bağlantımızı sayfamıza ekliyoruz.

// id'si seçilen veriyi silme sorgumuzu yazıyoruz.
if ($conn->query("UPDATE stok SET stok.stoksayi=stok.stoksayi+1 WHERE stok_id =".(int)$_GET['stok_id']))
{
    header("location:satinalim.php"); // Eğer sorgu çalışırsa ekle.php sayfasına gönderiyoruz.
}
}

?>
