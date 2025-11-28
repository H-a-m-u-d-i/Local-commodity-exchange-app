<?php
include '../connection.php';

$errors = [];
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate first name
    if (empty($_POST["first_name"]) || !preg_match("/^[a-zA-Z]{2,}$/", $_POST["first_name"])) {
        $errors['first_name'] = "First name must be at least 2 letters long and contain only letters.";
    }

    // Validate last name
    if (empty($_POST["last_name"]) || !preg_match("/^[a-zA-Z]{2,}$/", $_POST["last_name"])) {
        $errors['last_name'] = "Last name must be at least 2 letters long and contain only letters.";
    }

    // Validate email
    if (empty($_POST["email"]) || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) || strlen($_POST["email"]) < 6) {
        $errors['email'] = "Invalid email address.";
    }

    // Validate address
    if (empty($_POST["address"]) || !preg_match("/^[a-zA-Z0-9\s]{2,}$/", $_POST["address"])) {
        $errors['address'] = "Address must be at least 2 characters long and contain letters and numbers.";
    }

    // Validate password
    if (empty($_POST["password"]) || !preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $_POST["password"])) {
        $errors['password'] = "Password must be at least 8 characters long, include at least one uppercase letter, one lowercase letter, one number, and one special character.";
    
    }

    // Validate phone number
    if (empty($_POST["phone_number"]) || !preg_match("/^[0-9]{1,10}$/", $_POST["phone_number"])) {
        $errors['phone_number'] = "Phone number must be numeric and up to 10 digits long.";
    }

    // Validate user type
    if (empty($_POST["user_type"]) || !in_array($_POST["user_type"], ['buyer', 'farmer','admnistrator'])) {
        $errors['user_type'] = "Please select a valid user type.";
    }

    // Check if user already exists in database
    if (empty($errors)) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $user_type = $_POST['user_type'];

        $sql = "SELECT * FROM $user_type WHERE first_name = ? AND last_name = ? AND email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $first_name, $last_name, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "You are already registered in our database, please login.";
            $stmt->close();
            $conn->close();
            exit();
        }
        $stmt->close();
    }

    // If no errors, proceed with the registration
    if (empty($errors)) {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hashing the password for security
        $address = $_POST['address'];
        $phone_number = $_POST['phone_number'];

        $sql = "INSERT INTO $user_type (first_name, last_name, email, address, password, phone_number) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $first_name, $last_name, $email, $address, $password, $phone_number);

        if ($stmt->execute()) {
            echo "Registration successful.";
            header("Location: ../login.php");
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        foreach ($errors as $key => $error) {
            echo "<p>$key: $error</p>";
        }
    }

    $conn->close();
}
?>