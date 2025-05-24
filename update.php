<?php
include 'components/connect.php';

    if (isset($_COOKIE['user_id'])) {
        $user_id = $_COOKIE['user_id'];
    }else{
        $user_id = '';
    }

    if(isset($_POST['submit'])){
        $select_user = $conn->prepare("SELECT * FROM users WHERE id = ? LIMIT 1");
        $select_user->execute([$user_id]);
        $fetch_user = $select_user->fetch((PDO::FETCH_ASSOC));

        $prev_pass = $fetch_user['password'];
        $prev_image = $fetch_user['image'];

        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS);

        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_SPECIAL_CHARS);

        // update name
        if (!empty($name)) {
            $update_name = $conn->prepare("UPDATE users SET name = ? WHERE id = ?");
            $update_name->execute([$name, $user_id]);
            $success_msg[] = 'Username Updated Successfully';
        }

        //update email
        if (!empty($empty)) {
            $select_email = $conn->prepare("SELECT * FROM users WHERE id = ? AND email = ?");
            $select_email->execute([$user_id, $email]);

            if ($select_email->rowCount() > 0) {
                $warning_msg[] = 'Email already exist';
            }else{
                $update_email = $conn->prepare("UPDATE users SET email = ? WHERE id = ?");
                $update_email->execute($email, $user_id);
                $success_msg[] = 'Email Updated Successfully';
            }
        }

        //update image
        $image = $_FILES['image']['name'];
        $image = filter_var($image, FILTER_SANITIZE_SPECIAL_CHARS);
        $ext = pathinfo($image, PATHINFO_EXTENSION);
        $rename = unique_id().'.'.$ext;
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = 'uploaded_files/'.$rename;

        if (!empty($image)) {
            if($image_size > 2000000){
                $warning_msg[] = 'Image size is too large';
            }else{
                $update_image = $conn->prepare("UPDATE users SET image = ? WHERE id  = ?");
                $update_image->execute([$rename, $user_id]);
                move_uploaded_file($image_tmp_name, $image_folder);

                if ($prev_image != '' AND $prev_image != $rename) {
                    unlink('uploaded_files/'.$prev_image);
                }
                $success_msg[] = 'Image Updated Successfully';
            }
        }

        //update password
        $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';

        $old_pass = ($_POST['old_pass']);
        $old_pass = filter_var($old_pass, FILTER_SANITIZE_SPECIAL_CHARS);

        $new_pass = ($_POST['new_pass']);
        $new_pass = filter_var($new_pass, FILTER_SANITIZE_SPECIAL_CHARS);

        $cpass = ($_POST['cpass']);
        $cpass = filter_var($cpass, FILTER_SANITIZE_SPECIAL_CHARS);

        if ($old_pass != $empty_pass) {
            if ($old_pass != $prev_pass) {
                $warning_msg[] = 'Old password not matched';
            }elseif($new_pass != $cpass){
                $warning_msg[] = 'Password not matched';
            }else {
                if ($new_pass != $empty_pass) {
                    $update_pass = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
                    $update_pass->execute([$cpass, $user_id]);
                    $success_msg[] = 'Password updated successfully';
                }else{
                    $warning_msg[] = 'Please enter a new password';
                }
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer - Update Profile Login page</title>

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
            <h1>Update Profile</h1>
            <p>Keep your information up-to-date! You can easily change your name, email,<br>
                 profile photo, and password (both old and new) to ensure your account is 
                 always current and secure.<br>
            </p>
            <span><a href="home.php">home</a> <i class="bx bx-right-arrow-alt"></i> Profile <i class="bx bx-right-arrow-alt"></i> Update Profile </span>
        </div>
    </div>
    <section class="form-container">
        <div class="heading">
            <h1>update profile details</h1>
            <img src="image/separator-img.png">
        </div>
            <form action="" method="post" enctype="multipart/form-data" class="register">
                <div class="img-box">
                    <img src="uploaded_files/<?= $fetch_profile['image']; ?>" >
                </div>
                <div class="flex">
                    <div class="col">
                        <div class="input-field">
                            <p>your name <span>*</span></p>
                            <input type="text" name="name" placeholder="<?= $fetch_profile['name']; ?>"
                            class="box">
                        </div>
                        <div class="input-field">
                            <p>your email <span>*</span></p>
                            <input type="email" name="email" placeholder="<?= $fetch_profile['email']; ?>"
                            class="box">
                        </div>
                        <div class="input-field">
                            <p>select pic <span>*</span></p>
                            <input type="file" name="image" accept="image/*" class="box">
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-field">
                            <p>old password <span>*</span></p>
                            <input type="password" name="old_pass" placeholder="enter your old password"
                            class="box" maxlength="20">
                        </div>
                        <div class="input-field">
                            <p>new password <span>*</span></p>
                            <input type="password" name="new_pass" placeholder="enter your new password"
                            class="box" maxlength="20">
                        </div>
                        <div class="input-field">
                            <p>confirm password <span>*</span></p>
                            <input type="password" name="cpass" placeholder="confirm your password"
                            class="box" maxlength="20">
                        </div>
                    </div>
                </div>
                <input type="submit" name="submit" value="update profile" class="btn">
            </form>
    </section>
    




    <?php include 'components/footer.php'; ?>

    <!-- sweetalert cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- custom js link -->
    <script src="js/user_script.js"></script>

    <?php include 'components/alert.php'; ?>

</body>

</html>