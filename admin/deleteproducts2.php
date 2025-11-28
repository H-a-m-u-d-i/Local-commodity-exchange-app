<?php
// Include the database connection file
include('../connection.php');

if (isset($_POST['delete'])) {
    $productName = $_POST['product_name'];

    // Delete the product from the products table
    $sql = "DELETE FROM products WHERE product_name = '$productName'";
    mysqli_query($conn, $sql);

    // Redirect to the page displaying the products after deletion
   header("Location: deleteproducts.php");
    exit();
}

// Close the database connection

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
    }

    .product-item {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: center;
    }
    </style>
</head>

<body>
    <?php
// Include the database connection file
include('../connection.php');

// Retrieve products from the products table
$sql = "SELECT product_name, product_image FROM products";
$result = mysqli_query($conn, $sql);

// Display products and their images
echo "<div class='product-grid'>";

while ($row = mysqli_fetch_assoc($result)) {
    $productName = $row['product_name'];
    $productImage = $row['product_image'];

    echo "<div class='product-item'>";
    echo "<h3>$productName</h3>";
    echo "<img src='adminpanel/images/$productImage' alt='$productName' width='200' height='200'>";
    echo "<form method='POST' action=''>";
    echo "<input type='hidden' name='product_name' value='$productName'>";
    echo "<input type='submit' name='delete' value='Delete'>";
    echo "</form>";
    echo "</div>";
}

echo "</div>";

// Close the database connection
mysqli_close($conn);
?>
</body>

</html>