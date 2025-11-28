<?php
session_start();
include("../connection.php");

$error = ""; // Initialize error message

if (isset($_POST['login'])) {
    $user = $_POST['email'];
    $password = $_POST['password'];

    // Validate for empty fields (optional)
    if (empty($user) || empty($password)) {
        $error = "* Please fill all the fields!";
        goto handle_error; // Jump to error handling
    }

    // Hash the password securely using password_hash()

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    

    $stmt = mysqli_prepare($conn, "SELECT email, password FROM admnistrator WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $user);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if ($row && password_verify($password, $row['password'])) {
        $_SESSION['email'] = $user;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Incorrect username or password";
    }

handle_error:
    // Display the error message (optional)
    echo "<p style='color:red;'>$error</p>";

    mysqli_stmt_close($stmt); // Close the prepared statement
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>RE Admin - Login</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->

</head>

<body>

    <!-- Main Wrapper -->
    <div class="page-wrappers login-body">
        <div class="login-wrapper">
            <div class="container">
                <div class="loginbox">
                    <div class="login-right">
                        <div class="login-right-wrap">
                            <h1>Admin Login Panel</h1>
                            <p class="account-subtitle">Access to our dashboard</p>
                            <p style="color:red;"><?php echo $error; ?> </p>
                            <!-- Form -->
                            <form method="POST">
                                <div class="form-group">
                                    <input class="form-control" name="email" type="text" placeholder="user email">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="password" name="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block" name="login" type="submit">Login</button>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Main Wrapper -->

    <!-- jQuery -->
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap Core JS -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="assets/js/script.js"></script>

</body>

</html>*/