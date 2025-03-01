<?php
include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}

include 'components/add_wishlist.php';
include 'components/add_cart.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer - Search Product page</title>

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
            <h1>Search Product</h1>
            <p>Find your favorite products quickly and easily.</p>
            <span><a href="home.php">Home</a><i class="bx bx-right-arrow-alt"></i>Search Product</span>
        </div>
    </div>
    
    <div class="products">
        <div class="heading">
            <h1>Search Results</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="box-container">
            <?php
            if (isset($_POST['search_product']) && !empty($_POST['search_product'])) {
                $search_input = trim($_POST['search_product']); // Remove extra spaces
                $search_words = explode(" ", $search_input); // Split into words
                $query = "SELECT * FROM products WHERE status = 'active' AND (";

                $conditions = [];
                $params = [];

                foreach ($search_words as $word) {
                    $conditions[] = "name LIKE ?";
                    $params[] = "%$word%"; // Add wildcard for partial match
                }

                $query .= implode(" OR ", $conditions) . ")";
                $select_products = $conn->prepare($query);
                $select_products->execute($params);

                if ($select_products->rowCount() > 0) {
                    while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
                        $product_id = $fetch_products['id'];
            ?>
                        <form action="" method="post" class="box <?php if ($fetch_products['stock'] == 0) { echo "disabled"; } ?>">

                            <img src="uploaded_files/<?= $fetch_products['image']; ?>" class="image">

                            <?php if ($fetch_products['stock'] > 9) { ?>
                                <span class="stock" style="color: green;">In stock</span>
                            <?php } elseif ($fetch_products['stock'] == 0) { ?>
                                <span class="stock" style="color: red;">Out of stock</span>
                            <?php } else { ?>
                                <span class="stock" style="color: red;">Hurry, only <?= $fetch_products['stock']; ?> left</span>
                            <?php } ?>

                            <div class="content">
                                <img src="image/shape-19.png" class="shap">
                                <div class="button">
                                    <div>
                                        <h3 class="name"><?= $fetch_products['name']; ?></h3>
                                    </div>
                                    <div>
                                        <button type="submit" name="add_to_cart"><i class="bx bx-cart"></i></button>
                                        <button type="submit" name="add_to_wishlist"><i class="bx bx-heart"></i></button>
                                        <a href="view_page.php?pid=<?= $fetch_products['id'] ?>" class="bx bxs-show"></a>
                                    </div>
                                </div>
                                <p class="price">Price: $<?= $fetch_products['price']; ?></p>
                                <input type="hidden" name="product_id" value="<?= $fetch_products['id'] ?>">
                                <div class="flex-btn">
                                    <a href="checkout.php?get_id=<?= $fetch_products['id'] ?>" class="btn">Buy Now</a>
                                    <input type="number" name="qty" required min="1" value="1" max="99" maxlength="2" class="qty box">
                                </div>
                            </div>
                        </form>
            <?php
                    }
                } else {
                    echo '
                        <div class="empty">
                            <p>No products found. Try searching with different keywords.</p>
                        </div>
                    ';
                }
            } else {
                echo '
                    <div class="empty">
                        <p>Please enter a search term.</p>
                    </div>
                ';
            }
            ?>
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
