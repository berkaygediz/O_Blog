<?php
session_start();
include("baglanti.php");

if (isset($_SESSION["girisyapildi"]) && ($_SESSION["girisyapildi"] == true)) {
    $kullaniciid = $_SESSION["kullaniciid"];
    $yaziid = $_GET['yaziid'];
    $baslik = $_POST['baslik'];
    $metin = $_POST['metin'];
    $yazisor = mysqli_query($baglanti, "SELECT * FROM yazi WHERE id='$yaziid'");
    $yazicek = mysqli_fetch_assoc($yazisor);
    if ($yazicek["id"] == $kullaniciid) {
        $yaziduzenle = mysqli_query($baglanti, "UPDATE yazi SET baslik='$baslik', metin='$metin' WHERE id='$yaziid'");
        if ($yaziduzenle) {
            header("Location: yazi.php?id=" . $yaziid);
        } else {
            echo "Yazı düzenlenirken bir hata oluştu.";
        }
    }
} else {
    header("Location: giris.php");
}
?>