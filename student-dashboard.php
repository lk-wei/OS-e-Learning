<?php 
    include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/stu-dashboard-style.css">
    <title>Dashboard</title>
</head>
<body>
    <div class="container">
        <div class="btn-div">
            <button onclick="window.location.href='gamemenu.php'">
                <img src="source/stadia_controller_24dp_FILL0_wght400_GRAD0_opsz24.png" alt="Mini Game Page">
                Mini Games
            </button>
            <button onclick="window.location.href='studentmodule.php'">
                <img src="source/play_circle_24dp_FILL0_wght400_GRAD0_opsz24.png" alt="Main Page">
                Main
            </button>
            <button onclick="window.location.href='logout.php'">
                <img src="source/lock_24dp_FILL0_wght400_GRAD0_opsz24.png" alt="Log Out">
                Logout
            </button>
        </div>
    </div>
</body>
</html>