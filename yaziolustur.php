<?php
session_start();
include("connect.php");
$baslik = $_POST["yazibaslik"];
$metin = $_POST["yazimetin"];
$kategori = $_POST["yazikategori"];
$kullaniciid = $_SESSION["kullaniciid"];

if (isset($baslik) && isset($kategori)) {

    $baslikoncesi = mysqli_query($baglanti, "SELECT * FROM post WHERE title='" . $baslik . "'");
    $kategorioncesi = mysqli_query($baglanti, "SELECT id FROM category WHERE category='$kategori'");
    $kategoriid = mysqli_fetch_row($kategorioncesi);

    if (mysqli_num_rows($baslikoncesi) == 0 && mysqli_num_rows($kategorioncesi) == 1) {
        $ekle = mysqli_query($baglanti, "INSERT INTO post (title, text, authorid, categoryid) VALUES ('" . htmlspecialchars($baslik) . "', '" . htmlspecialchars($metin) . "', '$_SESSION[kullaniciid]', '$kategoriid[0]')");
        if ($ekle) {
            $varlik_kontrol = mysqli_query($baglanti, "SELECT * FROM post WHERE title='$baslik' AND authorid='$_SESSION[kullaniciid]'");
            $bilgi_kontrol = mysqli_fetch_assoc($varlik_kontrol);
            header('Location: yazilarim.php');
            exit;
        } else {
            echo "Hata: " . $ekle . "<br>" . mysqli_error($baglanti);
        }
    } else {
        $_SESSION["hata"] = true;
        header('Location: olustur.php');
        exit;
    }
} else {
    $_SESSION["hata"] = true;
    header('Location: olustur.php');
    exit;
}
?>