<?php
include('connection.php'); // Include the database connection file

if (isset($_POST['query'])) {
    $search = $conn->real_escape_string($_POST['query']);
    $sql = "SELECT * FROM products WHERE product_name LIKE '%$search%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $output = '<div class="row">';
        foreach ($result as $row) {
            $output .= '<div class="col-md-4">';
            $output .= '<div class="card mb-4">';
            $output .= '<img src="adminpanel/images/' . htmlspecialchars($row['product_image']) . '" class="card-img-top" alt="' . htmlspecialchars($row['product_name']) . '">';
            $output .= '<div class="card-body">';
            $output .= '<h5 class="card-title">' . htmlspecialchars($row['product_name']) . '</h5>';
            $output .= '<p class="card-text">$' . htmlspecialchars($row['product_price']) . '</p>';
            $output .= '<button class="btn btn-success add-to-cart">Add to Cart</button>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
        }
        $output .= '</div>';
        echo $output;
    } else {
        echo '<p>No results found</p>';
    }
} else {
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
    

    #search-results {
        margin-top: 20px;
    }

    .card-img-top {
        height: 200px;
        object-fit: cover;
    }
    </style>
</head>

<body>
    <div class="container">

        <div class="input-group mb-3">
            <input type="text" id="search-box" class="form-control" placeholder="Search for products...">
            <div class="input-group-append">
                <button class="btn btn-primary" id="search-button" type="button">Search</button>
            </div>
        </div>
        <div id="search-results"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#search-button').click(function() {
            var query = $('#search-box').val();
            if (query.length > 0) {
                $.ajax({
                    url: 'search.php',
                    method: 'POST',
                    data: {
                        query: query
                    },
                    success: function(data) {
                        $('#search-results').html(data);
                    }
                });
            } else {
                $('#search-results').html('');
            }
        });

        $('#search-box').keypress(function(event) {
            if (event.which == 13) { // Enter key pressed
                $('#search-button').click();
            }
        });
    });
    </script>
</body>

</html>
<?php
}