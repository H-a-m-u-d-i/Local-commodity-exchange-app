<?php
	include '../connection.php';
	session_start();
	if (!isset($_SESSION['user'])) {
		header('location: ../login.php');
		exit();
	}
	$user = $_SESSION['user'];

	// $sql = "SELECT first_name, last_name FROM administrator WHERE first_name = $user";
    // $name = mysqli_query($conn, $sql);
    // $uname = mysqli_fetch_assoc($name);
    // $user = $uname['last_name']
?>
<?php
// Include the database connection file
include('../connection.php');

if (isset($_POST['delete'])) {
    $productId = $_POST['product_id'];

    // Delete the product from the products table
    $sql = "DELETE FROM products WHERE product_id = $productId";
    mysqli_query($conn, $sql);

    // Delete the associated records from the product_category table
    $sql = "DELETE FROM catagories WHERE catagory_id = $productId";
    mysqli_query($conn, $sql);

    // Redirect to the page displaying the products after deletion
    header("Location: deleteproducts.php");
    exit();
}

// Close the database connection
mysqli_close($conn);
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
<style>
   .product-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
    }

    .product-item {
        width: 300px;
        border: 1px solid #ccc;
        padding: 10px;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .product-item img {
        max-width: 100%;
        height: auto;
    }

    .product-item form {
        margin-top: 10px;
    }
    </style>

		<title>Ethiopan Commodity Exchange</title>
	</head>

	<body>

		<!-- Start Header/Navigation -->
		<?php include("header.php"); ?>
		<!-- End Header/Navigation -->

		<!-- Start Hero Section -->
			<div class="hero">
				<div class="container">
					<div class="row justify-content-between">
						<div class="col-lg-5">
							<div class="intro-excerpt">
								<h1>Delete products</h1>
							</div>
						</div>
						<div class="col-lg-7">
							
						</div>
					</div>
				</div>
			</div>
		<!-- End Hero Section -->

		

		<div class="untree_co-section">
    <div class="container">
      <div class="row">
        
	  <?php

// Include the database connection file
include('../connection.php');

// Retrieve products from the products table
$sql = "SELECT p.product_id, p.product_name, p.product_image 
		FROM products p";
$result = mysqli_query($conn, $sql);

// Display products and their images
echo "<div class='product-grid'>";

while ($row = mysqli_fetch_assoc($result)) {
	$productId = $row['product_id'];
	$productName = $row['product_name'];
	$productImage = $row['product_image'];

	echo "<div class='product-item'>";
	echo "<h3>$productName</h3>";
	echo "<img src='../adminpanel/images2/$productImage' alt='$productName' width='200' height='200'>";
	echo "<form method='POST' action=''>";
	echo "<input type='hidden' name='product_id' value='$productId'>";
	echo "<input type='submit' name='delete' value='Remove' class='btn btn-primary' >";
	echo "</form>";
	echo "</div>";
}

echo "</div>";

// Close the database connection
mysqli_close($conn);
?>



      </div>
    </div>
  </div>

		<!-- Start Footer Section -->
		<footer class="footer-section">
			<div class="container relative">

				<div class="sofa-img">
					
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
									<li><a href="about.php"></a></li>
									<li><a href="services.php"></a></li>
									<li><a href="blog.php"></a></li>
									<li><a href="contact.php"></a></li>
								</ul>
							</div>

							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="#"></a></li>
									<li><a href="#"></a></li>
									<li><a href="#"></a></li>
								</ul>
							</div>

							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="#"></a></li>
									<li><a href="#"></a></li>
									<li><a href="#"></a></li>
									<li><a href="#"></a></li>
								</ul>
							</div>

							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="#"></a></li>
									<li><a href="#"></a></li>
									<li><a href="#"></a></li>
								</ul>
							</div>
						</div>
					</div>

				</div>

				<div class="border-top copyright">
					<div class="row pt-4">
						<div class="col-lg-6">
							<p class="mb-2 text-center text-lg-start">Copyright &copy;<script>document.write(new Date().getFullYear());</script>. All Rights Reserved. &mdash; Designed with love by our team. 
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
		<script src="assets/js/jquery-3.2.1.min.js"></script>

<!-- Bootstrap Core JS -->
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<!-- Slimscroll JS -->
<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="assets/plugins/raphael/raphael.min.js"></script>
<script src="assets/plugins/morris/morris.min.js"></script>
<script src="assets/js/chart.morris.js"></script>

<!-- Custom JS -->
<script src="assets/js/script.js"></script>

		<script src="js/bootstrap.bundle.min.js"></script>
		<script src="js/tiny-slider.js"></script>
		<script src="js/custom.js"></script>
	</body>

</html>
