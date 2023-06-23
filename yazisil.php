<?php
session_start();
include("baglanti.php");

if (isset($_SESSION["girisyapildi"]) && ($_SESSION["girisyapildi"] == true)) {
    $kullaniciid = $_SESSION["kullaniciid"];
    $yaziid = $_GET['yaziid'];
    $yazisor = mysqli_query($baglanti, "SELECT * FROM yazi WHERE id='$yaziid'");
    $yazicek = mysqli_fetch_assoc($yazisor);
    if ($yazicek["yazarid"] == $kullaniciid) {
        $yorumlarsil = mysqli_query($baglanti, "DELETE FROM yorum WHERE yaziid='$yaziid'");
        $yazisil = mysqli_query($baglanti, "DELETE FROM yazi WHERE yazi.id='$yaziid'");
        if ($yazisil && $yorumlarsil) {
            header("Location: yazilarim.php");
        } else {
            echo "Yazı silinirken bir hata oluştu.";
        }
    }
} else {
    header("Location: giris.php");
}
?>