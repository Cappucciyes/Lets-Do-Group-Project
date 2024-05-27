<html>

<head>
    <link rel="stylesheet" href="css/form.css">
</head>

<body>
    <form action="" id="loginForm" method="post">
        <div class="formBox">
            <label for="username">Username</label>
            <input type="text" name="username" required>
            <label for="password">Password</label>
            <input type="password" name="password" id="passwordInput" required>

            <button type="submit" id="submitButton">Log in</button>
        </div>
    </form>
    <?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
        $db = mysqli_connect('localhost', 'root', '') or die('Unable to connect. Check your connection parameters.');
        mysqli_select_db($db, 'projectSite') or die(mysqli_error($db));
        $inputUsername = $_POST["username"];
        $inputPassword = $_POST["password"];


        $query = "SELECT * FROM student where username = '$inputUsername'";
        $result = mysqli_query($db, $query) or die(mysqli_error($db));
        if (mysqli_num_rows($result) == 0) {
            //https://www.w3schools.com/php/func_mysqli_num_rows.asp
            echo "<script type='text/javascript'>alert('ID does not exist');</script>";
        } else {
            $aboutUser = mysqli_fetch_assoc($result);
            $passwordFromDB = $aboutUser["password"];
            if ($inputPassword != $passwordFromDB) {
                //https://stackoverflow.com/questions/13851528/how-to-pop-an-alert-message-box-using-php
                echo "<script type='text/javascript'>alert('Wrong password');</script>";
            } else {
                //https://stackoverflow.com/questions/768431/how-do-i-make-a-redirect-in-php 
                $_SESSION["currentUser"] = $aboutUser["id"];
                header("Location: homepage.php");
                die();
            }
        }
    }
    ?>
</body>

</html>