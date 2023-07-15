<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | O Blog</title>
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
    </header>
    <main>
        <?php
        session_start();
        $error_message = "";
        if (isset($_SESSION["loggedin"]) && ($_SESSION["loggedin"] == true)) {
            header('Location: index.php');
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include("connect.php");

            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"];

            $username_check = mysqli_real_escape_string($checkdb, $username);
            $email_check = mysqli_real_escape_string($checkdb, $email);
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            if (!filter_var($email_check, FILTER_VALIDATE_EMAIL)) {
                $_SESSION["error"] = true;
                $_SESSION["error_message"] = "Invalid email format";
                header('Location: register.php');
                exit;
            }

            $username_query = mysqli_query($checkdb, "SELECT * FROM author WHERE username='$username_check'");
            $email_query = mysqli_query($checkdb, "SELECT * FROM author WHERE email='$email_check'");

            if (mysqli_num_rows($username_query) > 0) {
                $_SESSION["error_message"] = "Username already exists";
                header('Location: register.php');
                exit;
            }

            if (mysqli_num_rows($email_query) > 0) {
                $_SESSION["error_message"] = "Email already exists";
                header('Location: register.php');
                exit;
            }

            if (mysqli_num_rows($username_query) == 0 && mysqli_num_rows($email_query) == 0) {
                $insert = mysqli_prepare($checkdb, "INSERT INTO author (username, email, password) VALUES (?, ?, ?)");
                mysqli_stmt_bind_param($insert, "sss", $username_check, $email_check, $password_hash);

                if (mysqli_stmt_execute($insert)) {
                    $user_id = mysqli_insert_id($checkdb);
                    $_SESSION["loggedin"] = true;
                    $_SESSION["userid"] = $user_id;
                    $_SESSION["username"] = $username_check;
                    $_SESSION["email"] = $email_check;
                    mysqli_stmt_close($insert);
                    mysqli_close($checkdb);

                    header('Location: index.php');
                    exit;
                } else {
                    echo "Error: " . mysqli_error($checkdb);
                }
            } else {
                $_SESSION["error_message"] = "Username or email already exists";
                header('Location: register.php');
                exit;
            }
        }
        ?>

        <form class="register-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST"
            enctype="multipart/form-data">
            <h1>Register</h1>
            <h4>Join the unlimited content world of <b style="background: -webkit-linear-gradient(#E8F6EF, #FFE194);
        -webkit-background-clip: text;background-clip: text;    
        -webkit-text-fill-color: transparent; font-weight:bold;">O Blog</b>!</h4>
            <?php
            if (isset($_SESSION["error_message"])) {
                echo '<p style="color: red;">' . $_SESSION["error_message"] . '</p>';
                unset($_SESSION["error_message"]);
            }
            ?>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Register">
            <p style="margin-top: 0.5vh;">Already have an account?<br><a href="login.php"
                    style="text-decoration:none; color:white; font-weight:bold; padding: top 1vh; font-size: 1.2rem; text-shadow: 2px 2px #ff0000;">Log
                    In</a></p>
        </form>
    </main>
    <?php
    include("footer.php");
    ?>
</body>

</html>