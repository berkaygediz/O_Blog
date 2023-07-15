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
    <title>
        <?php
        $username = isset($_GET['username']) ? $_GET['username'] : null;
        if ($username !== null && !empty($username)) {
            $username = mysqli_real_escape_string($checkdb, $username);
            $query = "SELECT * FROM author WHERE username = '$username'";
            $result = mysqli_query($checkdb, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);
                $title = htmlspecialchars($user['username']);
                echo $title;
            } else {
                echo "Invalid User";
            }
        } else {
            echo "Invalid Username";
        }
        ?> | O Blog
    </title>
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
        <div id="profile"
            style="background: linear-gradient(45deg, purple, rgb(128, 0, 167), rgb(149, 0, 194), yellow); color: black;">
            <div class="profile-item">
                <?php
                if (isset($_GET["username"])) {
                    $username = $_GET["username"];
                    $authorQuery = mysqli_prepare($checkdb, "SELECT * FROM author WHERE username = ?");
                    mysqli_stmt_bind_param($authorQuery, "s", $username);
                    mysqli_stmt_execute($authorQuery);
                    $result = mysqli_stmt_get_result($authorQuery);

                    if (mysqli_num_rows($result) > 0) {
                        $authorData = mysqli_fetch_assoc($result);
                        echo $authorData["username"];
                    } else {
                        echo "Author not found.";
                    }
                } else {
                    echo "Author not found.";
                }
                ?>
            </div>
            <div id="contact" style="clear:both; padding-top:2%;position:relative; float: left; color: white;"></div>
            <div id="profile-info">
                <div style="clear:both; padding-left:1%;padding-top: 1%; color: wheat;"><b>Number of posts:</b>
                    <?php
                    if (isset($_GET["username"])) {
                        $username = $_GET["username"];
                        $postCountQuery = mysqli_prepare($checkdb, "SELECT COUNT(*) FROM post INNER JOIN author ON post.authorid = author.id WHERE author.username = ?");
                        mysqli_stmt_bind_param($postCountQuery, "s", $username);
                        mysqli_stmt_execute($postCountQuery);
                        $result = mysqli_stmt_get_result($postCountQuery);
                        $row = mysqli_fetch_array($result);
                        $postCount = $row[0];
                        echo $postCount;
                    } else {
                        echo "-";
                    }
                    ?>
                </div>
            </div>
            <div class="context" style="margin-top: 2%;">
                <hr>
                <h1>Posts</h1>
                <?php
                if (isset($_GET["username"])) {
                    $username = $_GET["username"];
                    $postsQuery = mysqli_prepare($checkdb, "SELECT * FROM author INNER JOIN post ON post.authorid = author.id WHERE author.username = ?");
                    mysqli_stmt_bind_param($postsQuery, "s", $username);
                    mysqli_stmt_execute($postsQuery);
                    $result = mysqli_stmt_get_result($postsQuery);

                    if (mysqli_num_rows($result) > 0) {
                        echo "<table style='width:100%;'>";
                        echo "<tr><th>Title</th><th>Date</th></tr>";
                        while ($post = mysqli_fetch_assoc($result)) {
                            echo "<tr style='color:white;'><td><a style='word-break:break-all;' href='post.php?id=" . $post["id"] . "'>" . $post["title"] . "</a></td><td>" . $post["date"] . "</td></tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "Posts could not be loaded.";
                    }
                } else {
                    echo "Posts could not be loaded.";
                }
                ?>
            </div>
        </div>
        <?php
        if (isset($_GET["deleteaccount"])) {
            if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
                $authorId = $_SESSION["userid"];

                if (isset($_GET["deleteaccount"])) {
                    $deleteCommentsQuery = mysqli_prepare($checkdb, "DELETE FROM comment WHERE authorid = ?");
                    mysqli_stmt_bind_param($deleteCommentsQuery, "i", $authorId);
                    mysqli_stmt_execute($deleteCommentsQuery);

                    $deletePostsQuery = mysqli_prepare($checkdb, "DELETE FROM post WHERE authorid = ?");
                    mysqli_stmt_bind_param($deletePostsQuery, "i", $authorId);
                    mysqli_stmt_execute($deletePostsQuery);

                    $deleteAuthorQuery = mysqli_prepare($checkdb, "DELETE FROM author WHERE id = ?");
                    mysqli_stmt_bind_param($deleteAuthorQuery, "i", $authorId);
                    mysqli_stmt_execute($deleteAuthorQuery);

                    if (mysqli_stmt_affected_rows($deleteCommentsQuery) > 0 && mysqli_stmt_affected_rows($deletePostsQuery) > 0 && mysqli_stmt_affected_rows($deleteAuthorQuery) > 0) {
                        header("Location: logout.php");
                    } else {
                        header("Location: logout.php");
                    }
                }
            } else {
                header("Location: profile.php?username=" . $_SESSION["username"]);
            }
        }
        ?>

        <?php
        if (isset($_GET["username"]) && !(isset($_GET["deleteaccount"]))) {
            if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
                if ($_SESSION["username"] == $_GET["username"]) {
                    echo "<div style='margin-top: 2%;''><a href='" . $_SERVER['PHP_SELF'] . "?username=" . $_SESSION["username"] . "&deleteaccount=1' style='color: red;''>Delete my account</a></div>";
                } else {
                }
            }
        } else {
        }
        ?>
    </main>
    <?php
    include("footer.php");
    ?>
</body>

</html>