<?php
// Include the database connection file
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = mysqli_real_escape_string($conn, $_POST['full-name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $comment_text = mysqli_real_escape_string($conn, $_POST['comment']);

    // Check if the email exists in the farmer table
    $farmer_check_query = "SELECT * FROM farmer WHERE email='$email'";
    $farmer_result = mysqli_query($conn, $farmer_check_query);

    // Check if the email exists in the buyer table
    $buyer_check_query = "SELECT * FROM buyer WHERE email='$email'";
    $buyer_result = mysqli_query($conn, $buyer_check_query);

    if (mysqli_num_rows($farmer_result) > 0 || mysqli_num_rows($buyer_result) > 0) {
        // Insert the comment into the comment table
        $insert_comment_query = "INSERT INTO comment (full_name, email, comment_text) VALUES ('$full_name', '$email', '$comment_text')";

        if (mysqli_query($conn, $insert_comment_query)) {
            echo "New comment added successfully";
        } else {
            echo "Error: " . $insert_comment_query . "<br>" . mysqli_error($conn);
        }
    } else {
        echo " sorry you are not in our database Please register first in our database";
         
    }

    // Close the database connection
    mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comment Form</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 50px;
    }

    .comment-form {
        max-width: 600px;
        margin: auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
    }

    .comment-form h2 {
        margin-bottom: 20px;
    }

    .comment-form label {
        display: block;
        margin-bottom: 5px;
    }

    .comment-form input,
    .comment-form textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .comment-form button {
        padding: 10px 20px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .comment-form button:hover {
        background-color: #218838;
    }
    </style>
</head>

<body>

    <form class="comment-form" action="" method="post">
        <h2>Leave a Comment</h2>
        <label for="full-name">Full Name</label>
        <input type="text" id="full-name" name="full-name" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="comment">Comment</label>
        <textarea id="comment" name="comment" rows="5" required></textarea>

        <button type="submit">Submit Comment</button>
    </form>

</body>

</html>