<?php
session_start();

if (!isset($_SESSION["currentUser"])) {
    echo "<script type='text/javascript'>confirm('Log in before you make a new project!');</script>";
    header("Location: login.php");
    die();
}
?>

<html>

<head>
    <link rel="stylesheet" href="css/form.css">
</head>

<body>
    <form action="" id="openProjectForm" method="post">
        <div class="formBox">
            <label for="proejectName">Project name</label>
            <input type="text" name="projectName" id="inputProjectName" required>

            <fieldset>
                <legend>Do you want this project visible to everyone? :</legend>
                <input type="radio" name="isPublic" value="true" required>
                <label for="true">Yes (make it public)</label>
                <input type="radio" name="isPublic" value="false">
                <label for="true">No (make it private)</label>
            </fieldset>

            <button type="submit" id="submitButton">open project</button>
        </div>
    </form>

    <script>
        //https://developer.mozilla.org/en-US/docs/Web/API/Fetch_API/Using_Fetch
        // async function formCheck() {
        //     let response = await fetch("checkDuplicates.php?checkFor=project&projectName=" + document.getElementById("inputProjectName").value);
        //     let jsonResponse = await response.json();

        //     if (jsonResponse.duplicates) {
        //         alert("You already opened")
        //     }

        // }

        // let projectForm = document.getElementById("openProjectForm");

        // projectForm.addEventListener("submit", () => {})
    </script>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
        $db = mysqli_connect('localhost', 'root', '') or die('Unable to connect. Check your connection parameters.');
        mysqli_select_db($db, 'projectSite') or die(mysqli_error($db));

        $opener = $_SESSION["currentUser"];
        $name = $_POST["projectName"];
        $isPublic = $_POST["isPublic"];

        $query = "INSERT INTO project (opener, name, isPublic, isClosed) VALUES ('$opener', '$name', $isPublic, false)";
        $result = mysqli_query($db, $query) or die(mysqli_error($db));

        if ($result) {
            $getProjectQuery = "SELECT id FROM project WHERE opener = '$opener' AND name='$name' ORDER BY id DESC";
            $queryResult =  mysqli_query($db, $getProjectQuery) or die(mysqli_error($db));
            $projectID = mysqli_fetch_assoc($queryResult)["id"];
            $updateMemberQuery = "INSERT INTO projectmembers (groupID, memberID) VALUES ('$projectID', '$opener') ";

            $queryResult =  mysqli_query($db, $updateMemberQuery) or die(mysqli_error($db));

            header("Location: projectThread.php?projectID=$projectID");
            die();
        }
    }
    ?>
</body>

</html>