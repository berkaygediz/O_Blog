<?php
session_start();
include("connect.php");

if (isset($_SESSION["girisyapildi"]) && ($_SESSION["girisyapildi"] == true)) {
    $kullaniciid = $_SESSION["kullaniciid"];
    $kategoriid = $_GET['kategoriid'];
    $kategorisor = mysqli_query($baglanti, "SELECT * FROM category WHERE id='$kategoriid'");
    $kategoricek = mysqli_fetch_assoc($kategorisor);
    if ($kategoricek["id"] == $kategoriid) {
        $yazisor = mysqli_query($baglanti, "SELECT * FROM post WHERE categoryid='$kategoriid'");
        $kategorisil = mysqli_query($baglanti, "DELETE FROM category WHERE id='$kategoriid'");
        if ($kategorisil) {
            header("Location: admin.php");
        } else {
            echo "Kategori silinirken bir hata oluştu.";
        }
    }
} else {
    header("Location: giris.php");
}
?>