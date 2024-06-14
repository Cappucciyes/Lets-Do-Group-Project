<link rel="stylesheet" href="css/navbar.css">

<div id="navBar">
    <a href="homepage.php">Homepage</a>
    <?php
    // https://stackoverflow.com/questions/6249707/check-if-php-session-has-already-started
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }


    if (!isset($_SESSION["currentUser"])) {
        echo  "<a href='login.php'>Log in</a>
                    <a href='signup.php'>Sign up</a>";
    } else {
        $currentUserID = $_SESSION["currentUser"];
        echo " <a href='profile.php?student=$currentUserID'>Profile</a>
                    <a href='logout.php'>Log Out</a>";
    }
    ?>

</div>