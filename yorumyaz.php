<?php
session_start();
include("connect.php");
$yorum = $_POST['yorum'];
$yazi = $_POST['yaziid'];
$yazar = $_SESSION["kullaniciid"];

$yorumekle = mysqli_query($baglanti, "INSERT INTO comment(text, postid, authorid) VALUES ('" . htmlspecialchars($yorum) . "','$yazi','$yazar')");
if ($yorumekle) {
    header("Location: yazi.php?id=$yazi");
    exit;
} else {
    echo "Bir hata oluştu";
}
?>