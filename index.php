<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore | O Blog</title>
    <link rel="icon" type="image/x-icon" href="img/o_favicon.png">
    <?php
    session_start();
    include("connect.php");
    ?>
    <link rel="stylesheet" href="css/style.css">
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
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
            $posts = mysqli_query($checkdb, "SELECT * FROM post ORDER BY date DESC");
            $authors = mysqli_query($checkdb, "SELECT * FROM post INNER JOIN author ON post.authorid = author.id ORDER BY date DESC");

            if (mysqli_num_rows($posts) > 0) {
                echo "<a href='create.php' id='create-link'>Create!</a><br><br>";
                while ($post = mysqli_fetch_assoc($posts)) {
                    $postId = mysqli_real_escape_string($checkdb, $post["id"]);
                    $comments = mysqli_query($checkdb, "SELECT * FROM post INNER JOIN comment ON post.id = comment.postid WHERE post.id = '$postId' ORDER BY post.date DESC");
                    $commentCount = mysqli_num_rows($comments);

                    $author = mysqli_fetch_assoc($authors);
                    $username = htmlspecialchars($author["username"]);

                    echo "<div id='post'>";
                    echo "<div id='title'><a href='post.php?id=" . $postId . "'>" . substr(htmlspecialchars($post["title"]), 0, 60) . "...</a></div>";
                    echo "<div id='text'>" . substr(htmlspecialchars($post["text"]), 0, 250) . "...</div>";
                    echo "<div style='padding-left:1%;padding-bottom:1%;'><b>Author:</b> <a href='profile.php?username=" . $username . "'>" . $username . "</a></div>";
                    echo "<div style='padding-left:1%;padding-bottom:1%;'><b>Date:</b> " . htmlspecialchars($post["date"]) . "<br>";
                    if ($post["date"] > date("Y-m-d")) {
                        echo "<b style='color:lime;'>(Current)</b>";
                    }
                    echo "</div><div style='padding-left:1%;padding-bottom:1%;'><b>Comments:</b> " . $commentCount . "</div>";
                    echo "</div>";
                }
            } else {
                echo "<a href='create.php' id='create-link'>Create!</a><br><br>";
                echo "No posts yet.";
            }
        } else {
            echo "<div style='background-color:#3F3F3F; opacity:0.93; box-shadow:0 0 25px black; padding: 2% 3% 2% 3%; border-radius: 2rem;'><h1>Welcome!</h1><br>";
            echo "<p>Welcome to O Blog. Here you can create posts, make comments, and read posts from other users.</p></div>";
        }
        ?>
    </main>
    <?php
    include("footer.php");
    ?>
</body>

</html>