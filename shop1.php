<?php
    include('connection.php'); 
    session_start();

    if (!isset($_SESSION['user'])) {
       header('location: login.php');
        exit();
    }

    $user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="styles/header.css">
    <link rel="stylesheet" href="styles/general.css">
    <link rel="stylesheet" href="styles/products.css">
    <title>OUR PRODUCTS</title>
</head>

<body>
    <p class="top">OUR PRODUCTS</p>
    <?php 
   // include('header.php');
    
    $sql = "SELECT * FROM products";

    $result = mysqli_query($conn, $sql);
    $items = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);

    if (isset($_POST['add_to_cart'])) {
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $category_id = $_POST['catagory_id'];
        $product_quantity = $_POST['quantity'];
        
        $buyer = mysqli_query($conn, "SELECT buyer_id FROM buyer WHERE first_name = '$user'");
        $buyer_result = mysqli_fetch_assoc($buyer);
        $buyer_id = $buyer_result['buyer_id'];

        $select_cart = mysqli_prepare($conn, "SELECT * FROM cart WHERE name = ? AND buyer_id = ?");
        mysqli_stmt_bind_param($select_cart, 'si', $product_name, $buyer_id);
        mysqli_stmt_execute($select_cart);
        $result = mysqli_stmt_get_result($select_cart);

        $quant = mysqli_fetch_assoc(mysqli_query($conn, "SELECT quantity FROM products WHERE product_name = '$product_name'"));
        
        if ($product_quantity > $quant['quantity']) {
            $_SESSION['cart_message'] = 'Not Enough Amount';
        } else {
            if (mysqli_num_rows($result) > 0) {
                $_SESSION['cart_message'] = 'Product already added to cart!';
            } else {
                mysqli_query($conn, "INSERT INTO cart(buyer_id, name, price, image, quantity) VALUES('$buyer_id', '$product_name', '$product_price', '$product_image', '$product_quantity' )") or die('query failed');
                $_SESSION['cart_message'] = '<script>alert("Product Successfully added to cart!")</script>';
                header('location: shop1.php');
                exit(); 
            }
        }
    }

    mysqli_close($conn);
?>

    <?php
if (isset($_SESSION['cart_message'])) {
    echo '<div style="color: ' . ($_SESSION['cart_message'] == 'Product Successfully added to cart!' ? 'green' : 'red') . '; margin-left: 70px;">' . $_SESSION['cart_message'] . '</div>';
    unset($_SESSION['cart_message']); 
}
?>

<div class="list product_list">
        <?php foreach($items as $item): ?>
        <form action="" method="POST">
            <div class="item">
                <?php if (isset($item['image_url'])) : ?>
                <img src="adminpanel/images/<?php echo $item['catagory_id']; ?>/<?php echo $item['product_image']; ?>">
                <?php endif; ?>
                <div class="title"><?php echo $item['product_name']; ?></div>
                <div class="price">Price: <?php echo $item['product_price']; ?></div>
                <input type="hidden" name="product_name" value="<?php echo $item['product_name']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $item['product_price']; ?>">
                <input type="hidden" name="product_image" value="<?php echo $item['product_image']; ?>">
                <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
                <input type="hidden" name="catagory_id" value="<?php echo $item['catagory_id']; ?>">
                <div class="selector">
                    <input type="submit" name="add_to_cart" value="add to cart" id="submit">
                    <input placeholder="quantity" type="number" min="1" value="1" name="quantity" id="quantity">
                </div>
            </div>
        </form>
        <?php endforeach; ?>
    </div>

</body>

</html>