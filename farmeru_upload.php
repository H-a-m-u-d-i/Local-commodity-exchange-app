<?php
	include 'connection.php';
	session_start();
	if (!isset($_SESSION['user'])) {
		header('location: login.php');
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
include('connection.php');

if (isset($_POST['submit'])) {
    $name = $_POST['product_name'];
    $image = $_FILES['product_image']['name'];
    $date = $_POST['production_date'];
    $quantity = $_POST['product_quantity'];
    $price = $_POST['product_price'];

    // Move uploaded images to a specific directory
    $target_dir = "adminpanel/images2/";
    $target_file = $target_dir . basename($image);

    // Check if the uploaded file is an image
    $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
    $file_extension = pathinfo($image, PATHINFO_EXTENSION);

    if (in_array(strtolower($file_extension), $allowed_extensions)) {
        // Check if the file was uploaded without errors
        if (move_uploaded_file($_FILES['product_image']['tmp_name'], $target_file)) {
            $sql = "INSERT INTO farmers_product (name, image, production_date, quantity, price) VALUES ('$name', '$image', '$date', '$quantity', '$price')";

            if (mysqli_query($conn, $sql)) {
                // Success
                echo '<script>alert("Product successfully added."); 
                window.location.href = "farmeru_upload.php";</script>';
            } else {
                echo 'Query error: ' . mysqli_error($conn);
            }
        } else {
            echo 'File upload error: ' . $_FILES['product_image']['error'];
        }
    } else {
        echo '<p style="color: red;">Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.</p>';
    }
}
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
        
		<title>Ethiopan Commodity Exchange</title>
	</head>

	<body>

		<!-- Start Header/Navigation -->
		<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

			<div class="container">
				<a class="navbar-brand" href="index.php">ELCX<span>.</span></a>

				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarsFurni">
					<ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
						<li class="nav-item ">
							<a class="nav-link" href="farmer.php">Home</a>
						</li>
						<li><a class="nav-link" href="shop.php">Product</a></li>
						<li><a class="nav-link" href="about.php">About us</a></li>
						<li><a class="nav-link" href="services.php">Services</a></li>
						<li><a class="nav-link" href="blog.php">category</a></li>
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
								<h1>Farmer Page</h1>
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
    
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="product-name">Product Name (እባኮትን የ እህሉን ስም ያስገቡ):</label>
            <input type="text" id="product-name" name="product_name" class="form-control" placeholder="Enter product name" required>
        </div>

       

        <div class="form-group">
            <label for="production_date">Production Date (እባኮትን ያመረቱበትን ቀን ያስገቡ):</label>
            <input type="date" id="production_date" name="production_date" class="form-control"placeholder='' required>
        </div>

        <div class="form-group">
            <label for="product-quantity">Product Quantity (እባኮትን የ እህሉን ብዛት ያስገቡ): in Kg</label>
            <input type="number" id="product-quantity" name="product_quantity" min="1" class="form-control" placeholder="Enter product quantity (Kg)" required>
        </div>

        <div class="form-group">
            <label for="product-price">Product Price (እባኮትን የ እህሉን ዋጋ ያስገቡ):</label>
            <input type="number" id="product-price" name="product_price" step="0.01" min="0" class="form-control" placeholder="Enter price" required>
        </div>
		<div class="form-group">
            <label for="product-image">Product Image (እባኮትን የ እህሉን ምስል ያስገቡ):</label>
            <input type="file" id="product-image" name="product_image" accept="image/*" class='form-control-file' placeholder="" required>
        </div>

        <input type="submit" value="Submit" name="submit" class="btn btn-primary">
    </form>
        

        
                
                    
                
        
			
      
    </div>
  </div>

		<!-- Start Footer Section -->
		<footer class="footer-section">
			<div class="container relative">

				<div class="sofa-img">
					<img src="images/agricultor.jpg" alt="Image" class="img-fluid">
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
									<li><a href="blog.php">category</a></li>
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
	</body>

</html>
