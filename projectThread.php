<?php
session_start();

if (!isset($_GET["projectID"])) {
    echo "<script type='text/javascript'>alert('Project not specified');</script>";
    header("Location: homepage.php");
    die();
}

$currentUser;
if (!isset($_SESSION["currentUser"])) {
    $currentUser = 'guest';
} else {
    $currentUser = $_SESSION["currentUser"];
}
?>
<html>

<head>
    <link rel="stylesheet" href="css/thread.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bodyMain.css">
</head>

<body>
    <div class="bodyMain">
        <?php include "navbar.php"; ?>
        This is thread page for project
        <?php
        $db = mysqli_connect('localhost', 'root', '') or die('Unable to connect. Check your connection parameters.');
        mysqli_select_db($db, 'projectSite') or die(mysqli_error($db));
        $projectID = $_GET['projectID'];
        $query = "SELECT * FROM project WHERE id =$projectID ;";
        $result = mysqli_query($db, $query) or die(mysqli_error($db));
        $projectData = mysqli_fetch_assoc($result);

        $projectName = $projectData["name"];
        $projectOpenerID = $projectData["opener"];

        echo " <script>console.log('projectID : , openerID = ')</script>";


        $query = "SELECT username FROM student, project WHERE student.id = '$projectOpenerID'";
        $result = mysqli_query($db, $query) or die(mysqli_error($db));
        $projectOpener = mysqli_fetch_assoc($result)["username"];


        echo ": $projectName by : $projectOpener";


        $isCurrentUserMember = mysqli_num_rows(mysqli_query($db, "SELECT * FROM projectmembers WHERE groupID = $projectID AND memberID=$currentUser")) > 0;
        if (!$isCurrentUserMember && !$projectData["isPublic"]) {
            echo "<br>This is a private project. You need to be a member first to see the content<br>";
            echo "<a href='homepage.php'>Go back to homepage</a>";
        } else {
            //populate comment function
            function populateComment($currentDB, $currentPostID)
            {
                $findCommentsQuery = "SELECT * FROM comment WHERE postID = $currentPostID ORDER BY id ASC";
                $commentResult = mysqli_query($currentDB, $findCommentsQuery);
                while ($commentData = mysqli_fetch_assoc($commentResult)) {
                    echo "<div>";
                    $commentBody = $commentData["body"];
                    $commentAuthorID = $commentData["authorID"];
                    //find comment author username
                    $findCommentAuthorQuery = "SELECT username FROM student WHERE id = $commentAuthorID";
                    $findCommentAuthorResult = mysqli_query($currentDB, $findCommentAuthorQuery) or die(mysqli_error($currentDB));
                    $authorName = mysqli_fetch_assoc($findCommentAuthorResult)["username"];
                    echo "<p style ='padding:0px;'><strong>From : $authorName</strong></p>";
                    echo "<p style ='padding:0px;'>$commentBody</p>";
                    echo "</div>";
                }
            }


            //fill out the page with posts
            $getAllPostQuery = "SELECT * FROM threadpost WHERE groupID = $projectID";
            $posts = mysqli_query($db, $getAllPostQuery) or die(mysqli_error($db));
            while ($postData = mysqli_fetch_assoc($posts)) {
                $body = $postData["body"];
                $authorID = $postData["authorID"];
                $findAuthorQuery = "SELECT username FROM student WHERE id = $authorID";

                $findAuthorResult = mysqli_query($db, $findAuthorQuery) or die(mysqli_error($db));
                $authorName = mysqli_fetch_assoc($findAuthorResult)["username"];
                $postID = $postData['id'];

                echo "<div class='postDiv'>
                <div class='postBodyDiv'>
                    <h3>From : $authorName</h3>
                    <p>$body</p>
                </div>
                        
                <div class='interactionDiv'>
                    <h5>Comments:</h5>
                    <div class='commentDiv'>";
                populateComment($db, $postID);
                echo        "</div>";
                // show interaction buttons to group memebers      
                echo "      <div>";
                if ($currentUser == 'guest') {
                    echo         "Log in to interact with this post!";
                } else if (mysqli_num_rows(mysqli_query($db, "SELECT * FROM projectmembers WHERE groupID = $projectID AND memberID=$currentUser")) > 0) {
                    echo        "<a href='addComment.php?postID=$postID'><button>Make Comment</button></a>";
                } else {
                    echo         "You need to be a member to leave comments! ";
                }
                echo "      </div>";
                echo    "</div>";
                echo    "</div>";
            }

            if ($projectData["isClosed"]) {
                echo "<p>this Project is closed!</p>";
                if (mysqli_num_rows(mysqli_query($db, "SELECT * FROM projectmembers WHERE groupID = $projectID AND memberID=$currentUser")) > 0) {
                    echo "<br> <p>Would you like to re-open it? </p> <form action='?action=reopen&projectID=$projectID' method='post'><input type='text' name='projectID' value='$projectID' hidden><button style='color: green;'>Reopen!</button></form> ";
                }
            } else if ($currentUser == 'guest') {
                echo "Log in to make Post!";
            } else if ($isCurrentUserMember) {
                echo        "<br><button id='postButton'>Make Posts</button>";
                echo "<a href='manageProject.php?projectID=$projectID'><button>Manage Project!</button></a>";
            } else {
                echo "You need to be a member to make post! ";
            }
        }


        ?>
    </div>



</body>
<script>
    let postButton = document.getElementById("postButton");
    postButton.addEventListener("click", () => {
        //https://developer.mozilla.org/en-US/docs/Web/API/Location/search
        const urlQueryString = new URLSearchParams(window.location.search);
        let projectID = parseInt(urlQueryString.get("projectID"));


        window.location.href = "addPost.php?projectID=" + projectID;
    });
</script>
<?php
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    if ($_GET['action'] == 'reopen') {
        $reopenQuery = "UPDATE project SET isClosed = 0 WHERE id = $projectID";
        mysqli_query($db, $reopenQuery);

        header("Location: projectThread.php?projectID=$projectID");
        die();
    }
}
?>

</html>