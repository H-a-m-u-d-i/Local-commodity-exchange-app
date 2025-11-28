<?php
// Include the database connection file
include '../connection.php';

// Query to select data from the comment table
$sql = "SELECT comment_id, full_name, comment_text, comment_date FROM comment ORDER BY comment_date DESC";
$result = mysqli_query($conn, $sql);

?>
<?php
	include '../connection.php';
	session_start();
	if (!isset($_SESSION['user'])) {
		header('location: ../login.php');
		exit();
	}
	$user = $_SESSION['user'];

	// $sql = "SELECT first_name, last_name FROM administrator WHERE first_name = $user";
    // $name = mysqli_query($conn, $sql);
    // $uname = mysqli_fetch_assoc($name);
    // $user = $uname['last_name']
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comments</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 50px;
        background-color: #f9f9f9;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        background-color: #fff;
    }

    table,
    th,
    td {
        border: 1px solid #ddd;
    }

    th,
    td {
        padding: 12px 15px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
        color: #333;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    caption {
        caption-side: top;
        text-align: left;
        font-size: 1.5em;
        padding: 10px;
    }
    </style>
</head>

<body>

    <h2>Comments</h2>

    <table>
        <caption>Comment List</caption>
        <tr>
            <th>Comment ID</th>
            <th>Full Name</th>
            <th>Comment</th>
            <th>Commented Date</th>
        </tr>

        <?php
        if (mysqli_num_rows($result) > 0) {
            // Output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["comment_id"] . "</td>";
                echo "<td>" . $row["full_name"] . "</td>";
                echo "<td>" . $row["comment_text"] . "</td>";
                echo "<td>" . $row["comment_date"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No comments found</td></tr>";
        }

        // Close the database connection
        mysqli_close($conn);
        ?>

    </table>

</body>

</html>