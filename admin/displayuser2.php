<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buyer Table</title>
    <style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    table,
    th,
    td {
        border: 1px solid black;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: green;
    }

    a.delete-link img {
        width: 20px;
        height: 20px;
        text-decoration: none;
    }

    .wraper {
        position: relative;
        width: 100%;
    }
    </style>
</head>

<body>
    <div class="wraper">

        <?php
include '../connection.php';

$sql = "SELECT * FROM buyer";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Buyer Table</h2>";
    echo "<table>";
    echo "<tr>";
    
    // Fetching column names dynamically
    $fields = $result->fetch_fields();
    foreach ($fields as $field) {
        echo "<th>{$field->name}</th>";
    }
    echo "<th>Delete</th>";
    echo "</tr>";
    
    // Fetching and displaying rows
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>{$value}</td>";
        }
        // Assuming 'id' is the primary key
        echo "<td><a href='delete_buyer.php?buyer_id={$row['buyer_id']}' class='delete-link'><img src='delete-icon.png' alt='Delete'></a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results in buyer table.";
}

$conn->close();
?>


        <?php
include '../connection.php';

$sql = "SELECT * FROM farmer";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Farmer Table</h2>";
    echo "<table>";
    echo "<tr>";
    
    // Fetching column names dynamically
    $fields = $result->fetch_fields();
    foreach ($fields as $field) {
        echo "<th>{$field->name}</th>";
    }
    echo "<th>Delete</th>";
    echo "</tr>";
    
    // Fetching and displaying rows
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>{$value}</td>";
        }
        // Using 'farmer_id' as the primary key
        echo "<td><a href='deletefarmer.php?farmer_id={$row['farmer_id']}' class='delete-link'><img src='delete-icon.png' alt='Delete'></a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results in farmer table.";
}

$conn->close();
?>
    </div>
</body>

</html>