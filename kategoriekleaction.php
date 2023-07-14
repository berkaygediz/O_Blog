<?php
session_start();
include("connect.php");

if (isset($_SESSION["girisyapildi"]) && ($_SESSION["girisyapildi"] == true)) {
    $kullaniciid = $_SESSION["kullaniciid"];
    $kategoriadi = $_POST['kategoriadi'];
    $kategorisor = mysqli_query($baglanti, "SELECT * FROM category WHERE category='$kategoriadi'");
    $kategoricek = mysqli_fetch_assoc($kategorisor);
    if ($kategoricek["kategori"] != $kategoriadi) {
        $kategoriekle = mysqli_query($baglanti, "INSERT INTO category (category) VALUES ('$kategoriadi')");
        if ($kategoriekle) {
            header("Location: admin.php");
        } else {
            echo "Kategori eklenirken bir hata oluştu.";
        }
    } else {
        echo "Bu isimde bir kategori zaten var.";
    }
} else {
    header("Location: giris.php");
}
?>