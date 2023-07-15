<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post | O Blog</title>
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
        if (isset($_SESSION["loggedin"]) && ($_SESSION["loggedin"] == true)) {
            $userId = $_SESSION["userid"];
            if (isset($_GET["postid"])) {
                $postId = $_GET["postid"];
                echo "<h1>Edit Your Post</h1>";
                $postQuery = mysqli_prepare($checkdb, "SELECT * FROM post WHERE id = ?");
                mysqli_stmt_bind_param($postQuery, "i", $postId);
                mysqli_stmt_execute($postQuery);
                $postResult = mysqli_stmt_get_result($postQuery);
                $post = mysqli_fetch_assoc($postResult);

                if ($post["authorid"] == $userId) {
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $title = $_POST['title'];
                        $text = $_POST['text'];

                        $title = mysqli_real_escape_string($checkdb, $title);
                        $title = htmlspecialchars($title);
                        $text = mysqli_real_escape_string($checkdb, $text);
                        $text = htmlspecialchars($text);

                        if (empty($title) || empty($text)) {
                            echo "Title and text cannot be empty.";
                            exit;
                        }

                        $updateQuery = mysqli_prepare($checkdb, "UPDATE post SET title = ?, text = ? WHERE id = ?");
                        mysqli_stmt_bind_param($updateQuery, "ssi", $title, $text, $postId);
                        $updateResult = mysqli_stmt_execute($updateQuery);

                        if ($updateResult) {
                            header("Location: post.php?id=" . $postId);
                            exit;
                        } else {
                            echo "An error occurred while updating the post.";
                        }
                    }

                    echo "<form action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "?postid=" . $postId . "' method='POST'>
                <input type='text' name='title' value='" . $post["title"] . "' placeholder='Title' required><br><br>
                <textarea name='text' placeholder='Text' required>" . $post["text"] . "</textarea><br><br>
                <input type='submit' value='Edit Post'>
            </form>";
                } else {
                    echo "You are not authorized to edit this post.";
                }
            } else {
                echo "Post ID is missing.";
            }
        } else {
            header("Location: login.php");
        }
        ?>
    </main>
    <?php
    include("footer.php");
    ?>
</body>

</html>