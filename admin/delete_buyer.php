<?php
include '../connection.php';

if (isset($_GET['buyer_id'])) {
    $buyer_id = (int)$_GET['buyer_id'];

    $sql = "DELETE FROM buyer WHERE buyer_id = $buyer_id";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();

// Redirect back to the display page
header("Location: displayuser.php");
exit;
?>