<?php
    include 'connection.php';
    include 'header.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $userId = $_SESSION['user_id'] ?? null;
        $user_role = $_SESSION['user_role'] ?? null;
        $table_name = null;
        $table_id = null;

        switch($user_role){
            case 'Student':
                $table_name = 'student';
                $table_id = 'Student_ID';
                break;
            case 'Admin':
                $table_name = 'admin';
                $table_id = 'Admin_ID';
                break;
            case 'Guardian':
                $table_name = 'guardian';
                $table_id = 'Guardian_ID';
                break;
            case 'Lecturer':
                $table_name = 'lecturer';
                $table_id = 'Lecturer_ID';
                break;
        }
        
        if($table_name && $userId) {
            $sql = "SELECT * FROM $table_name WHERE $table_id = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $userId);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if(mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
            }
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="styles/style.css">
</head>
<body>
    
    <div class="container">
        <div class="profile">
            <h1>User Profile</h1>
            <form action="profile.php" method="post">
                <?php if(isset($_SESSION['user_id'])): ?>
                    <div class="info">
                        <?php if($_SESSION['user_role'] === 'Admin'): ?>
                            <div>
                                <label for="name">Admin_ID:</label>
                                <?php echo htmlspecialchars($_SESSION["user_id"]); ?><br>
                            </div>

                            <div>
                                <label for="email">A_Username:</label>
                                <?php echo htmlspecialchars($_SESSION["username"]); ?><br>
                            </div>
                            
                            <div>
                                <label for="contact">A_Email:</label>
                                <?php echo htmlspecialchars($_SESSION["email"]); ?><br>
                            </div>
                            
                        <?php elseif($_SESSION['user_role'] === 'Student'): ?>
                            <div>
                                <label for="name">Student_ID:</label>
                                <?php echo htmlspecialchars($_SESSION["user_id"]); ?><br>
                            </div>

                            <div>
                                <label for="email">S_Username:</label>
                                <?php echo htmlspecialchars($_SESSION["username"]); ?><br>
                            </div>

                            <div>
                                <label for="contact">S_Email:</label>
                                <?php echo htmlspecialchars($_SESSION["email"]); ?><br>
                            </div>

                            <div>
                                <label for="contact">S_Contact_Number:</label>
                                <?php echo htmlspecialchars($_SESSION['contactnumber']); ?><br>
                            </div>

                            <div>
                                <label for="contact">Guardian_ID:</label>
                                <?php echo htmlspecialchars($_SESSION['guardianId']); ?><br>
                            </div>
                            
                        <?php elseif($_SESSION['user_role'] === 'Lecturer'): ?>
                            <div>
                                <label for="name">Lecturer_ID:</label>
                                <?php echo htmlspecialchars($_SESSION["user_id"]); ?><br>
                            </div>

                            <div>
                                <label for="email">L_Username:</label>
                                <?php echo htmlspecialchars($_SESSION["username"]); ?><br>
                            </div>

                            <div>
                                <label for="contact">L_Email:</label>
                                <?php echo htmlspecialchars($_SESSION["email"]); ?><br>
                            </div>

                            <div>
                                <label for="contact">L_Contact_Number:</label>
                                <?php echo htmlspecialchars($_SESSION['contactnumber']); ?><br>
                            </div>
                            
                            
                        <?php elseif($_SESSION['user_role'] === 'Guardian'): ?>
                            <div>
                                <label for="name">Guardian_ID:</label>
                                <?php echo htmlspecialchars($_SESSION["user_id"]); ?><br>
                            </div>

                            <div>
                                <label for="email">G_Username:</label>
                                <?php echo htmlspecialchars($_SESSION["username"]); ?><br>
                            </div>

                            <div>
                                <label for="contact">G_Email:</label>
                                <?php echo htmlspecialchars($_SESSION["email"]); ?><br>
                            </div>

                            <div>
                                <label for="contact">G_Contact_Number:</label>
                                <?php echo htmlspecialchars($_SESSION['contactnumber']); ?><br>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <div class="buttons">
                    <input type="button" value="Edit Profile" onclick="location.href='editprofile.php'">
                    <input type="button" value="Log Out" onclick="location.href='logout.php';">
                </div>
            </form>
        </div>
    </div>
</body>
</html>