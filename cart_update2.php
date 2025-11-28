<!DOCTYPE html>
<head>
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

    
</body>
</html>