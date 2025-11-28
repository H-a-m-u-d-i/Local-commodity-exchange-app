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
		<title>Ethiopan Local Commodity Exchange</title>
        <style>
    /* Table Styles */
table {
    width: 100%;
    border-collapse: collapse;
    font-family: Arial, sans-serif;
    margin-top: 20px;
}

th, td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #f2f2f2;
}

/* Update Form Styles */
.update-form {
    display: none;
    margin-top: 5px;
}

.update-form input[type="number"] {
    width: 60px;
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

.update-form input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 5px 10px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

.update-form input[type="submit"]:hover {
    background-color: #45a049;
}

/* Link Styles */
.update-link {
    color: #007bff;
    text-decoration: none;
    cursor: pointer;
}

.update-link:hover {
    color: #0056b3;
}
</style>
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
								<h1>Update cart</h1>
								<div style="position: absolute; top: 0; right: 0; margin: 10px;">
									<a href="cart.php" style="text-decoration: none; color: white;">Back</a>
								</div>
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
include 'connection.php';

// Check if the update button is clicked
if (isset($_POST['update'])) {
    // Get the product ID and new quantity from the form
    $product_id = $_POST['product_id'];
    $new_quantity = $_POST['quantity'];

    // Update the quantity in the database
    $sql = "UPDATE cart SET quantity = '$new_quantity' WHERE product_id = '$product_id'";
    if ($conn->query($sql) === TRUE) {
        echo "Quantity updated successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch the cart items from the database
$sql = "SELECT * FROM cart";
$result = $conn->query($sql);

// Display the cart items in a table
echo "<table>";
echo "<tr><th>Product ID</th><th>Name</th><th>Price</th><th>Quantity</th><th>Total</th><th>Actions</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["product_id"] . "</td>";
    echo "<td>" . $row["name"] . "</td>";
   
    echo "<td>" . $row["price"] . "</td>";
    echo "<td>" . $row["quantity"] . "</td>";
    echo "<td>" . ($row["price"] * $row["quantity"]) . "</td>";
    echo "<td>
        <a href='#' class='update-link' data-product-id='" . $row["product_id"] . "' data-quantity='" . $row["quantity"] . "'>Update</a>
        <div class='update-form' style='display:none;'>
            <form method='post'>
                <input type='hidden' name='product_id' value='" . $row["product_id"] . "'>
                <input type='number' name='quantity' value='" . $row["quantity"] . "'>
                <input type='submit' name='update' value='Update'>
            </form>
        </div>
    </td>";
    echo "</tr>";
}
echo "</table>";

// Close the database connection
$conn->close();
//header("location:cart.php");
?>

<script>
// Show the update form when the "Update" link is clicked
document.querySelectorAll('.update-link').forEach(link => {
    link.addEventListener('click', function() {
        this.style.display = 'none';
        this.nextElementSibling.style.display = 'block';
    });
});
</script>


        
      </div>
    </div>
  </div>

		<!-- Start Footer Section -->
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
