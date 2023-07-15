<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    session_start();
    include("connect.php");
    ?>
    <link rel="stylesheet" href="css/style.css">
    <title>
        <?php
        $postId = isset($_GET['id']) ? $_GET['id'] : null;
        if ($postId !== null && is_numeric($postId)) {
            $postId = mysqli_real_escape_string($checkdb, $postId);
            $query = "SELECT * FROM post WHERE id = $postId";
            $result = mysqli_query($checkdb, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $post = mysqli_fetch_assoc($result);
                $title = htmlspecialchars($post['title']);
                echo substr($title, 0, 30) . "...";
            } else {
                echo "Invalid Post";
            }
        } else {
            echo "Invalid Post ID";
        }
        ?> | O Blog
    </title>
    <link rel="icon" type="image/x-icon" href="img/o_favicon.png">
</head>

<body>
    <header>
        <div class="navbar-icon">
            <a href="index.php" style="text-decoration: none; display: flex; align-items: center;">
                <img src="img/o_favicon.png">
                <h1 class="navbar-title">Blog</h1>
            </a>
        </div>
        <?php
        include("nav.php");
        ?>
    </header>
    <main>
        <?php
        $postId = $_GET["id"];
        $postQuery = mysqli_prepare($checkdb, "SELECT * FROM post WHERE id = ?");
        mysqli_stmt_bind_param($postQuery, "i", $postId);
        mysqli_stmt_execute($postQuery);
        $postResult = mysqli_stmt_get_result($postQuery);

        if (mysqli_num_rows($postResult) > 0) {
            $post = mysqli_fetch_assoc($postResult);
            echo '<div class="blog-post">';
            echo '<div class="blog-post-container-title">' . $post["title"] . '</div>';
            echo '<div class="blog-post-container-content">' . $post["text"] . '</div>';
            echo '<div class="blog-post-container-detail">';
            echo '<div class="blog-post-detail-item">👤Author:</div>';

            $authorQuery = mysqli_prepare($checkdb, "SELECT * FROM author WHERE id = ?");
            mysqli_stmt_bind_param($authorQuery, "i", $post["authorid"]);
            mysqli_stmt_execute($authorQuery);
            $authorResult = mysqli_stmt_get_result($authorQuery);

            if (mysqli_num_rows($authorResult) > 0) {
                $author = mysqli_fetch_assoc($authorResult);
                echo '<a href="profile.php?username=' . $author["username"] . '" class="blog-post-author-link">' . $author["username"] . '</a>';
            } else {
                echo '<div class="blog-post-author-link">Author not found.</div>';
            }

            echo '<div class="blog-post-detail-item">🔍Category:</div>';

            $categoryQuery = mysqli_prepare($checkdb, "SELECT * FROM category WHERE id = ?");
            mysqli_stmt_bind_param($categoryQuery, "i", $post["categoryid"]);
            mysqli_stmt_execute($categoryQuery);
            $categoryResult = mysqli_stmt_get_result($categoryQuery);

            if (mysqli_num_rows($categoryResult) > 0) {
                $category = mysqli_fetch_assoc($categoryResult);
                echo '<div class="blog-post-detail-item">' . $category["category"] . '</div>';
            } else {
                echo '<div class="blog-post-category-item">Category not found.</div>';
            }

            echo '<div class="blog-post-detail-item">📅Publication Date:</div>';
            echo '<div class="blog-post-detail-item">' . $post["date"] . '</div>';
            echo '</div>';

            if (isset($_SESSION["loggedin"]) && ($_SESSION["loggedin"] == true)) {
                $commentsQuery = mysqli_prepare($checkdb, "SELECT * FROM comment INNER JOIN author ON comment.authorid = author.id WHERE comment.postid = ? ORDER BY comment.id DESC");
                mysqli_stmt_bind_param($commentsQuery, "i", $postId);
                mysqli_stmt_execute($commentsQuery);
                $commentResult = mysqli_stmt_get_result($commentsQuery);

                if (mysqli_num_rows($commentResult) > 0) {
                    echo '<div class="blog-post-comment-section">';
                    echo '<div class="blog-post-comments">Comments (' . mysqli_num_rows($commentResult) . ')</div>';

                    while ($comment = mysqli_fetch_assoc($commentResult)) {
                        echo '<div class="blog-post-comment">';
                        echo '<div class="blog-post-comment-author"><a href="profile.php?username=' . $comment["username"] . '">' . $comment["username"] . '</a></div>';
                        echo '<div class="blog-post-comment-text">' . $comment["text"] . '</div>';
                        echo '<div class="blog-post-comment-date">' . $comment["date"] . '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<div class="blog-post-comment-section">';
                    echo '<div class="blog-post-comments">Comments</div>';
                    echo '<div>No comments yet.</div>';
                }

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $comment = trim($_POST['comment']);
                    $authorId = $_SESSION["userid"];

                    $comment = mysqli_real_escape_string($checkdb, $comment);
                    $comment = htmlspecialchars($comment);

                    if (empty($comment)) {
                        echo "Comment cannot be empty.";
                        exit;
                    }

                    $commentQuery = mysqli_prepare($checkdb, "INSERT INTO comment (text, postid, authorid) VALUES (?, ?, ?)");
                    mysqli_stmt_bind_param($commentQuery, "sii", $comment, $postId, $authorId);
                    $commentResult = mysqli_stmt_execute($commentQuery);

                    if ($commentResult) {
                        header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $_GET["id"]);
                        exit;
                    } else {
                        echo "An error occurred.";
                    }
                }

                echo '<div class="blog-post-comment-form">';
                echo '<b>' . $_SESSION["username"] . ':</b>';
                echo '<form action="' . htmlspecialchars($_SERVER['PHP_SELF']) . '?id=' . $_GET["id"] . '" method="POST">';
                echo '<textarea name="comment" maxlength="150"></textarea><br>';
                echo '<input type="submit" value="Submit Comment">';
                echo '</form>';
                echo '</div>';
            } else {
                echo '<div style="padding-top: 4vh; padding-bottom: 4vh;">To write a comment, <a href="login.php" style="color:black;">login</a> or <a href="register.php" style="color:black;">register</a>.</div>';
            }

            echo '</div>';
        } else {
            echo 'Post not found.';
        }
        ?>
        <div style="clear: both;"></div>
    </main>
    <?php
    include("footer.php");
    ?>
</body>

</html>