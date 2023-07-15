<?php
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
    echo "<div class='nav-container'>";
    echo "<a href='index.php' class='nav-element'>Explore</a>";
    echo "<a href='authors.php' class='nav-element'>Authors</a>";
    echo "<a href='my-posts.php' class='nav-element'>My Posts</a>";
    echo "<a href='my-comments.php' class='nav-element'>My Comments</a>";
    echo "<img><a class='nav-element'href='profile.php?username=" . $_SESSION["username"] . "'>" . $_SESSION["username"] . "</a></div>";
    echo "<a href='logout.php' class='nav-element'>Logout</a>";
    echo "</div>";
} else {
    echo "<div class='nav-container'>";
    echo "<a href='login.php' class='nav-element'>Log In</a>";
    echo "<a href='register.php' class='nav-element'>Sign Up</a>";
    echo "</div>";
}
?>