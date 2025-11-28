<?php
// Include database connection
include('connection.php');

// Check if cart_id is provided in the URL
if(isset($_GET['cart_id'])) {
    // Sanitize the cart_id to prevent SQL injection
    $cart_id = mysqli_real_escape_string($conn, $_GET['cart_id']);

    // Prepare a delete query
    $query = "DELETE FROM cart WHERE cart_id = $cart_id";

    // Execute the delete query
    if(mysqli_query($conn, $query)) {
        // Item deleted successfully
        echo "Item deleted successfully.";
    } else {
        // Error occurred while deleting item
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // cart_id is not provided in the URL
    echo "No cart_id provided.";
}
header("Location: cart.php");

// Close database connection
mysqli_close($conn);
?>