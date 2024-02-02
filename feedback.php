<?php
session_start();

include 'libs/db.php';

if (!isset($_SESSION['email'])) {
    if (isset($_COOKIE['user_email'])) {
        $_SESSION['email'] = $_COOKIE['user_email'];
    } else {
        header("Location: index.php");
        exit();
    }
}
if (isset($_GET['id'])) {
    $feedbackId = $_GET['id'];
    $query = "SELECT * FROM feedback WHERE id = '$feedbackId'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $feedback = mysqli_fetch_assoc($result);
    } else {
        echo "Feedback not found.";
        exit();
    }
} else {

    echo "Feedback ID is missing.";
    exit();
}

// Ensure $feedback exists before displaying its details
if (!isset($feedback)) {
    echo "Feedback not found.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitComment'])) {
    $commentName = mysqli_real_escape_string($con, $_POST['commentName']);
    $commentContent = mysqli_real_escape_string($con, $_POST['commentContent']);



    $insertCommentQuery = "INSERT INTO comments (feedback_id, user_name, date, content)
                           VALUES ('$feedbackId', '$commentName', NOW(), '$commentContent')";

    if (mysqli_query($con, $insertCommentQuery)) {
        // Comment submitted successfully
        header("Location: feedback.php?id=" . $feedbackId);
        exit();
    } else {
        // Handle comment insertion error
        $errorMessage = "Error submitting comment.";
    }
}

// Fetch comments for the current feedback item
$getCommentsQuery = "SELECT * FROM comments WHERE feedback_id = '$feedbackId' ORDER BY date DESC";
$commentsResult = mysqli_query($con, $getCommentsQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Details</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="productpageback">
        <div class="con">
            <a class="feedbackbtn" href="feedbacks.php">Back to Feedback</a>
            <a class="feedbackbtn" href="logout.php">Logout</a>
        </div>

        <div class="feedback-details">
            <h3>Feedback Details</h3>
            <p><strong>Title:</strong> <?php echo $feedback['title']; ?></p>
            <p>
                <>Description:</ strong> <?php echo $feedback['description']; ?>
            </p>
            <p><strong>Category:</strong> <?php echo $feedback['category']; ?></p>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $feedbackId; ?>" method="post">

            <input type="hidden" name="feedbackId" value="<?php echo $feedbackId; ?>">

            <label for="commentName">Your Name:</label>
            <input type="text" name="commentName" required>

            <label for="commentContent">Comment:</label>
            <textarea name="commentContent" rows="4" required></textarea>

            <button type="submit" name="submitComment">Submit Comment</button>
        </form>


        <?php
        // Display success or error messages
        if (isset($successMessage)) {
            echo '<p class="success-message">' . $successMessage . '</p>';
        }
        if (isset($errorMessage)) {
            echo '<p class="error-message">' . $errorMessage . '</p>';
        }
        ?>

        <!-- Display comments below the feedback details -->
        <div class="comments-section">
            <h3>Comments</h3>
            <ul>
                <?php
                while ($comment = mysqli_fetch_assoc($commentsResult)) {
                    echo '<li>';
                    echo '<p><strong>' . $comment['user_name'] . '</strong> on ' . $comment['date'] . '</p>';
                    echo '<p>' . $comment['content'] . '</p>';
                    echo '</li>';
                }
                ?>
            </ul>
        </div>

    </div>
</body>

</html>