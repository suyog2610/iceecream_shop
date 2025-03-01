<?php
include 'components/connect.php';

    if (isset($_COOKIE['user_id'])) {
        $user_id = $_COOKIE['user_id'];
    }else{
        $user_id = '';
    }

    if(isset($_POST['submit'])) {
        $id = unique_id();
        $name = $_POST['name'];
        // $name = filter_var($name, FILTER_SANITIZE_STRING);
        $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');

        $email = $_POST['email'];
        // $email = filter_var($email, FILTER_SANITIZE_STRING);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL); 

        $pass = $_POST['pass'];
        // $pass = filter_var($pass, FILTER_SANITIZE_STRING);

        $cpass = $_POST['cpass'];
        // $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

        $image = $_FILES['image']['name'];
        // $image = filter_var($image, FILTER_SANITIZE_STRING);
        $image = htmlspecialchars($image, ENT_QUOTES, 'UTF-8');
        $ext = pathinfo($image, PATHINFO_EXTENSION);
        $rename = unique_id().'.'.$ext;
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = 'uploaded_files/'.$rename;

        $select_users = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $select_users->execute([$email]);

        if ($select_users->rowCount() > 0){
            $warning_msg[] = 'email already exists!';
        } else{
            if ($pass != $cpass){
                $warning_msg[] = 'confirm password does not match';
            } else{
                $insert_seller = $conn->prepare("INSERT INTO users (id, name, email, password, image) VALUES (?, ?, ?, ?, ?)");
                $insert_seller->execute([$id, $name, $email, $cpass, $rename]);
                move_uploaded_file($image_tmp_name, $image_folder);
                $success_msg[] = 'New user registered! Please login now';
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer - User Registration page</title>

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
            <h1>register</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit nostrum labore,<br>
                eveniet quasi quaerat dicta repellendus sint fuga dolorum quidem molestiae vel <br>
                animi eius illo, corporis iure assumenda, libero atque! <br>
            </p>
            <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>register</span>
        </div>
    </div>

    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data" class="register">
            <h3>Register now</h3>
            <div class="flex">
                <div class="col">
                    <div class="input-field">
                        <p>Your name <span>*</span></p>
                        <input type="text" name="name" placeholder="enter your name" maxlength="50"
                            required class="box">
                    </div>
                    <div class="input-field">
                        <p>Your email <span>*</span></p>
                        <input type="email" name="email" placeholder="enter your email" maxlength="50"
                            required class="box">
                    </div>
                </div>

                <div class="col">
                    <div class="input-field">
                        <p>Your password <span>*</span></p>
                        <input type="password" name="pass" placeholder="enter your password" maxlength="50"
                            required class="box">
                    </div>
                    <div class="input-field">
                        <p>confirm password <span>*</span></p>
                        <input type="password" name="cpass" placeholder="enter your confirm password" maxlength="50"
                            required class="box">
                    </div>
                </div>
            </div>
            <div class="input-field">
                <p>Your Profile <span>*</span></p>
                <input type="file" name="image" accept="image/*" required class="box">
            </div>
            <p class="link">Already have an account? <a href="login.php">Login now</a> </p>
            <input type="submit" name="submit" value="register now" class="btn">
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