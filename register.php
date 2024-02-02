<?php
$errorMsg = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include 'libs/db.php';


    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["c_password"];


    if (empty($email) || empty($password) || empty($confirmPassword)) {
        $errorMsg = 'All fields are required.';
    } else {

        if ($password != $confirmPassword) {
            $errorMsg = 'Passwords do not match. Please enter matching passwords.';
        } else {

            $insertQuery = "INSERT INTO users (email, password) VALUES ('$email', '$password')";

            if (mysqli_query($con, $insertQuery)) {
                $errorMsg = "Registration successful!";
                mysqli_close($con);
                header("Location: index.php");
                exit();
            } else {
                $errorMsg = "Error: " . $insertQuery . "<br>" . mysqli_error($con);
            }
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



    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <!--Stylesheet-->
    <link rel="stylesheet" href="style.css">
    <title>register</title>

</head>

<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form id="loginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h3>register Here</h3>

        <div id="registrationForm" class="registration-form">
            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="Email" id="email"><br>

            <label for="regPassword">Password:</label>
            <input type="password" name="password" placeholder="Password" id="regPassword"><br>

            <label for="confirmRegPassword">Confirm Password:</label>
            <input type="password" name="c_password" placeholder="Confirm Password" id="confirmRegPassword">
        </div>
        <a href="index.php" class='task'>Already have an account</a>
        <p id="error"><?php echo $errorMsg; ?></p>
        <button class="lastbtn" type="submit">Register</button>
    </form>
</body>

</html>