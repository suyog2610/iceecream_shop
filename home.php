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
    <title>Blue Sky Summer - Home Page</title>
    <link rel="stylesheet" type="text/css" href="css/user_style.css">
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- box icon cdn link -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>

<body>
    <?php include 'components/user_header.php'; ?>

    <!-- slider section start -->
    <div class="slider-container">
        <div class="slider">
            <div class="slideBox active">
                <div class="textBox">
                    <h1>we pride ourselfs on <br> exceptional flavours</h1>
                    <a href="menu.php" class="btn">shop now</a>
                </div>
                <div class="imgBox">
                    <img src="image/slider.jpg">
                </div>
            </div>
            <div class="slideBox">
                <div class="textBox">
                    <h1>cold treats are my kind <br> of comfort food</h1>
                    <a href="menu.php" class="btn">shop now</a>
                </div>
                <div class="imgBox">
                    <img src="image/slider0.jpg">
                </div>
            </div>
        </div>
        <ul class="controls">
            <li onclick="nextSlide();" class="next"> <i class="bx bx-right-arrow-alt"></i></li>
            <li onclick="prevSlide();" class="prev"> <i class="bx bx-left-arrow-alt"></i></li>
        </ul>
    </div>
    <!-- slider section end -->

    <div class="service">
        <div class="box-container">
            <!-- service item box -->
            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/services.png" class="img1">
                        <img src="image/services (1).png" class="img2">
                    </div>
                </div>
                <div class="detail">
                    <h4>delivery</h4>
                    <span>100% secure</span>
                </div>
            </div>
            <!-- service item box -->
            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/services (2).png" class="img1">
                        <img src="image/services (3).png" class="img2">
                    </div>
                </div>
                <div class="detail">
                    <h4>payment</h4>
                    <span>100% secure</span>
                </div>
            </div>
            <!-- service item box -->
            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/services (5).png" class="img1">
                        <img src="image/services (6).png" class="img2">
                    </div>
                </div>
                <div class="detail">
                    <h4>support</h4>
                    <span>24*7 hours</span>
                </div>
            </div>
            <!-- service item box -->
            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/services (7).png" class="img1">
                        <img src="image/services (8).png" class="img2">
                    </div>
                </div>
                <div class="detail">
                    <h4>gift service</h4>
                    <span>support gift service</span>
                </div>
            </div>
            <!-- service item box -->
            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/service.png" class="img1">
                        <img src="image/service (1).png" class="img2">
                    </div>
                </div>
                <div class="detail">
                    <h4>returns</h4>
                    <span>24*7 free return</span>
                </div>
            </div>
            <!-- service item box -->
            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/services.png" class="img1">
                        <img src="image/services (1).png" class="img2">
                    </div>
                </div>
                <div class="detail">
                    <h4>deliver</h4>
                    <span>100% secure</span>
                </div>
            </div>
        </div>
    </div>
    <!-- service section end -->

    <div class="categories">
        <div class="heading">
            <h1>categories features</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="box-container">
            <div class="box">
                <img src="image/categories.jpg">
                <a href="menu.php" class="btn">coconuts</a>
            </div>
            <div class="box">
                <img src="image/categories0.jpg">
                <a href="menu.php" class="btn">chocolate</a>
            </div>
            <div class="box">
                <img src="image/categories2.jpg">
                <a href="menu.php" class="btn">strawberry</a>
            </div>
            <div class="box">
                <img src="image/categories1.jpg">
                <a href="menu.php" class="btn">cone</a>
            </div>
        </div>
    </div>
    <!-- categories section end -->

    <img src="image/menu-banner.jpg" class="menu-banner">

    <div class="taste">
        <div class="heading">
            <span>Taste</span>
            <h1>buy any ice-cream @ get one free</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="box-container">
            <div class="box">
                <img src="image/taste.webp">
                <div class="detail">
                    <h2>natural sweetness</h2>
                    <h1>mango</h1>
                </div>
            </div>
            <div class="box">
                <img src="image/taste0.webp">
                <div class="detail">
                    <h2>natural sweetness</h2>
                    <h1>matcha</h1>
                </div>
            </div>
            <div class="box">
                <img src="image/taste1.webp">
                <div class="detail">
                    <h2>natural sweetness</h2>
                    <h1>blueberry</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Taste section end -->

    <div class="ice-container">
        <div class="overlay">
            <div class="detail">
                <h1>Ice cream is cheaper than <br> therapy for stress</h1>
                <p>Treat yourself to a scoop of happiness! Whether you're having a 
                    rough day or just craving something sweet, our wide range of delicious 
                    ice creams is the perfect pick-me-up. Because sometimes, all you need 
                    is a spoon and your favorite flavor.</p>
                <a href="menu.php" class="btn">shop now</a>
            </div>
        </div>
    </div>
    <!-- container section end -->

    <div class="taste2">
        <div class="t-banner">
            <div class="overlay"></div>
            <div class="detail">
                <h1>find your taste of desserts</h1>
                <p>Treat them to a delicious treat and send them some Luck 'o the Irish too!</p>
                <a href="menu.php" class="btn">shop now</a>
            </div>
        </div>
        <div class="box-container">
            <div class="box">
                <div class="box-overlay"></div>
                <img src="image/type6.jpeg">
                <div class="box-details fadeIn-bottom">
                    <h1>Falooda</h1>
                    <p>find your taste of desserts</p>
                    <a href="menu.php" class="btn">explore more</a>
                </div>
            </div>
            <div class="box">
                <div class="box-overlay"></div>
                <img src="image/type7.jpeg">
                <div class="box-details fadeIn-bottom">
                    <h1>pan</h1>
                    <p>find your taste of desserts</p>
                    <a href="menu.php" class="btn">explore more</a>
                </div>
            </div>
            <div class="box">
                <div class="box-overlay"></div>
                <img src="image/type8.jpeg">
                <div class="box-details fadeIn-bottom">
                    <h1>sitafal</h1>
                    <p>find your taste of desserts</p>
                    <a href="menu.php" class="btn">explore more</a>
                </div>
            </div>
            <div class="box">
                <div class="box-overlay"></div>
                <img src="image/type9.jpeg">
                <div class="box-details fadeIn-bottom">
                    <h1>fruit overload</h1>
                    <p>find your taste of desserts</p>
                    <a href="menu.php" class="btn">explore more</a>
                </div>
            </div>
            <div class="box">
                <div class="box-overlay"></div>
                <img src="image/type10.jpeg">
                <div class="box-details fadeIn-bottom">
                    <h1>american dry fruit</h1>
                    <p>find your taste of desserts</p>
                    <a href="menu.php" class="btn">explore more</a>
                </div>
            </div>
            <div class="box">
                <div class="box-overlay"></div>
                <img src="image/type11.jpeg">
                <div class="box-details fadeIn-bottom">
                    <h1>tutti fruti</h1>
                    <p>find your taste of desserts</p>
                    <a href="menu.php" class="btn">explore more</a>
                </div>
            </div>
        </div>
    </div>
    <!-- taste2 section end -->

    <div class="flavor">
        <div class="box-container">
            <img src="image/left-banner2.webp">
            <div class="detail">
                <h1>Hot Deal ! Sale Up To <span>20% off</span></h1>
                <p>expired</p>
                <a href="menu.php" class="btn">shop now</a>
            </div>
        </div>
    </div>
    <!-- flavour section end -->

    <div class="usage">
        <div class="heading">
            <h1>how it works</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="row">
            <div class="box-container">
                <div class="box">
                    <img src="image/icon.avif">
                    <div class="detail">
                        <h3>Browse Brands</h3>
                        <p>Explore a variety of top ice cream brands all in one place — from local favorites to global names.</p>
                    </div>
                </div>
                <div class="box">
                    <img src="image/icon0.avif">
                    <div class="detail">
                        <h3>Choose Your Flavors</h3>
                        <p>Pick from hundreds of flavors, from classic vanilla to exotic and limited-edition treats.</p>
                    </div>
                </div>
                <div class="box">
                    <img src="image/icon1.avif">
                    <div class="detail">
                        <h3>Check Product Details</h3>
                        <p>View flavor descriptions, sizes, and pricing to find the perfect ice cream for you.</p>
                    </div>
                </div>
            </div>
            <img src="image/sub-banner.png" class="divider">
            <div class="box-container">
                <div class="box">
                    <img src="image/icon2.avif">
                    <div class="detail">
                        <h3>Add to Cart</h3>
                        <p>Review your selections and easily add them to your cart with a click.</p>
                    </div>
                </div>
                <div class="box">
                    <img src="image/icon3.avif">
                    <div class="detail">
                        <h3>Checkout Securely</h3>
                        <p>Enter delivery details and make a secure payment using your preferred method.</p>
                    </div>
                </div>
                <div class="box">
                    <img src="image/icon4.avif">
                    <div class="detail">
                        <h3>Get It Delivered</h3>
                        <p>Sit back and relax while we deliver your ice cream frozen and fresh — right to your doorstep</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- usage section end -->

    <div class="pride">
        <div class="detail">
            <h1>We Pride Ourselves On <br> Exceptional Flavors.</h1>
            <p></p>
            <a href="menu.php" class="btn">shop now</a>
        </div>
    </div>
    <!-- pride section end -->





    <!-- sweetalert cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- custom js link -->
    <script src="../icecream_shop/js/user_script.js"></script>

    <?php include 'components/footer.php'; ?>

    <?php include 'components/alert.php'; ?>
</body>

</html>