<?php
session_start();
include("baglanti.php");
$yorum = $_POST['yorum'];
$yazi = $_POST['yaziid'];
$yazar = $_SESSION["kullaniciid"];

$yorumekle = mysqli_query($baglanti, "INSERT INTO yorum(metin,yaziid, yazarid) VALUES ('" . htmlspecialchars($yorum) . "','$yazi','$yazar')");
if ($yorumekle) {
    header("Location: yazi.php?id=$yazi");
    exit;
} else {
    echo "Bir hata oluştu";
}
?>