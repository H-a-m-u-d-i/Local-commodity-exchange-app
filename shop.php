
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
    } else {
        // Fetch product details
        $product_query = mysqli_query($conn, "SELECT * FROM `products` WHERE product_id = '$product_id'") or die(mysqli_error($conn));
        $product = mysqli_fetch_assoc($product_query);
        
        // Insert product into the cart table
        $insert_query = "INSERT INTO `cart` (product_id, buyer_id, name, image, quantity, price) VALUES ('$product_id', '$buyer_id', '{$product['product_name']}', '{$product['product_image']}', '$quantity', '{$product['product_price']}')";
        $insert_result = mysqli_query($conn, $insert_query);
        if ($insert_result) {
            $_SESSION['cart_message'] = 'Product successfully added to cart!';
        } else {
            $_SESSION['cart_message'] = 'Failed to add product to cart!';
        }
    }
    header('Location: shop.php');
    exit(); 
}
   // Display the cart message
   $message = '';
   if (isset($_SESSION['cart_message'])) {
	   $message = $_SESSION['cart_message'];
	   unset($_SESSION['cart_message']);
   }

// Fetch products from the database
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);
$items = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
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
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
		<link href="css/tiny-slider.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<title>Ethiopian Local Commodity Exchange   </title>
		<style>
		.products-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
        padding: 20px;

		.product-item {
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 16px;
        text-align: center;
        width: 360px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #fff;
    }

    .product-item img {
        max-width: 100%;
        height: auto;
        border-radius: 8px 8px 0 0;
    }

    .product-item h3 {
        margin: 16px 0 8px;
        font-size: 18px;
    }

    .product-item p {
        margin: 8px 0;
    }

    .product-item button {
        
        border: none;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin-top: 10px;
        border-radius: 4px;
        cursor: pointer;
    }

    .product-item button:hover {
        background-color: rgba(4, 75, 26, 0.905);
    }



	

    }</style>
	</head>

	<body>

		<!-- Start Header/Navigation -->
		<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark" arial-label="Furni navigation bar">

			<div class="container">
				<a class="navbar-brand" href="index.php">ELCX<span>.</span></a>

				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarsFurni">
					<ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
						<li class="nav-item ">
							<a class="nav-link" href="index.php">Home</a>
						</li>
						<li class="active"><a class="nav-link" href="shop.php">Product</a></li>
						<li><a class="nav-link" href="about.php">About us</a></li>
						<li><a class="nav-link" href="services.php">Services</a></li>
						<li><a class="nav-link" href="blog.php">Category</a></li>
						<li><a class="nav-link" href="contact.php">Contact us</a></li>
					</ul>

					<ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
						<li><a class="nav-link" href="login.php"><img src="images/user.svg"></a></li>
						<li><a class="nav-link" href="cart.php"><img src="images/cart.svg"></a></li>
					</ul>
					
				</div>
			</div>
				
		</nav>
		<!-- End Header/Navigation -->

		<!-- Start Hero Section -->
			<div class="hero">
				<div class="container">
					<div class="row justify-content-between">
						<div class="col-lg-5">
							<div class="intro-excerpt">
								<h1>Products</h1>
								
							</div>
						</div>
						<div class="col-lg-7">
							
						</div>
					</div>
				</div>
			</div>
		<!-- End Hero Section -->
		

		<div class="untree_co-section product-section before-footer-section">
		<!-- Display success or error message -->
		<?php if (!empty($message)) : ?>
			<div class="alert alert-success" role="alert">
				<?php echo $message; ?>
			</div>
		<?php endif; ?>
		    <div class="container" style="display: flex;">
		      	<div class="row">
				  <?php include('search.php');?>
		      		<!-- Start Column 1 -->
					<div class="products-container">
					<?php foreach($items as $item): ?>
        <div class="product-item">

		<a href="product-details.php?product_id=<?php echo $item['product_id']; ?>" style="text-decoration: none;">
            <img src="adminpanel/images2/<?php echo $item['product_image']; ?>" alt="<?php echo $item['product_name']; ?>">
            <h3><?php echo $item['product_name']; ?></h3>
            <p>Price: <?php echo $item['product_price']; ?> ETB</p>
          </a>

            


            <form method="POST" action="">
                <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
                
                <button type="submit" name="add_to_cart"  class="btn btn-primary">Add to Cart</button>
            </form>
        </div>
        <?php endforeach; ?>
					</div> 
					<!-- End Column 1 -->
					
					<!-- Start Column 2 -->
					
					<!-- End Column 2 -->

					<!-- Start Column 3 -->
					
					<!-- End Column 3 -->

					<!-- Start Column 4 -->

					<!-- End Column 4 -->


					<!-- Start Column 1 -->
					
					<!-- End Column 1 -->
						
					<!-- Start Column 2 -->
					<
					<!-- End Column 2 -->

					<!-- Start Column 3 -->
					
					<!-- End Column 3 -->

					<!-- Start Column 4 -->
					
					<!-- End Column 4 -->

		      	</div>
		    </div>
		</div>


		<footer class="footer-section">
			<div class="container relative">

				<div class="sofa-img">
					<img src="images/imagess/IMG_5888.JPG" alt="Image" class="img-fluid">
				</div>

				<div class="row">
					<div class="col-lg-8">
						<div class="subscription-form">
							
						</div>
					</div>
				</div>

				<div class="row g-5 mb-5">
					<div class="col-lg-4">
						<div class="mb-4 footer-logo-wrap"><a href="#" class="footer-logo">ELCX<span>.</span></a></div>
						<p class="mb-4"></p>

						<ul class="list-unstyled custom-social">
							<li><a href="#"><span class="fa fa-brands fa-facebook-f"></span></a></li>
							<li><a href="#"><span class="fa fa-brands fa-twitter"></span></a></li>
							<li><a href="#"><span class="fa fa-brands fa-instagram"></span></a></li>
							<li><a href="#"><span class="fa fa-brands fa-linkedin"></span></a></li>
						</ul>
					</div>

					<div class="col-lg-8">
						<div class="row links-wrap">
							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="about.php">About us</a></li>
									<li><a href="services.php">Services</a></li>
									<li><a href="blog.php">Category</a></li>
									<li><a href="contact.php">Contact us</a></li>
								</ul>
							</div>

							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="#">Support</a></li>
									<li><a href="#">Knowledge base</a></li>
									<li><a href="#">Live chat</a></li>
								</ul>
							</div>

							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="#">Jobs</a></li>
									<li><a href="#">Our team</a></li>
									<li><a href="#">Leadership</a></li>
									<li><a href="#">Privacy Policy</a></li>
								</ul>
							</div>

							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									
								</ul>
							</div>
						</div>
					</div>

				</div>

				<div class="border-top copyright">
					<div class="row pt-4">
						<div class="col-lg-6">
							<p class="mb-2 text-center text-lg-start">Copyright &copy;<script>document.write(new Date().getFullYear());</script>. All Rights Reserved. &mdash; Designed with love by our team  <!-- License information: https://untree.co/license/ -->
            </p>
						</div>

						<div class="col-lg-6 text-center text-lg-end">
							<ul class="list-unstyled d-inline-flex ms-auto">
								<li class="me-4"><a href="#">Terms &amp; Conditions</a></li>
								<li><a href="#">Privacy Policy</a></li>
							</ul>
						</div>

					</div>
				</div>

			</div>
		</footer>
		<!-- End Footer Section -->	


		<script src="js/bootstrap.bundle.min.js"></script>
		<script src="js/tiny-slider.js"></script>
		<script src="js/custom.js"></script>
	</body>

</html>
		