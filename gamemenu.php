<?php
    include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Selector</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url(source/game-doodle.jpg);
            background-position:center;
            background-repeat:repeat;
            opacity: 0.3; 
            z-index: -1; 
        }

        .container{
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .game-selector {
            text-align: center;
        }

        .game-option {
            display: inline-block;
            margin: 10px;
            padding: 15px 30px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 25px;
            transition: transform 0.3s ease, background-color 0.3s;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .game-option:hover {
            background-color: #2980b9;
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        .cat {
            margin-bottom: 30px;
        }

        .title {
            font-size: 28px;
            color: #333;
            font-weight: 600;
            margin-bottom: 20px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="game-selector">
            <div class="cat">
                <div class="title">Non-Preemptive</div>
                <a href="fcfs.html" class="game-option">First Come First Serve</a>
                <a href="sjf.html" class="game-option">Shortest Job First</a>
                <a href="priority.html" class="game-option">Priority</a>
            </div>
            <div class="cat">
                <div class="title">Page Replacement</div>
                <a href="fifopr.html" class="game-option">First In First Out</a>
                <a href="lrupr.html" class="game-option">Least Recently Used</a>
            </div>
        </div>
    </div>
</body>
</html>
