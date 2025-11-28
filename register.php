
<?php
include 'connection.php';

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the form values
if (isset($_POST['submit'])) {
    $first_name = $_POST['first_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $address = $_POST['address'] ?? '';
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $phone_number = $_POST['phone_number'] ?? '';
    $user_type = $_POST['user_type'] ?? '';

	// Validate user input (add more validation as needed)
	if (empty($first_name) || empty($last_name) || empty($email) || empty($address) || empty($password) || empty($phone_number) || empty($user_type)) {
		die('All fields are required');
	}

    // Prepare the SQL statement based on the user type
    
	if ($user_type === 'admnistrator') {
        $table = 'admnistrator';
    }   elseif ($user_type === 'buyer') {
        $table = 'buyer';
    } elseif ($user_type === 'farmer') {
        $table = 'farmer';
    } else {
        // Invalid user type
        die('Invalid user type');
    }

    // Insert the user into the appropriate table
    $sql = "INSERT INTO $table (first_name, last_name, email, address, password, phone_number)
        VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssss", $first_name, $last_name, $email, $address, $password, $phone_number);

    if (mysqli_stmt_execute($stmt)) {
        echo 'Registration successful!';
		header("Location: ../login.php");
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
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
        <link rel="stylesheet" href="css/register.css">
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
							<a class="nav-link" href="index.php">Home</a>
						</li>
						<li><a class="nav-link" href="shop.php">Product</a></li>
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
								<h1>Register Here</h1>
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
    <form action="adminpanel/form_validation - Copy.php" method="POST" class="register">
					
					<input type="text" name="first_name" id="first_name" class="" placeholder="Enter first name"  required><br>
		
					
					<input type="text" name="last_name" id="last_name" class="" placeholder="Enter last name" required><br>
		
					
					<input type="email" name="email" class="" id="email"  placeholder="Enter email" required><br>
		
					
					<input type="text" name="address" class="" id="address" placeholder="Enter address" required><br>
		
					
					<!-- <input type="password" name="password" id="password" placeholder="Enter password" required> -->
					
					<input type="password" name="password" id="password" placeholder="Enter password" required>
					<span id="toggle-password" style="cursor: pointer; margin-left: -30px; position: relative; z-index: 2;">
						<i class="fa fa-eye" id="eye-icon" style="color: black;"></i>
					</span>

					<script>
						const passwordField = document.getElementById('password');
						const togglePassword = document.getElementById('toggle-password');
						const eyeIcon = document.getElementById('eye-icon');

						togglePassword.addEventListener('click', () => {
							if (passwordField.type === 'password') {
								passwordField.type = 'text';
								eyeIcon.classList.remove('fa-eye');
								eyeIcon.classList.add('fa-eye-slash');
							} else {
								passwordField.type = 'password';
								eyeIcon.classList.remove('fa-eye-slash');
								eyeIcon.classList.add('fa-eye');
							}
						});
					</script><br>
					<input type="text" name="phone_number" id="phone_number" placeholder="09xxxxxxxxx" required><br><br>
		
					<label for="user_type">User Type:</label>
					<select name="user_type" id="user_type" class="role2" required>
						<option value="buyer">Buyer</option>
						<option value="farmer">Farmer</option>
						<!-- <option value="admnistrator">Admnistrator</option> -->
					</select><br><br>
		
					<input type="submit" value="Register" name="submit">
					<p class="login_link"> Already have an account? <a href="login.php" style="color: #ffc107;">Login</a></p>
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
									<li><a href="#"></a></li>
									<li><a href="#"></a></li>
									<li><a href="#">r</a></li>
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
