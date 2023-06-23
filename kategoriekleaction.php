<?php
session_start();
include("baglanti.php");

if (isset($_SESSION["girisyapildi"]) && ($_SESSION["girisyapildi"] == true)) {
    $kullaniciid = $_SESSION["kullaniciid"];
    $kategoriadi = $_POST['kategoriadi'];
    $kategorisor = mysqli_query($baglanti, "SELECT * FROM kategori WHERE kategori='$kategoriadi'");
    $kategoricek = mysqli_fetch_assoc($kategorisor);
    if ($kategoricek["kategori"] != $kategoriadi) {
        $kategoriekle = mysqli_query($baglanti, "INSERT INTO kategori (kategori) VALUES ('$kategoriadi')");
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