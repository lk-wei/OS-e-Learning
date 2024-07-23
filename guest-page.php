<?php
    include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles/guest-page.css">
    <title>LearnQuest</title>
</head>
<body>
    <div class="container">
        <div class="content">
            <h1>Learn. Play. Level Up.</h1>

            <div class="buttons">
                <button class="signup-button">Sign Up</button>
                <button class="login-button">Login</button>
            </div>

            <div class="scroll-indicator">
                <h2>Scroll down!</h2>
                <div class="scroll-down">&#x2193</div>
            </div>
        </div>

        <div class="features">
            <div class="game-intro">
                <div class="game-intro-pic">
                    <img src="source/game-pic.jpeg" alt="test photo">
                </div>

                <div class="game-intro-text">
                    <h1>Play while learning!</h1>
                    <p>Discover the ultimate way to learn and have fun! Our interactive games make education exciting and engaging. Join now and see how much you can achieve while having a blast!</p>
                </div>
            </div>
    
            <div class="leaderboard-intro">               
                <div class="leaderboard-intro-pic">
                    <img src="source/leaderboard-pic.jpeg" alt="test">
                </div>

                <div class="leaderboard-intro-text">
                    <h1>Go up the ranks!</h1>
                    <p>Join the competition and climb to the top! Our leaderboard lets you track your progress, challenge friends, and see who's the best. Get ready to play, learn, and dominate the charts!</p>
                </div>
            </div>
    
            <div class="point-system-intro">
                <div class="game-intro-text">
                    <img src="source/test.jpg" alt="test">
                </div>
                
                <div class="point-system-intro-text">
                    <h1>Accumulate points!</h1>
                    <p>Earn points with every challenge! Our games reward your learning and skills with points you can collect and use for exciting rewards. Start playing, learn more, and rack up those points!</p>
                </div>
            </div>
        </div>
    </div> 
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.signup-button').addEventListener('click', function() {
                window.location.href = 'registerstudent.php';
            });

            document.querySelector('.login-button').addEventListener('click', function() {
                window.location.href = 'loginstudent.php';
            });
        });
    </script>
</body>
</html>