<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authors | O Blog</title>
    <?php include("connect.php"); ?>
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
        session_start();
        include("nav.php");
        ?>
    </header>
    <main>
        <?php
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
            $authors = mysqli_query($checkdb, "SELECT * FROM author ORDER BY regdate DESC");

            if (mysqli_num_rows($authors) > 0) {
                echo "<h1>Authors</h1>";
                echo "<div style='clear: both;'></div>";
                echo "<table style='width: 100%; border-collapse: collapse;'>";
                echo "<tr> <th style='border: 2px solid black; padding: 10px;'>Username</th> <th style='border: 2px solid black; padding: 10px;'>Post Count</th> <th style='border: 2px solid black; padding: 10px;'>Registration Date</th> </tr>";

                while ($author = mysqli_fetch_assoc($authors)) {
                    $postCount = mysqli_query($checkdb, "SELECT COUNT(*) as post_count FROM post WHERE authorid=" . $author["id"]);
                    $postCount = mysqli_fetch_assoc($postCount);
                    $totalPosts = $postCount["post_count"];

                    echo "<tr>";
                    echo "<td style='border: 2px solid aqua; padding: 10px;'><a href='profile.php?username=" . $author["username"] . "'>" . $author["username"] . "</a></td>";
                    echo "<td style='border: 2px solid aqua; padding: 10px;'>" . $totalPosts . "</td>";
                    echo "<td style='border: 2px solid aqua; padding: 10px;'>" . $author["regdate"] . "</td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "<h1>Authors</h1>";
                echo "<p>No authors found.</p>";
            }
        } else {
            echo "<h1>Authors</h1>";
            echo "<p>You must be logged in to view this page.</p>";
        }
        ?>
    </main>
    <?php
    include("footer.php");
    ?>
</body>

</html>