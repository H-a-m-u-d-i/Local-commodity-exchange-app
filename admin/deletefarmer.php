<?php
include '../connection.php';

if (isset($_GET['farmer_id'])) {
    $farmer_id = (int)$_GET['farmer_id'];

    $sql = "DELETE FROM farmer WHERE farmer_id = $farmer_id";
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
header("Location:displayuser.php");
exit;
?>