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

include 'libs/db.php';

// Fetch feedback data from the database
$selectQuery = "SELECT * FROM feedback";
$result = mysqli_query($con, $selectQuery);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>feedbacks</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="productpageback">
        <div class="con">
            <a class="feedbackbtn" href="feedbacks.php">View feedback</a>
            <a class="feedbackbtn" href="logout.php">Logout</a>

        </div>

        <table>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Category</th>
            </tr>

            <?php
            // Display feedback data in a table
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['title'] . "</td>";
                echo "<td>" . $row['description'] . "</td>";
                echo "<td>" . $row['category'] . "</td>";
                echo "<td><a href='feedback.php?id=" . $row['id'] . "'>View comments</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
</body>

</html>