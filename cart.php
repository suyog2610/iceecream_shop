<?php
include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = 'location:login.php';
}

//update qty in cart
if (isset($_POST['update_cart'])){

    $cart_id = $_POST['cart_id'];
    $cart_id = filter_var($cart_id, FILTER_SANITIZE_SPECIAL_CHARS);

    $qty = $_POST['qty'];
    $qty = filter_var($qty, FILTER_SANITIZE_SPECIAL_CHARS);

    $update_qty = $conn->prepare("UPDATE cart SET qty = ? WHERE id = ?");
    $update_qty->execute([$qty, $cart_id]);

    $success_msg[] = 'Cart quantity updated';
}

// delete products from cart

if (isset($_POST['delete_item'])){
    $cart_id = $_POST['cart_id'];
    $cart_id = filter_var($cart_id, FILTER_SANITIZE_SPECIAL_CHARS);

    $verify_delete_item = $conn->prepare("SELECT * FROM cart WHERE id  = ?");
    $verify_delete_item->execute([$cart_id]);

    if ($verify_delete_item->rowCount() > 0){
        $delete_cart_id = $conn->prepare("DELETE FROM cart WHERE id = ?");
        $delete_cart_id->execute([$cart_id]);

        $success_msg[] = 'Cart item deleted';
    }else{
        $warning_msg[] = 'Cart item already deleted';
    }
}

// empty cart

if (isset($_POST['empty_cart'])){

    $verify_empty_item = $conn->prepare("SELECT * FROM cart WHERE user_id  = ?");
    $verify_empty_item->execute([$user_id]);

    if ($verify_empty_item->rowCount() > 0){

        $delete_cart_id = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
        $delete_cart_id->execute([$user_id]);

        $success_msg[] = 'Empty cart successfully';
    }else {
        $warning_msg[] = 'Your cart is already empty';
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer - User Cart page</title>

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
            <h1>cart</h1>
            <p>The Cart stores selected ice cream products that a logged-in user intends to purchase. <br>
                 Users can view item details, update quantities, remove items, and proceed to checkout. <br>
                 It provides a clear summary of the order before final payment. <br>
            </p>
            <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>cart</span>
        </div>
    </div>
    <div class="products">
        <div class="heading">
            <h1>my cart</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="box-container">
            <?php
                $grand_total = 0;
                $select_cart = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
                $select_cart->execute([$user_id]);

                if ($select_cart->rowcount() > 0) {
                    while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
                        $select_products = $conn->prepare("SELECT * FROM products WHERE id = ?");
                        $select_products->execute([$fetch_cart['product_id']]);

                        if($select_products->rowCount() > 0 ){
                            $fetch_products = $select_products->fetch(PDO::FETCH_ASSOC);
                        
            ?>
            <form action="" method="post" class="box <?php if($fetch_products['stock'] == 0){echo'disabled';}; ?>">
                <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
                <img src="uploaded_files/<?= $fetch_products['image']; ?>" class="image">
                <?php if($fetch_products['stock'] > 9){ ?>
                    <span class="stock" style="color: green;">In stock</span>
                <?php }elseif($fetch_products['stock'] == 0){ ?>
                    <span class="stock" style="color: red;">out of stock</span>
                <?php }else{ ?>
                    <span class="stock" style="color: red;">Hurry, only <?= $fetch_products['stock']; ?> left</span>
                <?php } ?>
                <div class="content">
                    <img src="image/shape-19.png" class="shap">
                    <h3 class="name"> <?= $fetch_products['name']; ?> </h3>
                    <div class="flex-btn">
                        <p class="price">price ₹<?= $fetch_products['price']; ?>/- </p>
                        <input type="number" name="qty" required min="1" 
                            value="<?= $fetch_cart['qty'] ?>" max="99" maxlength="2" class="box qty">
                        <button type="submit" name="update_cart" class="bx bxs-edit fa-edit box"></button>
                    </div>
                    <div class="flex-btn">
                        <p class="sub-total">sub total : <span>₹<?= $sub_total =($fetch_cart['qty']
                            *$fetch_cart['price']); ?></span>
                        </p>
                        <button type="submit" name="delete_item" class="btn" 
                            onclick="return confirm('Remove from cart?');">delete
                        </button>
                    </div>
                </div>
            </form> 
            <?php
                        $grand_total += $sub_total;
                        }else{
                            echo'
                                <div class="empty">
                                    <p> no product was found!</p>
                                </div>
                            ';
                        }
                    }
                }else{ 
                    echo'
                        <div class="empty">
                            <p> no product was found!</p>
                        </div>
                    ';
                }
            ?>
        </div>
        <?php if ($grand_total != 0){ ?>
            <div class="cart-total">
                <p>total amount payable : <span> ₹ <?= $grand_total; ?></span></p>
                <div class="button">
                    <form action="" method="post">
                        <button type="submit" name="empty_cart" class="btn" onclick="return confirm
                            ('Are you sure to empty your cart?');">empty cart
                        </button>
                    </form>
                    <a href="checkout.php" class="btn">Proceed to checkout</a>
                </div>
            </div>
        <?php } ?>
    </div>






    <?php include 'components/footer.php'; ?>

    <!-- sweetalert cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- custom js link -->
    <script src="js/user_script.js"></script>

    <?php include 'components/alert.php'; ?>

</body>

</html>