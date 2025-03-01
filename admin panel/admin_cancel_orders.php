<?php 
    include '../components/connect.php';

    if (isset($_COOKIE['seller_id'])) {
        $seller_id = $_COOKIE['seller_id'];
    } else {
        $seller_id = '';
        header('location:login.php');
        exit();
    }
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer - Cancelled Orders</title>
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="main-container">
        <?php include '../components/admin_header.php'; ?>
        <section class="order-container">
            <div class="heading">
                <h1>Total Cancelled Orders</h1>
                <img src="../image/separator-img.png">
            </div>
            <div class="box-container">
                <?php
                    $select_order = $conn->prepare("SELECT * FROM orders WHERE seller_id = ? AND status = 'Cancelled'");
                    $select_order->execute([$seller_id]);

                    if($select_order->rowCount() > 0){
                        while($fetch_order = $select_order->fetch(PDO::FETCH_ASSOC)){
                ?>
                <div class="box">
                    <div class="status" style="color: gray;">
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
                </div>
                <?php 
                        }
                    }else{
                        echo '<div class="empty"><p>No cancelled orders</p></div>';
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
