<?php
include 'header.php';
include 'connection.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = mysqli_prepare($conn, "SELECT * FROM guardian WHERE G_Email = ?");
    if (!$stmt) {
        echo "Prepare failed: ". mysqli_error($conn);
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        // Verify password
        if (password_verify($password, $user['G_Password'])) {
            $_SESSION['user_id'] = $user['Guardian_ID'];
            $_SESSION['username'] = $user['G_Username'];
            $_SESSION['email'] = $user['G_Email'];
            $_SESSION['password'] = $user['G_Password'];
            $_SESSION['contactnumber'] = $user['G_Contact_Number'];
            $_SESSION['user_role'] = 'Guardian';

            header("Location: profile.php");
            exit();
        } else {
            $error_message = "Invalid email or password";
        }
    } else {
        $error_message = "Invalid email or password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Guardian</title>
    <link rel="stylesheet" href="styles/login&signup.css">
</head>
<body>
    <div class="wrapper">
        <span class="icon-close">
            <ion-icon name="close-outline"></ion-icon>
        </span>
        <div class="form-box login">
            <h2>Login - Guardian</h2>
            <div class="role-buttons">
                <button type="button" class="role-btn" id="btn-student">Student</button>
                <button type="button" class="role-btn" id="btn-admin">Admin</button>
                <button type="button" class="role-btn" id="btn-guardian">Guardian</button>
                <button type="button" class="role-btn" id="btn-lecturer">Lecturer</button>
            </div>
            <form action="loginguardian.php" method="post">
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
                <button type="submit" class="btn">Login</button>
                <?php if (isset($error_message)) { ?>
                    <div class="error-message"><?php echo $error_message; ?></div>
                <?php } ?>
                <div class="login-register">
                    <p>Don't have an account?<a href="registerguardian.php" class="register-link"> Register</a></p>
                </div>
            </form>
        </div>
    </div>
    <script>
        const wrapper = document.querySelector('.wrapper');
        const iconClose = document.querySelector('.icon-close');
        const btnStudent = document.getElementById('btn-student');
        const btnAdmin = document.getElementById('btn-admin');
        const btnGuardian = document.getElementById('btn-guardian');
        const btnLecturer = document.getElementById('btn-lecturer');

        if (iconClose) {
            iconClose.addEventListener('click', () => {
                wrapper.classList.remove('active-popup');
            });
        }

        btnStudent.addEventListener('click', () => {
            window.location.href = 'loginstudent.php';
        });
        
        btnAdmin.addEventListener('click', () => {
            window.location.href = 'loginadmin.php';
        });

        btnGuardian.addEventListener('click', () => {
            window.location.href = 'loginguardian.php';
        });

        btnLecturer.addEventListener('click', () => {
            window.location.href = 'loginlecturer.php';
        });
    </script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
