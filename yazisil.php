<?php
session_start();
include("connect.php");

if (isset($_SESSION["girisyapildi"]) && ($_SESSION["girisyapildi"] == true)) {
    $kullaniciid = $_SESSION["kullaniciid"];
    $yaziid = $_GET['yaziid'];
    $yazisor = mysqli_query($baglanti, "SELECT * FROM post WHERE id='$yaziid'");
    $yazicek = mysqli_fetch_assoc($yazisor);
    if ($yazicek["authorid"] == $kullaniciid) {
        $yorumlarsil = mysqli_query($baglanti, "DELETE FROM comment WHERE postid='$yaziid'");
        $yazisil = mysqli_query($baglanti, "DELETE FROM post WHERE post.id='$yaziid'");
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