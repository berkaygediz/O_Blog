<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Posts | O Blog</title>
    <?php
    session_start();
    include("connect.php");
    ?>
    <link rel="icon" type="image/x-icon" href="img/o_favicon.png">
    <link rel="stylesheet" href="css/style.css">
    <style>
    </style>
</head>

<body>
    <header>
        <div class="navbar-icon">
            <a href="index.php" style="text-decoration: none; display: flex; align-items: center;">
                <img src="img/o_favicon.png">
                <h1>Blog</h1>
            </a>
        </div>
        <?php
        include("nav.php");
        ?>
    </header>
    <main>
        <?php
        if (isset($_SESSION["loggedin"]) && ($_SESSION["loggedin"] == true)) {
            $userId = $_SESSION["userid"];

            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["del"])) {
                $postId = $_GET['del'];
                $postQuery = mysqli_query($checkdb, "SELECT * FROM post WHERE id='$postId'");
                $postResult = mysqli_fetch_assoc($postQuery);

                if ($postResult["authorid"] == $userId) {
                    $deleteComments = mysqli_query($checkdb, "DELETE FROM comment WHERE postid='$postId'");
                    $deletePost = mysqli_query($checkdb, "DELETE FROM post WHERE id='$postId'");

                    if ($deletePost && $deleteComments) {
                        header("Location: my-posts.php");
                        exit;
                    } else {
                        echo "An error occurred while deleting the post.";
                    }
                } else {
                    echo "You are not authorized to delete this post.";
                }
            }

            $posts = mysqli_query($checkdb, "SELECT * FROM post WHERE authorid='$userId' ORDER BY date DESC");

            if (mysqli_num_rows($posts) > 0) {
                echo "<h1>My Posts</h1>";
                echo "<table style='width:100%;'>";
                echo "<tr><th style='border:2px solid black;'>Title</th><th style='border:2px solid black;'>Date</th><th style='border:2px solid black;'>Actions</th></tr>";

                while ($post = mysqli_fetch_assoc($posts)) {
                    echo "<tr><td style='border: 2px solid aqua;'><a href='post.php?id=" . $post["id"] . "'>" . substr($post["title"], 0, 50) . "</a></td><td style='border: 2px solid aqua;'>" . $post["date"] . "</td><td style='border: 2px solid aqua;'><a href='editpost.php?postid=" . $post["id"] . "'>Edit</a> | <a href='my-posts.php?del=" . $post["id"] . "'>Delete</a></td></tr>";
                }

                echo "</table>";
            } else {
                echo "<div style='text-align:center;'><h1>My Posts</h1><a href='create.php' id='create-link'>Create!</a><h3>You don't have any posts yet.</h3></div>";
            }
        } else {
            echo "You must be logged in to view this page.<br><br>";
        }
        ?>
    </main>
    <?php
    include("footer.php");
    ?>
</body>

</html>