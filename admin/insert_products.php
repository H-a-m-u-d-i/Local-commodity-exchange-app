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
	<link href="../css/style.css" rel="stylesheet">
	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">

	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">

	<!-- Feathericon CSS -->
	<link rel="stylesheet" href="assets/css/feathericon.min.css">

	<link rel="stylesheet" href="assets/plugins/morris/morris.css">

	<!-- Main CSS -->
	<link rel="stylesheet" href="assets/css/style.css">



	<title>Ethiopan Local Commodity Exchange</title>
</head>

<body>

	<!-- Start Header/Navigation -->
	<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

		<div class="container">
			<a class="navbar-brand" href="../index.php">ELCX<span>.</span></a>

			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarsFurni">
				<ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
					<li class="nav-item ">
						<a class="nav-link" href="../index.php">Home</a>
					</li>
					<li><a class="nav-link" href="../shop.php">Product</a></li>
					<li><a class="nav-link" href="../about.php">About us</a></li>
					<li><a class="nav-link" href="../services.php">Services</a></li>
					<li><a class="nav-link" href="../blog.php">Category</a></li>
					<li><a class="nav-link" href="../contact.php">Contact us</a></li>
				</ul>

				<ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
					<li><a class="nav-link" href="login.php"><img src="../images/user.svg"></a></li>
					<li><a class="nav-link" href="cart.php"><img src="../images/cart.svg"></a></li>
					<li><button class="btn btn-primary"><a href="../admin/dashboard.php">Back To Dashbord</a></button></li>
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
						<h1>Add Product</h1>
					</div>
				</div>
				<div class="col-lg-7">

				</div>
			</div>
		</div>
	</div>
	<!-- End Hero Section -->

	<?php include("header.php"); ?>

	<div class="untree_co-section">
		<div class="container">

			<form action="" method="POST" enctype="multipart/form-data">
				<div class="form-outline mb-4">
					<label for="product_name" class="form-label">Product Name</label>
					<input type="text" name="product_name" id="product_name" placeholder="Enter the product name"
						class="form-control" required>
				</div>
				<div class="form-outline mb-4">
					<label for="product_category" class="form-label">Select Product Category</label>
					<select name="product_category" id="product_category" class="form-select" required>
						<option value="">Select a category</option>
						<option value="cereal">Cereal</option>
						<option value="fruit">Fruit</option>
						<option value="legume">Legume</option>
						<option value="fibers">Fibers</option>
						<option value="coffee">Coffee</option>
						<option value="vegetable">Vegetable</option>
					</select>
				</div>
				<div class="form-outlinemb-4">
					<label for="product_quantity" class="form-label">product_quantity (Kg)</label>
					<input type="number" id="quantity" name="quantity" value="1" min="1" id="quantity" required>
				</div>

				<!-- <div class="form-outline mb-4">
            <label for="product_description" class="form-label">Product Description</label>
            <input type="text" name="product_description" id="product_description"
                placeholder="Enter the product description" class="form-control" required>
        </div> -->

				<div class="form-outline mb-4">
					<label for="product_description" class="form-label">Product Description</label>
					<textarea class="form-control" id="product_description" name="product_description"
						placeholder="Enter the product description" required></textarea>
				</div>

				<div class="form-outline mb-4">
					<label for="product_image" class="form-label">Product Image</label>
					<input type="file" name="product_image" id="product_image" class="form-control" required>
				</div>
				<div class="form-outline mb-4">
					<label for="product_image2" class="form-label">Product Image 2</label>
					<input type="file" name="product_image2" id="product_image2" class="form-control" required>
				</div>
				<div class="form-outline mb-4">
					<label for="production_date" class="form-label">Production Date</label>
					<input type="date" name="production_date" id="production_date" class="form-control" required>
				</div>
				<div class="form-outline mb-4">
					<label for="product_expiry-date" class="form-label">Product Expiry Date</label>
					<input type="date" name="product_expiry-date" id="product_expiry-date" class="form-control" required>
				</div>
				<div class="form-outline mb-4">
					<label for="product_price" class="form-label">Product Price</label>
					<input type="text" name="product_price" id="product_price" placeholder="Enter the product price"
						class="form-control" required>
				</div>
				<input type="submit" name="submit" class="btn btn-primary" value="submit">

			</form>
			<?php
			//session_start()

			// if (!isset($_SESSION['user_type']) && $_SESSION['user_type']==='admin')
			// {
			//header("location:index.php");
			// }


			if (isset($_POST['submit'])) {
				include('../connection.php');
				$name = $_POST['product_name'];
				$category = $_POST['product_category'];
				$quantity = $_POST['quantity'];
				$description = $_POST['product_description'];
				$image = $_FILES['product_image']['name'];
				$image2 = $_FILES['product_image2']['name'];
				$date = $_POST['production_date'];
				$exp_date = $_POST['product_expiry-date'];
				$price = $_POST['product_price'];

				// Move uploaded images to a specific directory
				$target_dir = "../adminpanel/images2/";
				$target_file1 = $target_dir . basename($image);
				$target_file2 = $target_dir . basename($image2);
				move_uploaded_file($_FILES['product_image']['tmp_name'], $target_file1);
				move_uploaded_file($_FILES['product_image2']['tmp_name'], $target_file2);

				$sql = "INSERT INTO products (product_name, product_catagory,quantity, product_description, product_image1, product_image, production_date, expiry_date, product_price)
                VALUES ('$name', '$category','$quantity','$description', '$image', '$image2', '$date', '$exp_date', '$price')";

				if (mysqli_query($conn, $sql)) {
					// Success
					// $message = "Product successfully added.";
					$message = "product successfully added.";
					echo '<script>alert("' . $message . '"); window.location.href = "insert_products.php";</script>';
					exit;
				} else {
					echo 'Query error: ' . mysqli_error($conn);
				}
			}
			?>


			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>







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
								<li><a href="#" </a></li>
								<li><a href="#"></a></li>
							</ul>
						</div>
					</div>
				</div>

			</div>

			<div class="border-top copyright">
				<div class="row pt-4">
					<div class="col-lg-6">
						<p class="mb-2 text-center text-lg-start">Copyright &copy;<script>
								document.write(new Date().getFullYear());
							</script>. All Rights Reserved. &mdash; Designed with love by our team.
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
</body>

</html>