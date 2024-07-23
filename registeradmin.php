<?php
    include 'header.php';
    include 'connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Function to sanitize inputs
    function sanitize_input($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }
    
    // Gather and sanitize form data
    $username = sanitize_input($_POST['username']);
    $email = sanitize_input($_POST['email']);
    $password = sanitize_input($_POST['password']);

    // Check if email already exists
    $email_check_query = "SELECT A_Email FROM admin WHERE A_Email = ?";
    $email_check_stmt = mysqli_prepare($conn, $email_check_query);

    // Bind parameter and execute
    mysqli_stmt_bind_param($email_check_stmt, "s", $email);
    mysqli_stmt_execute($email_check_stmt);
    mysqli_stmt_store_result($email_check_stmt);

    // Check if any row is returned
    if (mysqli_stmt_num_rows($email_check_stmt) > 0) {
        $_SESSION['error_message'] = "Email already exists. Please use a different email.";
        header("Location: registeradmin.php");
        exit();
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL statement with parameterized query
    $stmt = mysqli_prepare($conn, "INSERT INTO admin (A_Username, A_Email, A_Password) VALUES (?, ?, ?)");
    
    if (!$stmt) {
        die("Prepare failed: " . mysqli_error($conn));
    }

    // Bind parameters with types (s for string)
    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashed_password);
    
    // Execute the prepared statement
    $success = mysqli_stmt_execute($stmt);
    
    if (!$success) {
        die("Execute failed: " . mysqli_stmt_error($stmt));
    }

    // Check if insert was successful
    if ($success && mysqli_stmt_affected_rows($stmt) == 1) {
        $_SESSION['success_message'] = "Registration successful. You can now log in.";
        // Redirect to login page after successful registration
        header("Location: loginadmin.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Error: Registration failed.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Admin</title>
    <link rel="stylesheet" href="styles/login&signup.css">
</head>
<body>
    <div class="wrapper">
        <span class="icon-close">
            <ion-icon name="close-outline"></ion-icon>
        </span>
        <div class="form-box register">
            <h2>Registration - Admin</h2>
            <form action="registeradmin.php" method="POST">
                <div class="input-box">
                    <span class="icon"><ion-icon name="person-circle-outline"></ion-icon></span>
                    <input type="text" name="username" required>
                    <label>Username</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
                    <input type="text" name="email" required>
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>
                <button type="submit" class="btn">Register</button>
                <?php 
                if (isset($_SESSION['error_message'])) {
                    echo '<div class="error-message">' . $_SESSION['error_message'] . '</div>';
                    unset($_SESSION['error_message']);
                }
                ?>
                <div class="login-register">
                    <p>Already have an account?<a href="loginadmin.php" class="login-link"> Login</a></p>
                </div>
            </form>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
