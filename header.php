<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/header.css">
    <title>Document</title>
</head>
<body>
    <header id="header-container" class="header-container">
        <a href="<?php echo isset($_SESSION['username']) ? 'profile.php' : 'guest-page.php'; ?>" class="logo">LearnQuest</a>

        <nav class="nav-links">
            <ul>
                <li>
                    <a href="#">
                    <!-- About Us -->
                    </a>
                </li>
                <li>
                    <a href="#">
                        <!-- FAQ -->
                    </a>
                </li>
            </ul>
        </nav>

        <div class="sign-up-container">
            <?php if(isset($_SESSION['username'])): ?>
                <button class="sign-up-btn" onclick="window.location.href='profile.php';">
                    <p><?php echo htmlspecialchars($_SESSION['username']); ?></p>
                    <img class="profile-img" src="source/account_circle_24dp_FILL0_wght400_GRAD0_opsz24.png" alt="Profile Picture">
                </button>

                <div id="userRole" data-role="<?php echo isset($_SESSION['user_role']) ? htmlspecialchars($_SESSION['user_role']) : ''; ?>" style="display:none;"></div>            <?php else: ?>
                <button class="sign-up-btn" onclick="window.location.href='loginadmin.php'">
                    <p>Sign Up</p>
                    <img class="profile-img" src="source/account_circle_24dp_FILL0_wght400_GRAD0_opsz24.png" alt="Profile Picture">
                </button>
            <?php endif; ?>
        </div>
    </header>
    <script src="header.js"></script>
</body>
</html>