<?php 
    include '../components/connect.php';

    if (isset($_COOKIE['seller_id'])) {
        $seller_id = $_COOKIE['seller_id'];
    } else {
        $seller_id = '';
        header('location:login.php');
        exit();
    }

    if(isset($_POST['update_order'])) {
        $order_id = $_POST['order_id'];
        $order_id = filter_var($order_id, FILTER_SANITIZE_SPECIAL_CHARS);

        $update_status = $_POST['update_status'];
        $update_status = filter_var($update_status, FILTER_SANITIZE_SPECIAL_CHARS);

        // Update order status
        if ($update_status == "Delivered") {
            $update_order = $conn->prepare("UPDATE orders SET status = ?, payment_status = 'Paid' WHERE id = ?");
        } elseif ($update_status == "Cancelled") {
            $update_order = $conn->prepare("UPDATE orders SET status = ?, payment_status = 'Cancelled' WHERE id = ?");
        } else {
            $update_order = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
        }

        $update_order->execute([$update_status, $order_id]);

        $success_msg[] = 'Order status updated';
    }


    // Delete order
    if (isset($_POST['delete_order'])) {
        $delete_id = $_POST['order_id'];
        $delete_id = filter_var($delete_id, FILTER_SANITIZE_SPECIAL_CHARS);

        $verify_delete = $conn->prepare("SELECT * FROM orders WHERE id = ?");
        $verify_delete->execute([$delete_id]);

        if ($verify_delete->rowCount() > 0) {
            $delete_order = $conn->prepare("DELETE FROM orders WHERE id =?");
            $delete_order->execute([$delete_id]);

            $success_msg[] = 'Order Deleted';
        } else {
            $warning_msg = 'Order already deleted';
        }
    }
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer - Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="main-container">
        <?php include '../components/admin_header.php'; ?>
        <section class="order-container">
            <div class="heading">
                <h1>Total Orders Placed</h1>
                <img src="../image/separator-img.png">
            </div>
            <div class="box-container">
                <?php
                    $select_order = $conn->prepare("SELECT * FROM orders WHERE seller_id = ?");
                    $select_order->execute([$seller_id]);

                    if($select_order->rowCount() > 0){
                        while($fetch_order = $select_order->fetch(PDO::FETCH_ASSOC)){
                ?>
                <div class="box">
                    <div class="status" style="color: <?php 
                        switch($fetch_order['status']) {
                            case 'Order Placed': echo 'blue'; break;
                            case 'Fulfilled': echo 'orange'; break;
                            case 'Shipped': echo 'purple'; break;
                            case 'Out for Delivery': echo 'darkorange'; break;
                            case 'Delivered': echo 'limegreen'; break;
                            case 'Cancelled': echo 'gray'; break;
                            default: echo 'red'; break;
                        }
                    ?>;">
                        <?= $fetch_order['status']; ?>
                    </div>

                    <div class="details">
                        <p>User Name: <span><?= $fetch_order['name']; ?></span></p>
                        <p>User ID: <span><?= $fetch_order['user_id']; ?></span></p>
                        <p>Placed On: <span><?= $fetch_order['date']; ?></span></p>
                        <p>User Number: <span><?= $fetch_order['number']; ?></span></p>
                        <p>User Email: <span><?= $fetch_order['email']; ?></span></p>
                        <p>Total Price: <span><?= $fetch_order['price']; ?></span></p>
                        <p>Payment Method: <span><?= $fetch_order['method']; ?></span></p>
                        <p>User Address: <span><?= $fetch_order['address']; ?></span></p>
                    </div>
                    <form action="" method="post">
                        <input type="hidden" name="order_id" value="<?= $fetch_order['id']; ?>">
                        <select name="update_status" class="box" style="width: 90%;">
                            <option disabled selected><?= $fetch_order['status']; ?></option>
                            <option value="Fulfilled">Fulfilled</option>
                            <option value="Shipped">Shipped</option>
                            <option value="Out for Delivery">Out for Delivery</option>
                            <option value="Delivered">Delivered</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                        <div class="flex-btn">
                            <input type="submit" name="update_order" value="Update Status" class="btn">
                            <input type="submit" name="delete_order" value="Delete Order" class="btn" onclick="return confirm('Delete this order?');">
                        </div>
                    </form>
                </div>
                <?php 
                        }
                    }else{
                        echo '
                            <div class="empty">
                                <p>No orders placed yet</p>
                            </div>';
                    }
                ?>
            </div>
        </section>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="../js/admin_script.js"></script>
    <?php include '../components/alert.php'; ?>
</body>
</html>
