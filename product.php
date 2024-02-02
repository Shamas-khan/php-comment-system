<?php

session_start();


if (!isset($_SESSION['email'])) {

    if (isset($_COOKIE['user_email'])) {
        $_SESSION['email'] = $_COOKIE['user_email'];
    } else {

        header("Location: index.php");
        exit();
    }
}
$errorMsg = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include 'libs/db.php';


    $title = $_POST["title"];
    $description = $_POST["description"];
    $category = $_POST["category"];


    if (empty($title) || empty($description) || empty($category)) {
        $errorMsg = 'All fields are required.';
    } else {
        $insertQuery = "INSERT INTO feedback (title, description,category) VALUES ('$title', '$description','$category')";
        if (mysqli_query($con, $insertQuery)) {
            $errorMsg = "feedback successfully submitted!";
        } else {
            $errorMsg = "Error: " . $insertQuery . "<br>" . mysqli_error($con);
        }
    }





    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>product</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="productpageback">
        <div class="con">
            <a class="feedbackbtn" href="feedbacks.php">View feedback</a>
            <a class="feedbackbtn" href="logout.php">Logout</a>

        </div>
        <form id="loginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <h3>Feedback</h3>

            <label for="username">title</label>
            <input type="text" name="title" placeholder="titlee" id="username">

            <label for="password">description</label>
            <input type="text" name="description" placeholder="description" id="password">

            <label for="browser">category</label>
            <input list="browsers" name="category" id="browser" placeholder="Select category">
            <datalist id="browsers">
                <option value="bug report">
                <option value=" feature request">
                <option value="improvement">

            </datalist>


            <p id="error"><?php echo $errorMsg; ?></p>
            <button type="submit">submit feedback</button>






        </form>



    </div>
</body>

</html>