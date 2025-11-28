
<?php
    include('connection.php'); 
    session_start();

    if (!isset($_SESSION['user'])) {
       header('location: login.php');
        exit();
    }

    $user = $_SESSION['user'];
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
		<title>Ethiopan Local Commodity Exchange</title>
		<style>


    h2 {
        text-align: center;
        color: #333;
    }

    table {
        width: 80%;
        margin: 0 auto;
        border-collapse: collapse;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        background-color: transparent;
    }

    th,
    td {
        padding: 12px;
        text-align: center;
    }

    th {
        background-color: rgba(4, 75, 26, 0.905);
        color: white;
    }

    td {
        border-bottom: 1px solid #ddd;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    img {
        border-radius: 4px;
    }

    .checkout-button {
        display: block;
        width: 200px;
        margin: 20px auto;
        padding: 10px;
        text-align: center;
        background-color: #4CAF50;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .checkout-button:hover {
        background-color: #45a049;
    }

    tfoot td {
        font-weight: bold;
        font-size: 18px;
    }

    /* Add the following style to replace the icon */
    .action-icons .fa {
        font-size: 20px;
        /* Initial size */
        color: #333;
        cursor: pointer;
        margin: 0 5px;
        transition: transform 0.3s ease, color 0.3s ease, font-size 0.3s ease;
        /* Add font-size transition */
    }

    .action-icons .fa:hover {
        transform: scale(1.2);
        /* Increase size on hover */
        color: #4CAF50;
        /* Change color on hover */
    }

    .action-icons .fa.fa-trash-alt:hover {
        color: red;
        /* Change delete icon color to red on hover */
    }

    .icon-with-name {
        display: inline-block;
        vertical-align: middle;
    }

    .icon-name {
        margin-left: 5px;
        font-size: 14px;
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
								<h1>Cart</h1>
							</div>
						</div>
						<div class="col-lg-7">
							
						</div>
					</div>
				</div>
			</div>
		<!-- End Hero Section -->

		

		<div class="untree_co-section before-footer-section">
            <div class="container">
			
  <table>
        <thead>
            <tr>
                <th>Cart ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include('connection.php');

            $buyer = mysqli_query($conn, "SELECT buyer_id FROM buyer WHERE first_name = '$user'");
            $buyer_result = mysqli_fetch_assoc($buyer);
            $buyer_id = $buyer_result['buyer_id'];
            // Fetch data from the cart table
            $query = "SELECT * FROM cart WHERE buyer_id = '$buyer_id'";
            $result = mysqli_query($conn, $query);

            $total_sum = 0; // Initialize total sum variable

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    // Calculate total for each row
                    $total = $row['quantity'] * $row['price'];
                    $total_sum += $total; // Add to total sum

                    echo "<tr>";
                    echo "<td>{$row['cart_id']}</td>";
                    echo "<td>{$row['name']}</td>";
                    echo "<td><img src='adminpanel/images2/{$row['image']}' width='50' height='50'></td>";
                    echo "<td>{$row['quantity']}</td>";
                    echo "<td>\${$row['price']}</td>";
                    echo "<td>\${$total}</td>";
                    echo "<td class='action-icons'>";
                    echo "<span class='icon-with-name'><a href='cart_update.php?cart_id={$row['cart_id']}'><i class='fas fa-pencil-alt'></i><span class='icon-name'>Update</span></a></span>";
                    echo "<span class='icon-with-name'><a href='cart_delete.php?cart_id={$row['cart_id']}'><i class='fas fa-trash-alt'></i><span class='icon-name'>Delete</span></a></span>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No items in cart</td></tr>";
            }
            
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5">Total Sum:</td>
                <td colspan="2"><?php echo '$' . number_format($total_sum, 2); ?></td>
            </tr>
        </tfoot>
    </table>
    <a href="checkout.php" class="checkon"></a>
        
              <div class="row">
                <div class="col-md-6">
                  <div class="row mb-5">
                    <div class="col-md-6 mb-3 mb-md-0">
                      
                    </div>
                    <div class="col-md-6">
                      
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <label class="text-black h4" for="coupon"></label>
                      
                    </div>
                    <div class="col-md-8 mb-3 mb-md-0">
                      
                    </div>
                    <div class="col-md-4">
                
                    </div>
                  </div>
                </div>
                <div class="col-md-6 pl-5">
                  <div class="row justify-content-end">
                    <div class="col-md-7">
                      <div class="row">
                        <div class="col-md-12 text-right border-bottom mb-5">
                          <h3 class="text-black h4 text-uppercase"></h3>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col-md-6">
                          <span class="text-black"></span>
                        </div>
                        <div class="col-md-6 text-right">
                          <strong class="text-black"></strong>
                        </div>
                      </div>
                      <div class="row mb-5">
                        <div class="col-md-6">
                          <span class="text-black"></span>
                        </div>
                        <div class="col-md-6 text-right">
                          <strong class="text-black"></strong>
                        </div>
                      </div>
        
                      <div class="row">
                        <div class="col-md-12">
                          <button class="btn btn-black btn-lg py-3 btn-block" onclick="window.location='checkout.php'">Proceed To Checkout</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
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
