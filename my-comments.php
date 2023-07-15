<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Comments | O Blog</title>
    <?php
    session_start();
    include("connect.php");
    ?>
    <link rel="icon" type="image/x-icon" href="img/o_favicon.png">
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
        if (isset($_SESSION["loggedin"]) && ($_SESSION["loggedin"] == true)) {
            if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                $commentId = mysqli_real_escape_string($checkdb, $_GET['id']);
                $userId = mysqli_real_escape_string($checkdb, $_SESSION["userid"]);

                $deleteComment = mysqli_query($checkdb, "DELETE FROM comment WHERE id='$commentId' AND authorid='$userId'");
                if ($deleteComment) {
                    header("Location: " . $_SERVER['PHP_SELF']);
                    exit();
                } else {
                    echo "An error occurred while deleting the comment.";
                }
            }

            $userId = mysqli_real_escape_string($checkdb, $_SESSION["userid"]);
            $userComments = mysqli_query($checkdb, "SELECT * FROM comment WHERE authorid='$userId' ORDER BY date DESC");

            if (mysqli_num_rows($userComments) > 0) {
                echo "<h1>My Comments</h1>";
                echo "<table style='width:100%'>";
                echo "<tr><th style='border:2px solid black;'>Post Title</th><th style='border:2px solid black;'>Comment</th><th style='border:2px solid black;'>Comment Date</th><th style='border:2px solid black;'>Actions</th></tr>";

                while ($comment = mysqli_fetch_assoc($userComments)) {
                    $postId = mysqli_real_escape_string($checkdb, $comment["postid"]);
                    $post = mysqli_fetch_assoc(mysqli_query($checkdb, "SELECT * FROM post WHERE id='$postId'"));
                    echo "<tr>";
                    echo "<td class='wordfix' style='border: 2px solid aqua;'><a href='post.php?id=" . $post["id"] . "'>" . htmlspecialchars($post["title"]) . "</a></td>";
                    echo "<td class='wordfix' style='border: 2px solid aqua;'>" . htmlspecialchars($comment["text"]) . "</td>";
                    echo "<td style='border: 2px solid aqua;'>" . htmlspecialchars($comment["date"]) . "</td>";
                    echo "<td style='border: 2px solid aqua;'><a style='color:red;' href='" . $_SERVER['PHP_SELF'] . "?id=" . $comment["id"] . "'>Delete</td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "<div style='text-align:center;'>";
                echo "<h1>My Comments</h1>";
                echo "<h3>You have not commented on any posts yet.</h3>";
                echo "</div>";
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