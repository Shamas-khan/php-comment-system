<?php
$errorMsg = '';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'libs/db.php';

    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty($email) || empty($password)) {
        $errorMsg = 'All fields are required.';
    } else {
        
        $email = mysqli_real_escape_string($con, $email);
        $password = mysqli_real_escape_string($con, $password);

        
        $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
          
            $_SESSION['email'] = $email;
            $cookieExpiration = time() + (7 * 24 * 60 * 60);
            setcookie('user_email', $email, $cookieExpiration, '/');

            header("Location: product.php");

            exit();


        } else {
           
            $errorMsg = 'Invalid email or password. Please try again.';
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
    <form id="loginForm"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h3>Login Here</h3>

        <label for="username">email</label>
        <input type="text" name="email" placeholder="Email or Phone" id="username">

        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Password" id="password">

        <a href="register.php" class='task'>Registerd your self</a>
        <p id="error"><?php echo $errorMsg; ?></p>
        <button type="submit">login</button>

        <div class="social">
          <div class="go"><i class="fab fa-google"></i>  Google</div>
          <div class="fb"><i class="fab fa-facebook"></i>  Facebook</div>
        </div>

       

        
    </form>

   
</body>
</html>