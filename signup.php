<html>

<head>
    <link rel="stylesheet" href="css/form.css">
</head>

<body>
    <form action="" method="post" id="signupForm">
        <div class="formBox">
            <label for="username">Username</label>
            <input type="text" name="username" required>
            <label for="password">Password</label>
            <input type="password" name="password" id="passwordInput" required>
            <label for="passwordCheck">Check password</label>
            <input type="password" name="passwordCheck" id="passwordCheckInput" required>
            <button type="submit" id="submitButton">Create New Account!</button>
        </div>
    </form>
    <script>
        //https://www.youtube.com/watch?v=In0nB0ABaUk
        let signupForm = document.getElementById("signupForm");
        signupForm.addEventListener("submit", (e) => {

            let password = document.getElementById("passwordInput").value;
            let passwordCheck = document.getElementById("passwordCheckInput").value;
            if (password != passwordCheck) {
                alert("Check your password!");
                e.preventDefault();
            }

        });
    </script>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
        $db = mysqli_connect('localhost', 'root', '') or die('Unable to connect. Check your connection parameters.');
        mysqli_select_db($db, 'projectSite') or die(mysqli_error($db));

        $newUsername = $_POST["username"];
        $newPassword = $_POST["password"];
        echo "successfully got username:$newUsername, password:$newPassword";
        $query = "INSERT INTO student (username, password) values ('$newUsername', '$newPassword')";
        mysqli_query($db, $query) or die(mysqli_error($db));
    }
    ?>

</body>

</html>