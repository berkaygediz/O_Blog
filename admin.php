<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php
    session_start();
    include("connect.php");
    ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | O Blog</title>
    <link rel="icon" type="image/x-icon" href="img/oconom_favicon.png">
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
            $userId = $_SESSION["userid"];

            $authorInfoQuery = $checkdb->prepare("SELECT * FROM author WHERE id = ?");
            $authorInfoQuery->bind_param("i", $userId);
            $authorInfoQuery->execute();
            $authorInfo = $authorInfoQuery->get_result()->fetch_assoc();
            $authorInfoQuery->close();

            if ($authorInfo && $authorInfo["isadmin"] == 1) {
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["category_name"])) {
                    $categoryName = $_POST["category_name"];

                    $addCategoryQuery = $checkdb->prepare("INSERT INTO category (category) VALUES (?)");
                    $addCategoryQuery->bind_param("s", $categoryName);

                    if ($addCategoryQuery->execute()) {
                        $addCategoryQuery->close();
                        header("Location: admin.php");
                        exit();
                    } else {
                        echo "An error occurred while adding the category.";
                    }
                }

                if (isset($_GET["category_id"])) {
                    $categoryId = $_GET["category_id"];

                    // Delete category operation
                    $deleteCategoryQuery = $checkdb->prepare("DELETE FROM category WHERE id = ?");
                    $deleteCategoryQuery->bind_param("i", $categoryId);

                    // Delete posts related to the category
                    $deletePostsQuery = $checkdb->prepare("DELETE FROM post WHERE categoryid = ?");
                    $deletePostsQuery->bind_param("i", $categoryId);

                    // Perform the operations
                    $categoryExistsQuery = $checkdb->prepare("SELECT * FROM category WHERE id = ?");
                    $categoryExistsQuery->bind_param("i", $categoryId);
                    $categoryExistsQuery->execute();
                    $categoryExists = $categoryExistsQuery->get_result()->fetch_assoc();
                    $categoryExistsQuery->close();

                    if ($categoryExists) {
                        $deletePostsQuery->execute();
                        $deleteCategoryQuery->execute();
                        $deletePostsQuery->close();
                        $deleteCategoryQuery->close();

                        header("Location: admin.php");
                        exit();
                    }
                }

                $authorCountQuery = $checkdb->query("SELECT COUNT(*) AS total FROM author");
                $authorCount = $authorCountQuery->fetch_assoc()["total"];
                $authorCountQuery->close();

                $currentDate = date("Y-m-d");
                $oneWeekAgo = date("Y-m-d", strtotime("-1 week"));
                $postCountQuery = $checkdb->prepare("SELECT COUNT(*) AS total FROM post WHERE date BETWEEN ? AND ?");
                $postCountQuery->bind_param("ss", $oneWeekAgo, $currentDate);
                $postCountQuery->execute();
                $postCount = $postCountQuery->get_result()->fetch_assoc()["total"];
                $postCountQuery->close();
                // Page content
                echo "<h1 class='admin-header'>OCONOM Blog - Admin Panel</h1>";
                echo "<div class='admin-content'>";
                echo "<h2 class='admin-header'>Number of Authors: $authorCount</h2>";
                echo "<h2 class='admin-header'>Number of Posts Written in the Last 1 Week: $postCount</h2>";
                echo "<h1 class='admin-header'>Add Category</h1>";
                echo "<form class='category-form' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='POST'>";
                echo "<input type='text' name='category_name' placeholder='Category Name'>";
                echo "<input type='submit' value='Add Category'>";
                echo "</form>";

                echo "<h1 class='admin-header'>Categories</h1>";
                $categoryQuery = $checkdb->query("SELECT * FROM category");
                echo "<div class='category-list'>";
                while ($category = $categoryQuery->fetch_assoc()) {
                    echo "<div class='category-list-item'>";
                    echo htmlspecialchars($category["category"]);
                    echo " - <a class='delete-link' href='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "?category_id=" . $category["id"] . "'>Delete</a>";
                    echo "</div>";
                }
                echo "</div>";
                $categoryQuery->close();

                echo "</div>";
            } else {
                header("Location: login.php");
                exit();
            }
        } else {
            header("Location: login.php");
            exit();
        }
        ?>
    </main>
    <?php
    include("footer.php");
    ?>
</body>


</html>