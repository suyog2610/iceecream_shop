<?php
include 'components/connect.php';

    if (isset($_COOKIE['user_id'])) {
        $user_id = $_COOKIE['user_id'];
    }else{
        $user_id = '';
    }

    // sending message

    if(isset($_POST['send_message'])){
        if ($user_id != '') {
            $id = unique_id();
            $name =$_POST['name'];
            $name = filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS);

            $email = $_POST['email'];
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);

            $subject = $_POST['subject'];
            $subject = filter_var($subject, FILTER_SANITIZE_SPECIAL_CHARS);

            $message = $_POST['message'];
            $message = filter_var($subject, FILTER_SANITIZE_SPECIAL_CHARS);

            $verify_message = $conn->prepare("SELECT * FROM message WHERE user_id = ? AND 
                name=? AND email = ? AND subject = ? AND message = ?");
                $verify_message->execute([$user_id, $name, $email, $subject, $message]);

                if ($verify_message->rowCount() > 0) {
                    $warning_msg[] = 'Message already exist';
                }else{
                    $insert_message = $conn->prepare("INSERT INTO message (id, user_id, name, email, subject, message)
                        VALUES (?, ?, ?, ? ,?, ?)");
                    $insert_message->execute([$id, $user_id, $name, $email, $subject, $message]);

                    $success_msg[] = 'Comment inserted successfully';
                }
        }else {
            $warning_msg[] = 'Please login first';
        }
    }
    

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer - Contact Us page</title>

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
            <h1>Contact Us</h1>
            <p>Have a question, feedback, or just want to say hello? We'd love to hear from you! <br>
            Reach out to us anytime — our team is here to help make your ice cream experience even sweeter.<br>
            </p>
            <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>Contact Us</span>
        </div>
    </div>
    <div class="services">
        <div class="heading">
            <h1>Our services</h1>
            <p>Just A Few Click To Make The Reservation Online For Saving Your Time And Money</p>
            <img src="image/separator-img.png">
        </div>
        <div class="box-container">
            <div class="box">
                <img src="image/0.png">
                <div>
                    <h1>free fast shipping</h1>
                    <p>Get your favorite ice creams delivered quickly and absolutely free! 
                        We ensure every order arrives frozen, fresh, and right on time — because great taste shouldn't wait.</p>
                </div>
            </div>
            <div class="box">
                <img src="image/1.png">
                <div>
                    <h1>money back guarantee</h1>
                    <p>Not satisfied with your order? No worries! We offer a 100% money-back guarantee 
                        to ensure you enjoy every scoop with confidence. Your happiness is our priority!</p>
                </div>
            </div>
            <div class="box">
                <img src="image/2.png">
                <div>
                    <h1>online support 24/7</h1>
                    <p> We're always here to help, anytime you need us!</p>
                </div>
            </div>
        </div>
    </div>
    <div class="form-container">
        <div class="heading">
            <h1>drop us a line</h1>
            <p>Just A Few Click To Make The Reservation Online For Saving Your Time And Money</p>
            <img src="image/separator-img.png">
        </div>
        <form action="" method="post" class="register">
            <div class="input-field">
                <label>name <sup>*</sup></label>
                <input type="text" name="name" required placeholder="Enter your name" class="box">
            </div>
            <div class="input-field">
                <label>email <sup>*</sup></label>
                <input type="email" name="email" required placeholder="Enter your email" class="box">
            </div>
            <div class="input-field">
                <label>subject <sup>*</sup></label>
                <input type="text" name="subject" required placeholder="Reason..." class="box">
            </div>
            <div class="input-field">
                <label>comment <sup>*</sup></label>
                <textarea name="message" cols="30" rows="10" required placeholder="" class="box"></textarea>
            </div>
            <button type="submit" name="send_message" class="btn">send message</button>
        </form>
    </div>

    <div class="address">
        <div class="heading">
            <h1>Our contact details</h1>
            <p>Just A Few Click To Make The Reservation Online For Saving Your Time And Money</p>
            <img src="image/separator-img.png">
        </div>
        <div class="box-container">
            <div class="box">
                <i class="bx bxs-map-alt"></i>
                <div>
                    <h4>address</h4>
                    <p>Mumbai, Maharashtra</p>
                </div>
            </div>
            <div class="box">
                <i class="bx bxs-phone-incoming"></i>
                <div>
                    <h4>phone number</h4>
                    <p>9999999999</p>
                    <p> </p>
                </div>
            </div>
            <div class="box">
                <i class="bx bxs-envelope"></i>
                <div>
                    <h4>email</h4>
                    <p>icecream@gmail.com</p>
                    <p></p>
                </div>
            </div>
        </div>
    </div>
    




    <?php include 'components/footer.php'; ?>

    <!-- sweetalert cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- custom js link -->
    <script src="js/user_script.js"></script>

    <?php include 'components/alert.php'; ?>

</body>

</html>