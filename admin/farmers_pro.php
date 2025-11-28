<?php
// Include the database connection file
include('../connection.php');

// Check if the "Delete" button is clicked
if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    // Delete the associated record from the farmers_product table
    $sql = "DELETE FROM farmers_product WHERE id = $id";
    mysqli_query($conn, $sql);
    $message = "The farmers product is rejected!";
    echo '<script>alert("' . $message . '"); window.location.href = "insert_catagory.php";</script>';
    exit;

    // Redirect to the same page to refresh the table
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Check if the "Confirm" button is clicked
if (isset($_POST['confirm'])) {
    $productId = $_POST['id'];
   // $paymentMethod = $_POST['payment_method'];

    // Perform the payment processing here
    // You can add the logic to process the payment based on the selected payment method
    // For example, you can display a form for the user to enter their account details
    ?>
<h2>Payment Options</h2>
<form method="POST" action="">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <label for="account_number">Account Number:</label>
    <input type="text" id="account_number" name="account_number" required>
    <br>
    <label for="payment_method">Payment Method:</label>
    <select id="payment_method" name="payment_method" required>
        <option value="commercial_bank_of_ethiopia">Commercial Bank of Ethiopia</option>
        <option value="dache_bank">Dache Bank</option>
        <option value="nib_bank">NIB Bank</option>
        <option value="telebirr">Telebirr</option>
        <option value="mpesa">M-Pesa</option>
    </select>
    <br>
    <button type="submit" name="process_payment">Process Payment</button>
</form>
<?php
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmers' Products</title>
    link href="../css/bootstrap.min.css" rel="stylesheet">
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
    /* Standard CSS for the table */
    table {
        width: 100%;
        border-collapse: collapse;
        font-family: Arial, sans-serif;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }

    .confirm-button,
    .delete-button {
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 8px 16px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 50%;
    }

    .delete-button {
        background-color: #f44336;
    }

    .product-image {
        max-width: 100px;
        max-height: 100px;
    }
    </style>
</head>

<body>
<div class="hero">
				<div class="container">
					<div class="row justify-content-between">
						<div class="col-lg-5">
							<div class="intro-excerpt">
								<h1>Farmers Product</h1>
							</div>
						</div>
						<div class="col-lg-7">
							
						</div>
					</div>
				</div>
			</div>
<?php include("header.php"); ?>

<div class="untree_co-section">
    <div class="container">
    
    <table>
        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Product Image</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Confirm</th>
            <th>Reject</th>
        </tr>
        <?php
        // Retrieve products from the database
        $sql = "SELECT * FROM farmers_product";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            foreach ($result as $row) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td><img src='../adminpanel/images2/". $row['image'] . "' class='product-image' alt='Product Image'></td>";
                echo "<td>" . $row['quantity'] . "</td>";
                echo "<td>" . $row['price'] . "</td>";
                echo "<td>";
                echo "<form method='POST' action=''>";
                echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                echo "<button type='submit' name='confirm' class='btn btn-primary'>Confirm</button>";
                echo "</form>";
                echo "</td>";
                echo "<td>";
                echo "<form method='POST' action=''>";
                echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                echo "<button type='submit' name='delete' class='delete-button'>Reject</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No data found.</td></tr>";
        }

    
    // Close the database connection
    mysqli_close($conn);
    ?>
    </div>
</div>

    
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