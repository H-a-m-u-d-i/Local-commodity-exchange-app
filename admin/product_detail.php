<?php
session_start();
include('connection.php');

if (!isset($_SESSION['user'])) {
    header('location: ../login.php');
    exit();
}
$user = $_SESSION['user'];

$product_id = $_GET['product_id'];

// Fetch product details from the database
$product_query = mysqli_query($conn, "SELECT product_id, product_name, product_catagory, quantity, product_description, product_image, product_price FROM products WHERE product_id = '$product_id'");

$product = mysqli_fetch_assoc($product_query);

?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="favicon.png">

  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />

		<!-- Bootstrap CSS -->
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
		<link href="../css/tiny-slider.css" rel="stylesheet">
		<link href="../css/style.css" rel="stylesheet"><link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css">

<!-- Fontawesome CSS -->
<link rel="stylesheet" href="assets/css/font-awesome.min.css">

<!-- Feathericon CSS -->
<link rel="stylesheet" href="assets/css/feathericon.min.css">

<link rel="stylesheet" href="assets/plugins/morris/morris.css">

<!-- Main CSS -->
<link rel="stylesheet" href="assets/css/style.css">


        
		<title>Ethiopan Local  Commodity Exchange</title>
	</head>

	<body>

<!-- Start Header/Navigation -->

<!-- End Header/Navigation -->

<div class="product-details">
    <img src="adminpanel/images2/<?php echo $product['product_image']; ?>" alt="<?php echo $product['product_name']; ?>">
    <h3><?php echo $product['product_name']; ?></h3>
    <p><strong>Category:</strong> <?php echo $product['product_catagory']; ?></p>
    <p><strong>Description:</strong> <?php echo $product['product_description']; ?></p>
    <p><strong>Price:</strong> <?php echo $product['product_price']; ?> ETB</p>
    <p><strong>Available Quantity:</strong> <?php echo $product['quantity']; ?></p>
 

    <a href="insert-products.php" class="back-link">&laquo; Back all products</a>
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
