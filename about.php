<?php
include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer - About Us Page</title>
    <link rel="stylesheet" type="text/css" href="css/user_style.css">
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- box icon cdn link -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>

<body>
    <?php include 'components/user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>About Us</h1>
            <p>Lorem Ipsum is simply dummy text of the printing and
                typesetting industry.</p>
            <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>about us</span>
        </div>
    </div>
    <!-- story section start -->
    <div class="chef">
        <div class="box-container">
            <div class="box">
                <div class="heading">
                    <span>Alex Doe</span>
                    <h1>Masterchef</h1>
                    <img src="image/separator-img.png">
                </div>
                <p>Maria is a Roman-born pastry chef who spent 15 years in his city Rome perfecting
                    his craft and exceptional creations. Vestibulum rhoncus ornare tincidunt. Etiam
                    pretium metus sit amet est aliquet vulputate. Fusce et cursus ligula. Sed accumsan
                    dictum porta. Aliquam rutrum ullamcorper velit hendrerit convallis.</p>
                <div class="flex-btn">
                    <a href="" class="btn">explore our menu</a>
                    <a href="menu.php" class="btn">visit our shop</a>
                </div>
            </div>
            <div class="box">
                <img src="image/ceaf.png" class="img">
            </div>
        </div>
    </div>

    <!-- story section start -->
    <div class="story">
        <div class="heading">
            <h1>our story</h1>
            <img src="image/separator-img.png">
        </div>
        <p>Lorem Ipsum is simply dummy text of the printing and <br>
            typesetting industry. Lorem Ipsum has been the industry's <br>
            standard dummy text ever since the 1500s, when an unknown <br>
            printer took a galley of type and scrambled it to make <br>
            aype specimen book.</p>
        <a href="menu.php" class="btn">our service</a>
    </div>
    <div class="container">
        <div class="box-container">
            <div class="img-box">
                <img src="image/about.png">
            </div>
            <div class="box">
                <div class="heading">
                    <h1>Taking Ice Cream To New Heights</h1>
                    <img src="image/separator-img.png">
                </div>
                <p>Lorem Ipsum is simply dummy text of the printing and
                    typesetting industry. Lorem Ipsum has been the industry's
                    standard dummy text ever since the 1500s, when an unknown
                    printer took a galley of type and scrambled it to make
                    aype specimen book.</p>
                <a href="" class="btn">Learn more</a>
            </div>
        </div>
    </div>
    <!-- story section end -->

    <div class="team">
        <div class="heading">
            <span>our team</span>
            <h1>Quality & passion with our service</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="box-container">
            <div class="box">
                <img src="image/team-1.jpg" class="img">
                <div class="content">
                    <img src="image/shape-19.png" class="shap">
                    <h2>Ralph Johnson</h2>
                    <p>Coffee Chef</p>
                </div>
            </div>
            <div class="box">
                <img src="image/team-2.jpg" class="img">
                <div class="content">
                    <img src="image/shape-19.png" class="shap">
                    <h2>Fiona Johnson</h2>
                    <p>Pastry Chef</p>
                </div>
            </div>
            <div class="box">
                <img src="image/team-3.jpg" class="img">
                <div class="content">
                    <img src="image/shape-19.png" class="shap">
                    <h2>Tom Knelltonns</h2>
                    <p>Coffee Chef</p>
                </div>
            </div>
        </div>
    </div>
    <!-- team section end -->

    <div class="standers">
        <div class="detail">
            <div class="heading">
                <h1>our standers</h1>
                <img src="image/separator-img.png">
            </div>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            <i class="bx bxs-heart"></i>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            <i class="bx bxs-heart"></i>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            <i class="bx bxs-heart"></i>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            <i class="bx bxs-heart"></i>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            <i class="bx bxs-heart"></i>
        </div>
    </div>
    <!-- standers section end -->

    <div class="testimonial">
        <div class="heading">
            <h1>testimonial</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="testimonial-container">
            <div class="slide-row" id="slide">
                <div class="slide-col">
                    <div class="user-text">
                        <p>Zen Doan is a business anlayst, entrepreneur and media proprietor, and
                            investor. She also known as the best selling book author.
                        </p>
                        <h2>Zen</h2>
                        <p>Author</p>
                    </div>
                    <div class="user-img">
                        <img src="image/testimonial (1).jpg">
                    </div>
                </div>
                <div class="slide-col">
                    <div class="user-text">
                        <p>Zen Doan is a business anlayst, entrepreneur and media proprietor, and
                            investor. She also known as the best selling book author.
                        </p>
                        <h2>Zen</h2>
                        <p>Author</p>
                    </div>
                    <div class="user-img">
                        <img src="image/testimonial (2).jpg">
                    </div>
                </div>
                <div class="slide-col">
                    <div class="user-text">
                        <p>Zen Doan is a business anlayst, entrepreneur and media proprietor, and
                            investor. She also known as the best selling book author.
                        </p>
                        <h2>Zen</h2>
                        <p>Author</p>
                    </div>
                    <div class="user-img">
                        <img src="image/testimonial (3).jpg">
                    </div>
                </div>
                <div class="slide-col">
                    <div class="user-text">
                        <p>Zen Doan is a business anlayst, entrepreneur and media proprietor, and
                            investor. She also known as the best selling book author.
                        </p>
                        <h2>Zen</h2>
                        <p>Author</p>
                    </div>
                    <div class="user-img">
                        <img src="image/testimonial (4).jpg">
                    </div>
                </div>
            </div>
        </div>
        <div class="indicator">
            <span class="btn1 active"></span>
            <span class="btn1"></span>
            <span class="btn1"></span>
            <span class="btn1"></span>
        </div>
    </div>
    <!-- testiomonial section end -->

    <div class="mission">
        <div class="box-container">
            <div class="box">
                <div class="heading">
                    <h1>our mission</h1>
                    <img src="image/separator-img.png">
                </div>
                <div class="detail">
                    <div class="img-box">
                        <img src="image/mission.webp">
                    </div>
                    <div>
                        <h2>maxicon chocolate</h2>
                        <p>Layers of shaped marshmallow candies - bunnies, chicks, and simple flowers-
                            make a memorable gift in a beribboned box
                        </p>
                    </div>
                </div>
                <div class="detail">
                    <div class="img-box">
                        <img src="image/mission1.webp">
                    </div>
                    <div>
                        <h2>vanilla with honey</h2>
                        <p>Layers of shaped marshmallow candies - bunnies, chicks, and simple flowers-
                            make a memorable gift in a beribboned box
                        </p>
                    </div>
                </div>
                <div class="detail">
                    <div class="img-box">
                        <img src="image/mission0.jpg">
                    </div>
                    <div>
                        <h2>pappermint chip</h2>
                        <p>Layers of shaped marshmallow candies - bunnies, chicks, and simple flowers-
                            make a memorable gift in a beribboned box
                        </p>
                    </div>
                </div>
                <div class="detail">
                    <div class="img-box">
                        <img src="image/mission2.webp">
                    </div>
                    <div>
                        <h2>rasberry sorbat</h2>
                        <p>Layers of shaped marshmallow candies - bunnies, chicks, and simple flowers-
                            make a memorable gift in a beribboned box
                        </p>
                    </div>
                </div>
            </div>
            <div class="box">
                <img src="image/form.png" class="img">
            </div>
        </div>
    </div>
    <!-- mission section end -->







    <!-- sweetalert cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- custom js link -->
    <script src="../icecream_shop/js/user_script.js"></script>

    <?php include 'components/footer.php'; ?>

    <?php include 'components/alert.php'; ?>
</body>

</html>