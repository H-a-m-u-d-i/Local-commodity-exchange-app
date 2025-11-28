<?php
session_start();
include('connection.php');


if (isset($_POST['add_to_cart'])) {
	if (!isset($_SESSION['user'])) {
		header('location: login.php');
		 exit();
	}
	$user = $_SESSION['user'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

	$buyer = mysqli_query($conn, "SELECT buyer_id FROM buyer WHERE first_name = '$user'");
	$buyer_result = mysqli_fetch_assoc($buyer);
	$buyer_id = $buyer_result['buyer_id'];


    // Check if the product is already in the cart
    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE product_id = '$product_id' and buyer_id = '$buyer_id'") or die(mysqli_error($conn));
    if (mysqli_num_rows($select_cart) > 0) {
        $_SESSION['cart_message'] = 'Product already added to cart!';
        header('Location: product-details.php');
    } else {
        // Fetch product details
        $product_query = mysqli_query($conn, "SELECT * FROM `products` WHERE product_id = '$product_id'") or die(mysqli_error($conn));
        $product = mysqli_fetch_assoc($product_query);
        
        // Insert product into the cart table
        $insert_query = "INSERT INTO `cart` (product_id, buyer_id, name, image, quantity, price) VALUES ('$product_id', '$buyer_id', '{$product['product_name']}', '{$product['product_image']}', '$quantity', '{$product['product_price']}')";
        $insert_result = mysqli_query($conn, $insert_query);
        if ($insert_result) {
            $_SESSION['cart_message'] = 'Product successfully added to cart!';
            header('Location: product-details.php');
        } else {
            $_SESSION['cart_message'] = 'Failed to add product to cart!';
        }
    }
    header('Location: product-details.php');
    exit(); 
}

    // Display the cart message
    $message = '';
    if (isset($_SESSION['cart_message'])) {
        $message = $_SESSION['cart_message'];
        unset($_SESSION['cart_message']);
    }


// Check if product_id is passed in the URL
if (!isset($_GET['product_id']) || empty($_GET['product_id'])) {
    header('Location: shop.php'); // Redirect to shop if no product ID is provided
    exit();
}

$product_id = $_GET['product_id'];

// Fetch product details from the database
$product_query = mysqli_query($conn, "SELECT product_id, product_name, product_catagory, quantity, product_description, product_image, product_price FROM products WHERE product_id = '$product_id'");

if (mysqli_num_rows($product_query) == 0) {
    // Redirect to shop if the product is not found
    header('Location: shop.php');
    exit();
}

$product = mysqli_fetch_assoc($product_query);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="favicon.png">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="css/tiny-slider.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <title>Product Details - Ethiopian Local Commodity Exchange</title>
    <style>
        .product-details {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .product-details img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .product-details h3 {
            margin-top: 20px;
            font-size: 24px;
        }
        .product-details p {
            margin: 10px 0;
            font-size: 16px;
        }
        .product-details .back-link {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
        }
        .product-details .back-link:hover {
            text-decoration: underline;
        }
        .product-details .add-to-cart {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<!-- Start Header/Navigation -->
<nav class="custom-navbar navbar navbar-expand-md navbar-dark" aria-label="Furni navigation bar">
    <div class="container">
        <a class="navbar-brand" href="index.php">ELCX<span>.</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarsFurni">
            <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="shop.php">Product</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About us</a></li>
                <li class="nav-item"><a class="nav-link" href="services.php">Services</a></li>
                <li class="nav-item"><a class="nav-link" href="blog.php">Category</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact us</a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Header/Navigation -->

    <!-- Display success or error message -->
    <?php if (!empty($message)) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

<div class="product-details">
    <img src="adminpanel/images2/<?php echo $product['product_image']; ?>" alt="<?php echo $product['product_name']; ?>">
    <h3><?php echo $product['product_name']; ?></h3>
    <p><strong>Category:</strong> <?php echo $product['product_catagory']; ?></p>
    <p><strong>Description:</strong> <?php echo $product['product_description']; ?></p>
    <p><strong>Price:</strong> <?php echo $product['product_price']; ?> ETB</p>
    <p><strong>Available Quantity:</strong> <?php echo $product['quantity']; ?></p>

    <form method="POST" action="" class="add-to-cart">
        <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" value="1" min="1" max="<?php echo $product['quantity']; ?>" required>

        <button type="submit" name="add_to_cart" class="btn btn-primary">Add to Cart</button>
    </form>

    <a href="shop.php" class="back-link">&laquo; Back to Shop</a>
</div>

<footer class="footer-section">
    <div class="container relative">
        <div class="border-top copyright">
            <div class="row pt-4">
                <div class="col-lg-6">
                    <p class="mb-2 text-center text-lg-start">Copyright &copy;<script>document.write(new Date().getFullYear());</script>. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
