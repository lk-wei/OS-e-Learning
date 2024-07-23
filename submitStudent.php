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
        $username = mysqli_real_escape_string($conn, $_POST['S_Username']);
        $email = mysqli_real_escape_string($conn, $_POST['S_Email']);
        $password = mysqli_real_escape_string($conn, $_POST['S_Password']);
        $contactnumber = mysqli_real_escape_string($conn, $_POST['S_Contact_Number']);
        $guardianID = mysqli_real_escape_string($conn, $_POST['Guardian_ID']);

        // Prepare an insert statement
        $sql = "INSERT INTO student (S_Username, S_Email, S_Password, S_Contact_Number, Guardian_ID) VALUES (?, ?, ?, ?, ?)";
    
        if($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_email, $param_password, $param_contactnumber, $param_guardianID);
    
            // Set parameters
            $param_username = $username;
            $param_email = $email;
            $param_password = $password;
            $param_contactnumber = $contactnumber;
            $param_guardianID = $guardianID;
    
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