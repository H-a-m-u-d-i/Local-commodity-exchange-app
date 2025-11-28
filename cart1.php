<?php
    include('connection.php'); 
    session_start();

   // if (!isset($_SESSION['user'])) {
       // header('location: cart1.php');
        //exit();
   // }

    $user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="styles/products.css">
    <link rel="stylesheet" href=".styles/header.css">
    <link rel="stylesheet" href="styles/general.css">
    <link rel="stylesheet" href="styles/payment.css">
    <script src="/..styles/scripts/script.js"></script>
    <title>Cart page</title>
</head>

<body>
    <?php

    if (isset($_POST['pay'])) {
        $buyer = mysqli_query($conn, "SELECT buyer_id FROM buyer WHERE first_name = '$user'");
        $buyer_result = mysqli_fetch_assoc($buyer);
        $buyer_id = $buyer_result['buyer_id'];
        $sql_cart = mysqli_query($conn, "SELECT * FROM cart WHERE `buyer_id` = $buyer_id");
        $orders = mysqli_fetch_all($sql_cart, MYSQLI_ASSOC);

        $address = "{$_POST['address']}:{$_POST['country']}:{$_POST['city']}";

        foreach ($orders as $order) {
            $price = $order['price'];
            $product_name = $order['name'];
            $quantity = $order['quantity'];
        
            if (mysqli_query($conn, "INSERT INTO orders (buyer_id, shipping_address, paid_amount, product_name, quantity) VALUES ('$buyer_id', '$address', '$price', '$product_name', '$quantity')")) {
                //update stock quantity
                $sql_prod = "UPDATE products SET stock_quantity = stock_quantity - $quantity WHERE product_name = '$product_name'";
                if (mysqli_query($conn, $sql_prod)) {
                    
                    $check_quantity_query = "SELECT quantity FROM products WHERE product_name = '$product_name'";
                    $result_check_quantity = mysqli_query($conn, $check_quantity_query);
                    $row = mysqli_fetch_assoc($result_check_quantity);
                    $updated_quantity = $row['stock_quantity'];
        
                    if ($updated_quantity <= 0) {
                        $delete_query = "DELETE FROM products WHERE name = '$product_name'";
                        mysqli_query($conn, $delete_query);
                    }
                } else {
                    echo 'query error: ' . mysqli_error($conn);
                }
            } else {
                echo 'query error: ' . mysqli_error($conn);
            }
        }        

        // $sql_delete_cart = "DELETE FROM cart WHERE customer_id = $user_id";
        // if (mysqli_query($conn, $sql_delete_cart)) {
        //     echo '<script>window.location.href = "cart.php?payment_success=1";</script>';
        // } else {
        //     echo 'query error: ' . mysqli_error($conn);
        // }
    }
    $buyer = mysqli_query($conn, "SELECT buyer_id FROM buyer WHERE first_name = '$user'");
    $buyer_result = mysqli_fetch_assoc($buyer);
    $buyer_id = $buyer_result['buyer_id'];
    $sql = "SELECT * FROM cart WHERE buyer_id = $buyer_id";
    $result = mysqli_query($conn, $sql);
    $items = mysqli_fetch_all($result, MYSQLI_ASSOC);
    ?>

<div class="container">
        <?php if (isset($_GET['payment_success']) && $_GET['payment_success'] == 1) {
        echo '<script>alert("Thank you for shopping with us! Payment successful.");</script>';
        } ?>
        <div class="col1">
            <form action="" method="POST">
                <div class="list cart_list">
                    <?php
                    $total = 0;
                    foreach ($items as $item) : ?>
                    <div class="item">
                        <?php if (isset($item['product_image'])) : ?>
                        <img src="images/<?php echo $item['buyer_id']; ?>/<?php echo $item['product_image']; ?>">
                        <?php endif; ?>
                        <div class="title"><?php echo $item['name']; ?></div>
                        <div class="price">Price: <?php echo $item['price']; ?></div>
                        <input type="hidden" name="id_to_delete" value="<?php echo $item['cart_id']; ?>">
                        <div class="number"><?php echo $item['quantity']; ?></div>
                    </div>
                    <?php $total += ($item['price'] * $item['quantity']); ?>
                    <?php endforeach; ?>
                </div>
            </form>
        </div>
        <div class="price-details">
            <div>
                <div class="price-heading">Price Details</div>
                <?php
                $count = mysqli_num_rows($result);
                echo "<h6>Items: $count</h6>";
                ?>
                <h6 class="delivery-charge">Delivery Charges: $0</h6>
                <hr>
            </div>
            <div>
                <h6 class="total">Total: $<?php echo $total; ?></h6>
                <hr>
                <h6 class="total">Grand Total: $<?php echo $total; ?></h6>
            </div>

            <button class="pay" role="button" onclick="openModal()">Pay</button>
        </div>
    </div>


    <div id="paymentModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>

            <p>Input your payment information here.</p>
            <?php include('payment.php'); ?>
        </div>
    </div>

    <script>
    function openModal() {
        document.getElementById('paymentModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('paymentModal').style.display = 'none';
    }
    </script>
</body>

</html>