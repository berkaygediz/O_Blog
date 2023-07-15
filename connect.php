<?php
$host = "localhost";
$uname = "root";
$db = "o_blog";
$checkdb = mysqli_connect($host, $uname);

if (!$checkdb) {
    echo mysqli_connect_error();
    exit();
}

if (!mysqli_select_db($checkdb, $db)) {
    echo mysqli_error($checkdb);
    exit();
}
?>