<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post | O Blog</title>
    <?php
    session_start();
    include("connect.php"); ?>
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
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $title = mysqli_real_escape_string($checkdb, $_POST["postTitle"]);
                $content = mysqli_real_escape_string($checkdb, $_POST["postContent"]);
                $category = mysqli_real_escape_string($checkdb, $_POST["postCategory"]);
                $userId = $_SESSION["userid"];

                if (!empty($title) && !empty($content) && !empty($category)) {
                    $categoryQuery = mysqli_query($checkdb, "SELECT id FROM category WHERE category = '$category'");

                    if (mysqli_num_rows($categoryQuery) == 1) {
                        $categoryRow = mysqli_fetch_assoc($categoryQuery);
                        $categoryId = $categoryRow["id"];

                        $postQuery = mysqli_query($checkdb, "SELECT * FROM post WHERE title = '$title'");

                        if (mysqli_num_rows($postQuery) == 0) {
                            $insertQuery = mysqli_query($checkdb, "INSERT INTO post (title, text, authorid, categoryid) VALUES ('$title', '$content', '$userId', '$categoryId')");

                            if ($insertQuery) {
                                header("Location: my-posts.php");
                                exit;
                            } else {
                                echo "An error occurred while creating the post.";
                            }
                        } else {
                            $_SESSION["error"] = true;
                            header("Location: create.php");
                            exit;
                        }
                    } else {
                        $_SESSION["error"] = true;
                        header("Location: create.php");
                        exit;
                    }
                } else {
                    $_SESSION["error"] = true;
                    header("Location: create.php");
                    exit;
                }
            } else {
                echo "<h1 class='page-title-custom'>Create Content</h1>";

                $categoryQuery = mysqli_query($checkdb, "SELECT * FROM category");

                if (mysqli_num_rows($categoryQuery) == 0) {
                    echo "<p class='error-message-custom'>ERROR: The site is undergoing maintenance.</p>";
                } else {
                    echo "<p class='welcome-message-custom'><b>" . $_SESSION["username"] . "</b>, you can write your article and share your ideas with the world.</p>";
                    echo "<p class='error-message-custom'>To create a post, please fill out the form below.</p>";
                    echo "<div class='form-container-custom'>";
                    echo "<form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='POST'>";
                    echo "<input type='text' name='postTitle' placeholder='Title' class='form-title-custom' maxlength='100' required><br><br>";
                    echo "<textarea name='postContent' placeholder='Content' class='form-text-custom' maxlength='3500' required></textarea><br><br>";
                    echo "<b>Category:</b> <select name='postCategory' class='form-check-custom'>";
                    echo "<option value='0'>Select</option>";
                    while ($category = mysqli_fetch_assoc($categoryQuery)) {
                        echo "<option value='" . $category["category"] . "'>" . $category["category"] . "</option>";
                    }
                    echo "</select><br><br>";
                    echo "<input type='submit' value='Create' class='submit-button-custom'>";
                    echo "</form>";
                    echo "</div>";
                }
                if (isset($_SESSION["error"]) && $_SESSION["error"] == true) {
                    $_SESSION["error"] = false;
                    echo "<p class='error-message-custom'>* Please fill in all fields to create a post.</p><br>";
                }
            }
        } else {
            header("Location: login.php");
            exit;
        }
        ?>
    </main>
    <?php
    include("footer.php");
    ?>
</body>

</html>