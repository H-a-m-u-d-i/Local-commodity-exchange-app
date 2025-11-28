<?php
include('connection.php');
session_start(); // Start session

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Connect to the appropriate database based on the selected role
    $servername = "localhost";
    $username = "root";
    $db_password = "";
    $dbname = "db"; // Use role as the database name

    // Create database connection
    $conn = mysqli_connect($servername, $username, $db_password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare and execute the query based on the selected role
    $sql = "";
    if ($role === "admnistrator") {
        $sql = "SELECT * FROM admnistrator WHERE email = ?";
    } elseif ($role === "buyer") {
        $sql = "SELECT * FROM buyer WHERE email = ?";
    } elseif ($role === "farmer") {
        $sql = "SELECT * FROM farmer WHERE email = ?";
    }

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user) 
	{ // User found 
		if (password_verify($password, $user['password'])) 
		{ 
            $_SESSION['user'] = $user['first_name'];

            if ($role === "admnistrator") {
                header("Location: admin/dashboard.php");
            } elseif ($role === "buyer") {
                header("Location: shop.php");
            } elseif ($role === "farmer") {
                header("Location: farmer.php");
            }
            exit();
        } 
		else { // Invalid credentials
			$error = '<p style="color: red; text-align: center;">Invalid login credentials.</p>';
        }
    } else { // Invalid email
        $error = '<p style="color: red; text-align: center; ">Invalid email credentials.</p>';
    } 

    mysqli_close($conn);
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
        <link rel="stylesheet" href="css/login.css">
		<title>Ethiopan Local Commodity Exchange</title>
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
								<h1>Login Here</h1>
							</div>
						</div>
						<div class="col-lg-7">
							
						</div>
					</div>
				</div>
			</div>
		<!-- End Hero Section -->

		

		<div class="untree_co-section">
		<?php if (isset($error)) { ?>
                <p><?php echo $error; ?></p>
                <?php } ?>
    <div class="container">
      
         <form method="post"  action="login.php" class="login" autocomplete="off">
                        
                    <input type="email" name="email" id="login-username" placeholder="Enter email/ኢሜሎን ያስግቡ " autocomplete="one-time-code" required><br>

                    <input type="password" name="password" id="login-password" placeholder="Enter password" required >
					<span id="toggle-password" style="cursor: pointer; margin-left: -30px; position: relative; z-index: 2;">
						<i class="fa fa-eye" id="eye-icon" style="color: black;"></i>
					</span>
					<script>
						const passwordField = document.getElementById('login-password');
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

                

                    <label for="role">Role:</label>
                    <select name="role" id="role" class="role">
						
                        <option value="farmer">Farmer</option>
                        <option value="buyer">Buyer</option>
                        <option value="admnistrator">Administrator</option>
						
                    </select><br><br>
                
                <input type="submit"  value="Login" name="login">
                <p class="register-link">Not a member? <a href="register.php" style="color: #ffc107;">Register</a></p>
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
									<li><a href="#"></a></li>
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
