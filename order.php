<?php
include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
    header('location:login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer - User Order Page</title>

    <link rel="stylesheet" type="text/css" href="css/user_style.css?v=<?php echo time(); ?>">
    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Box Icons Link -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>

<body>
    <?php include 'components/user_header.php'; ?>
    
    <div class="banner">
        <div class="detail">
            <h1>My Orders</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit nostrum labore,<br>
                eveniet quasi quaerat dicta repellendus sint fuga dolorum quidem molestiae vel <br>
                animi eius illo, corporis iure assumenda, libero atque! <br>
            </p>
            <span><a href="home.php">Home</a> <i class="bx bx-right-arrow-alt"></i> My Orders</span>
        </div>
    </div>

    <div class="orders">
        <div class="heading">
            <h1>My Orders</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="box-container">
            <?php
            $select_orders = $conn->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY date DESC");
            $select_orders->execute([$user_id]);

            if ($select_orders->rowCount() > 0) {
                while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
                    $product_id = $fetch_orders['product_id'];

                    $select_products = $conn->prepare("SELECT * FROM products WHERE id = ?");
                    $select_products->execute([$product_id]);

                    if ($select_products->rowCount() > 0) {
                        while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
                            // Normalize status
                            $order_status = strtolower(trim($fetch_orders['status']));
                            // Define border colors based on status
                            $border_color = match ($order_status) {
                                'order placed'      => 'blue',
                                'fulfilled'         => 'orange',
                                'shipped'           => 'purple',
                                'out for delivery'  => 'darkorange',
                                'delivered'         => 'green',
                                'cancelled'         => 'red',
                                default             => 'gray'
                            };
                            ?>
                            <div class="box" style="border: 2px solid <?= $border_color; ?>;">
                                <a href="view_order.php?get_id=<?= $fetch_orders['id']; ?>">
                                    <img src="uploaded_files/<?= $fetch_products['image'] ?>" class="image">
                                    <p class="date"> <i class="bx bxs-calendar-alt"></i> <?= $fetch_orders['date']; ?></p>
                                    <div class="content">
                                        <img src="image/shape-19.png" class="shap">
                                        <div class="row">
                                            <h3 class="name"> <?= $fetch_products['name']; ?></h3>
                                            <p class="price">Price: <?= $fetch_products['price'] ?>/-</p>
                                            <p class="status" style="color: <?= $border_color; ?>;">
                                                <?= ucfirst($fetch_orders['status']); ?>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php
                        }
                    }
                }
            } else {
                echo '<p class="empty">No orders yet</p>';
            }
            ?>
        </div>
    </div>

    <?php include 'components/footer.php'; ?>

    <!-- SweetAlert CDN Link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- Custom JS Link -->
    <script src="js/user_script.js"></script>

    <?php include 'components/alert.php'; ?>

</body>
</html>
