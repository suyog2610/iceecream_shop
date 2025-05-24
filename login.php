<?php
include 'components/connect.php';

    if (isset($_COOKIE['user_id'])) {
        $user_id = $_COOKIE['user_id'];
    }else{
        $user_id = '';
    }

    if(isset($_POST['submit'])) {
        $email = $_POST['email'];
        // $email = filter_var($email, FILTER_SANITIZE_STRING);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL); 

        $pass = $_POST['pass'];
        // $pass = filter_var($pass, FILTER_SANITIZE_STRING);

        $select_user = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
        $select_user->execute([$email, $pass]);
        $row = $select_user->fetch(PDO::FETCH_ASSOC);

        if ($select_user-> rowCount() > 0) {  
            setcookie('user_id', $row['id'], time() + 60*60*24*30, '/');
            header('location:home.php');
        }else{
            $warning_msg[] = 'Incorrect email or password';
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer - User Login page</title>

    <link rel="stylesheet" type="text/css" href="css/user_style.css?v=<?php echo time(); ?>">
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- box icons link -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>

<body>
    <?php include 'components/user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>Login</h1>
            <p>Log in to explore your favorite ice cream flavors, track orders, and enjoy a smoother, <br>
                faster checkout experience. Your next scoop of happiness is just a click away!<br>
            </p>
            <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>Login</span>
        </div>
    </div>

    <div class="form-container">
    <form action="" method="post" enctype="multipart/form-data" class="login">
            <h3>Login now</h3>
            <div class="input-field">
                <p>Your email <span>*</span></p>
                <input type="email" name="email" placeholder="enter your email" maxlength="50" 
                required class="box">
            </div>

            <div class="input-field">
                <p>Your password <span>*</span></p>
                <input type="password" name="pass" placeholder="enter your password" maxlength="50" 
                required class="box">
            </div>

            <p class="link">Do not have an account? <a href="register.php">Register now</a> </p>
            <input type="submit" name="submit" value="login now" class="btn">
        </form>
    </div>




    <?php include 'components/footer.php'; ?>

    <!-- sweetalert cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- custom js link -->
    <script src="js/user_script.js"></script>

    <?php include 'components/alert.php'; ?>

</body>

</html>