<?php
    include 'connection.php';
    include 'header.php';
    
    if(isset($_POST['rating']) && isset($_POST['opinion'])) {
        $rating = $_POST['rating'];
        $reviews = $_POST['opinion'];
        
        $sql = "INSERT INTO feedback (Rating, Reviews) VALUES ('$rating', '$reviews')";
        $result = mysqli_query($conn, $sql);
        
        if($result) {
            echo "<script>alert('Feedback submitted successfully!'); window.location.href='profile.php';</script>";
            exit;
        } else {
            echo "<script>alert('Failed to submit feedback');</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="styles/studentfeedback.css">
	<title>Form Reviews</title>
</head>
<body>
    <div class="container">
        <h1>Feedback</h1>
        <div class="wrapper">
            <h3>Rating</h3>
            <form action="studentfeedback.php" method="post">
                <div class="rating">
                    <i class='bx bx-star star' style="--i: 0;"></i>
                    <i class='bx bx-star star' style="--i: 1;"></i>
                    <i class='bx bx-star star' style="--i: 2;"></i>
                    <i class='bx bx-star star' style="--i: 3;"></i>
                    <i class='bx bx-star star' style="--i: 4;"></i>
                </div>
                <input type="hidden" name="rating" value="">
                <h3>Review</h3>
                <textarea name="opinion" cols="30" rows="5" placeholder="Your opinion..." required></textarea>
                <div class="btn-group">
                    <button type="submit" class="btn submit">Submit</button>
                    <button class="btn cancel" onclick="window.location.href='student-dashboard.php'">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <script src="studentfeedback.js"></script>
</body>
</html>