<?php
    session_start();

    $sname = "localhost";
    $uname = "root";
    $password = "";
    $db_name = "sdp_database";

    $conn = mysqli_connect($sname, $uname, $password, $db_name);

    if(!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve data from POST request and validate/sanitize it
        $email = mysqli_real_escape_string($conn, $_POST['A_Email']);
        $password = mysqli_real_escape_string($conn, $_POST['A_Password']);

        // Prepare an insert statement
        $sql = "INSERT INTO admin (A_Email, A_Password) VALUES (?, ?)";
    
        if($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_email, $param_password);
    
            // Set parameters
            $param_email = $email;
            $param_password = $password;
    
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)) {
                $_SESSION['success'] = 'Record inserted successfully';
                header('Location: user-management.php'); // Redirect back to main page
                exit();
            } else {
                echo "Error: " . mysqli_error($conn);
            }
    
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

?>