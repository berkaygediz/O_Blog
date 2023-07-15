<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | O Blog</title>
    <?php
    include("connect.php");
    session_start();
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
    </header>
    <main>
        <?php
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
            header('Location: index.php');
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["email"]) && isset($_POST["password"])) {
                $email = mysqli_real_escape_string($checkdb, $_POST["email"]);
                $password = mysqli_real_escape_string($checkdb, $_POST["password"]);

                $query = "SELECT * FROM author WHERE email = ? AND password = ?";
                $stmt = $checkdb->prepare($query);
                $stmt->bind_param("ss", $email, $password);
                $stmt->execute();
                $result = $stmt->get_result();
                $user = $result->fetch_assoc();
                $stmt->close();

                if ($result->num_rows > 0 && $user["email"] == $email && $user["password"] == $password) {
                    $_SESSION["loggedin"] = true;
                    $_SESSION["userid"] = $user["id"];
                    $_SESSION["email"] = $user["email"];
                    $_SESSION["username"] = $user["username"];
                    mysqli_close($checkdb);

                    header('Location: index.php');
                    exit;
                } else {
                    $_SESSION["error"] = true;
                    header('Location: login.php');
                    exit;
                }
            } else {
                $_SESSION["error"] = true;
                header('Location: login.php');
                exit;
            }
        }
        ?>

        <form class="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST"
            enctype="multipart/form-data">
            <h1 class="form-header">Log In</h1>
            <h4><b>
                    <script>
                        const slogans = [
                            "The voice of writers, the heart of readers.",
                            "We are changing the world with our writings.",
                            "Life's realities through the pens of our writers.",
                            "We write to read, we read to write.",
                            "Our writers' pens shape your thoughts.",
                            "We add color to your life with our writings.",
                            "Our writers' words will open your mind.",
                            "The world through the eyes of our readers.",
                            "Our writers' creativity pushes the boundaries.",
                            "We are changing your life with our writings.",
                            "Our writers' words will uplift your thoughts.",
                            "We make a place in the hearts of our readers.",
                            "Our writers' pens illuminate your life.",
                            "We shape your thoughts with our writings.",
                            "Our writers' words will leave a mark in your mind.",
                            "We touch the lives of our readers.",
                            "Our writers' creativity will surprise you.",
                            "We explore the world with our writings."
                        ];

                        const slogan = slogans[Math.floor(Math.random() * slogans.length)];

                        document.write(slogan);
                    </script>
                </b></h4>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Log In"><a href="#" class="forgot-password-link"
                onclick="alert('Mail server is not available.');">Forgot Password</a>

            <?php
            if (isset($_SESSION["error"]) && $_SESSION["error"] == true) {
                echo "<p class='error-message'>Incorrect email or password.</p>";
                $_SESSION["error"] = false;
            }
            ?>

            <p class="signup-link">Don't have an account?<br><a href="register.php" class="signup-link-text">Sign Up</a>
            </p>
        </form>
    </main>
    <?php
    include("footer.php");
    ?>
</body>

</html>