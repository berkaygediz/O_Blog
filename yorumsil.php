<?php
include("connect.php");
session_start();
$yorumid = $_GET['id'];
if (isset($_SESSION["girisyapildi"]) && ($_SESSION["girisyapildi"] == true)) {
    $yorum_sil = mysqli_query($baglanti, "DELETE FROM comment WHERE id='$yorumid'");
    header("Location: yorumlarim.php");
    exit();
} else {
    header("Location: giris.php");
}
?>