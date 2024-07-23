<?php
    include 'connection.php';
    include 'header.php';

    if (!isset($_SESSION['user_id'])) {
        header("Location: registeradmin.php");
        exit();
    }

    if(isset($_POST['btnUpdate'])){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userId = $_SESSION['user_id'];
            $user_role = $_SESSION['user_role'];
            $username = $_POST['a_username'] ?? $_POST['s_username'] ?? $_POST['l_username'] ?? $_POST['g_username']; 
            $email = $_POST['a_email'] ?? $_POST['s_email'] ?? $_POST['l_email'] ?? $_POST['g_email']; 
            $password = $_POST['a_password'] ?? $_POST['s_password'] ?? $_POST['l_password'] ?? $_POST['g_password']; 
            $contactnumber = $_POST['s_contact_number'] ?? $_POST['l_contact_number'] ?? $_POST['g_contact_number']; 
            $guardianId = $_POST['guardianId'] ?? null; 
        
            // Determine the table and ID column based on user role
            $table_name = strtolower($user_role); // Assuming table names are lowercase roles
            $table_id = ucfirst($user_role) . "_ID"; // Assuming ID columns follow this pattern
        
            if ($user_role === 'Student') {
                $sql = "UPDATE $table_name SET S_Username=?, S_Email=?, S_Contact_Number=? WHERE $table_id=?";
                $stmt = mysqli_prepare($conn, $sql);
                if (!empty($password)) {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    // Assuming you want to update the password for a student as well
                    $sql = "UPDATE $table_name SET S_Username=?, S_Email=?, S_Password=?, S_Contact_Number=? WHERE $table_id=?";
                    mysqli_stmt_prepare($stmt, $sql);
                    mysqli_stmt_bind_param($stmt, "sssss", $username, $email, $hashedPassword, $contactnumber, $userId);
                } else {
                    mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $contactnumber, $userId);
                }
            } elseif ($user_role === 'Admin') {
                $sql = "UPDATE $table_name SET A_Username=?, A_Email=? WHERE $table_id=?";
                $stmt = mysqli_prepare($conn, $sql);
                if (!empty($password)) {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    // Assuming you want to update the password for an admin as well
                    $sql = "UPDATE $table_name SET A_Username=?, A_Email=?, A_Password=? WHERE $table_id=?";
                    mysqli_stmt_prepare($stmt, $sql);
                    mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $hashedPassword, $userId);
                } else {
                    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $userId);
                }
            } elseif ($user_role === 'Lecturer') {
                $sql = "UPDATE $table_name SET L_Username=?, L_Email=?, L_Contact_Number=? WHERE $table_id=?";
                $stmt = mysqli_prepare($conn, $sql);
                if (!empty($password)) {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    // Assuming you want to update the password for a lecturer as well
                    $sql = "UPDATE $table_name SET L_Username=?, L_Email=?, L_Password=?, L_Contact_Number=? WHERE $table_id=?";
                    mysqli_stmt_prepare($stmt, $sql);
                    mysqli_stmt_bind_param($stmt, "ssssss", $username, $email, $contactnumber, $hashedPassword, $userId);
                } else {
                    mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $contactnumber, $userId);
                }
            } elseif ($user_role === 'Guardian') {
                $sql = "UPDATE $table_name SET G_Email=?, G_Contact_Number=?, G_Username=? WHERE $table_id=?";
                $stmt = mysqli_prepare($conn, $sql);
                if (!empty($password)) {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    // Assuming you want to update the password for a guardian as well
                    $sql = "UPDATE $table_name SET G_Email=?, G_Password=?, G_Contact_Number=?, G_Username=? WHERE $table_id=?";
                    mysqli_stmt_prepare($stmt, $sql);
                    mysqli_stmt_bind_param($stmt, "sssss", $email, $hashedPassword, $contactnumber, $username, $userId);
                } else {
                    mysqli_stmt_bind_param($stmt, "ssss", $email, $contactnumber, $username, $userId);
                }
            }
        
            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['user_id'] = $userId;
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                $_SESSION['contactnumber'] = $contactnumber;
                $_SESSION['guardianId'] = $guardianId;
                // Redirect to profile page with success message
                header("Location: profile.php?update=success");
                exit();
            } else {
                // Handle errors, perhaps redirect back with an error message
                header("Location: editprofile.php?update=error");
                exit();
            }
        } else if($_SERVER["REQUEST_METHOD"] == "GET"){
            // Debugging information if the request method is not POST
            echo "Request Method: " . $_SERVER["REQUEST_METHOD"] . "<br>";
            echo "Form Data Received:<br>";
            echo "<pre>";
            print_r($_GET); // Assuming data might be sent via GET if not POST
            echo "</pre>";
            // exit();
        } else{
            echo "no";
        }
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styles/style2.css">
</head>
<body>
    <div class="container">
        <div class="profile">
            <h1>Edit Profile</h1>
            <form action="editprofile.php" method="post">
                <?php if(isset($_SESSION['user_id'])): ?>
                    <div class="info">
                        <?php if($_SESSION['user_role'] === 'Admin'): ?>
                            <div>
                                <label for="admin_id">Admin_ID:</label><br>
                                <input type="text" id="admin_id" name="admin_id" value="<?php echo htmlspecialchars($_SESSION["user_id"]); ?>" readonly><br>
                            </div>

                            <div>
                                <label for="a_username">A_Username:</label><br>
                                <input type="text" id="a_username" name="a_username" value="<?php echo htmlspecialchars($_SESSION["username"]); ?>"><br>
                            </div>
                            
                            <div>
                                <label for="a_email">A_Email:</label><br>
                                <input type="email" id="a_email" name="a_email" value="<?php echo htmlspecialchars($_SESSION["email"]); ?>"><br>
                            </div>
                            
                            <div>
                                <label for="a_password">A_Password:</label><br>
                                <input type="password" id="a_password" name="a_password" value=""><br>
                                <small>Leave blank to keep current password.</small>
                            </div>
                            
                        <?php elseif($_SESSION['user_role'] === 'Student'): ?>
                            <div>
                                <label for="student_id">Student_ID:</label><br>
                                <input type="text" id="student_id" name="student_id" value="<?php echo htmlspecialchars($_SESSION["user_id"]); ?>" readonly><br>
                            </div>

                            <div>
                                <label for="s_username">S_Username:</label><br>
                                <input type="text" id="s_username" name="s_username" value="<?php echo htmlspecialchars($_SESSION["username"]); ?>"><br>
                            </div>
                            
                            <div>
                                <label for="s_email">S_Email:</label><br>
                                <input type="email" id="s_email" name="s_email" value="<?php echo htmlspecialchars($_SESSION["email"]); ?>"><br>
                            </div>

                            <div>
                                <label for="s_password">S_Password:</label><br>
                                <input type="password" id="s_password" name="s_password" value=""><br>
                                <small>Leave blank to keep current password.</small>
                            </div>

                            <div>
                                <label for="s_contact_number">S_Contact_Number:</label><br>
                                <input type="text" id="s_contact_number" name="s_contact_number" value="<?php echo htmlspecialchars($_SESSION["contactnumber"]); ?>"><br>
                            </div>
                            
                            <div>
                                <label for="guardianId">Guardian_ID:</label><br>
                                <input type="text" id="guardianId" name="guardianId" value="<?php echo htmlspecialchars($_SESSION["guardianId"]); ?>" readonly><br>
                            </div>
                            
                        <?php elseif($_SESSION['user_role'] === 'Lecturer'): ?>
                            <div>
                                <label for="lecturer_id">Lecturer_ID:</label><br>
                                <input type="text" id="lecturer_id" name="lecturer_id" value="<?php echo htmlspecialchars($_SESSION["user_id"]); ?>" readonly><br>
                            </div>

                            <div>
                                <label for="l_username">L_Username:</label><br>
                                <input type="text" id="l_username" name="l_username" value="<?php echo htmlspecialchars($_SESSION["username"]); ?>"><br>
                            </div>
                            
                            <div>
                                <label for="l_email">L_Email:</label><br>
                                <input type="email" id="l_email" name="l_email" value="<?php echo htmlspecialchars($_SESSION["email"]); ?>"><br>
                            </div>

                            <div>
                                <label for="l_password">LPassword:</label><br>
                                <input type="password" id="l_password" name="l_password" value=""><br>
                                <small>Leave blank to keep current password.</small>
                            </div>

                            <div>
                                <label for="l_contact_number">L_Contact_Number:</label><br>
                                <input type="text" id="l_contact_number" name="l_contact_number" value="<?php echo htmlspecialchars($_SESSION["contactnumber"]); ?>"><br>
                            </div>
                            
                            
                        <?php elseif($_SESSION['user_role'] === 'Guardian'): ?>
                            <div>
                                <label for="guardian_id">Guardian_ID:</label><br>
                                <input type="text" id="guardian_id" name="guardian_id" value="<?php echo htmlspecialchars($_SESSION["user_id"]); ?>" readonly><br>
                            </div>

                            <div>
                                <label for="g_username">G_Username:</label><br>
                                <input type="text" id="g_username" name="g_username" value="<?php echo htmlspecialchars($_SESSION["username"]); ?>"><br>
                            </div>
                            
                            <div>
                                <label for="g_email">G_Email:</label><br>
                                <input type="email" id="g_email" name="g_email" value="<?php echo htmlspecialchars($_SESSION["email"]); ?>"><br>
                            </div>

                            <div>
                                <label for="g_password">G_Password:</label><br>
                                <input type="password" id="g_password" name="g_password" value=""><br>
                                <small>Leave blank to keep current password.</small>
                            </div>

                            <div>
                                <label for="g_contact_number">G_Contact_Number:</label><br>
                                <input type="text" id="g_contact_number" name="g_contact_number" value="<?php echo htmlspecialchars($_SESSION["contactnumber"]); ?>"><br>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>                
                <div>
                    <input type="button" value="Back" name="backButton" class="backButton">
                    <input type="submit" value="Update Profile" name="btnUpdate">
                </div>
            </form> 
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.backButton').addEventListener('click', function() {
                window.location.href = 'profile.php';
            });
        });
    </script>
</body>
</html>