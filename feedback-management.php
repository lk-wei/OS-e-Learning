<?php
    include 'header.php';
    include 'connection.php';

    $positiveReviewsResult = $conn->query("SELECT COUNT(*) FROM feedback WHERE rating>3");
    $positiveReviews = $positiveReviewsResult->fetch_row()[0];

    $negativeReviewsResult = $conn->query("SELECT COUNT(*) FROM feedback WHERE rating<=3");
    $negativeReviews = $negativeReviewsResult->fetch_row()[0];

    $totalReviews = $positiveReviews + $negativeReviews;

    $positivePercentage = 0;
    $negativePercentage = 0;
    if ($totalReviews > 0) { // Prevent division by zero
        $positivePercentage = ($positiveReviews / $totalReviews) * 100;
        $negativePercentage = ($negativeReviews / $totalReviews) * 100;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/feedback-management.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="title">
            <h1>Dashboard</h1>
        </div>

        <div class="statistics">
            <div class="feedback-count">
                <h2>Total Feedbacks</h2>
                <p>0</p>
            </div>

            <div class="custom-line"></div>

            <div class="positive-reviews">
                <h2>Positive Reviews</h2>
                <p>0</p>
            </div>

            <div class="custom-line second"></div>

            <div class="negative-reviews">
                <h2>Negative Reviews</h2>
                <p>0</p>
            </div>
        </div>

        <div class="feedback-bar">
            <div class="positive-feedback" style="width: <?php echo $positivePercentage; ?>%;"></div>
        </div>

        <div class="feedback-container">
            <h2>Recent Feedbacks</h2>
            <div class="feedback">
                <div class="feedback-header">
                    <!-- <img src="avatar.jpg" alt="User Avatar" class="avatar"> -->
                    <div class="user-info">
                        <span class="name">Anonymous</span>
                        <div class="star-rating">
                            <span class="star selected">&#9733;</span> 
                            <span class="star selected">&#9733;</span>
                            <span class="star selected">&#9733;</span>
                            <span class="star">&#9733;</span> 
                            <span class="star">&#9733;</span>
                        </div>
                    </div>
                </div>

                <div class="feedback-content">
                    <!-- Here's the content of the tweet. It can be text, images, or both. -->
                </div>
            </div>

            <div class="feedback">
                <div class="feedback-header">
                    <!-- <img src="avatar.jpg" alt="User Avatar" class="avatar"> -->
                    <div class="user-info">
                        <span class="name">Anonymous</span>
                        <div class="star-rating">
                            <span class="star selected">&#9733;</span> 
                            <span class="star selected">&#9733;</span>
                            <span class="star selected">&#9733;</span>
                            <span class="star selected">&#9733;</span> 
                            <span class="star">&#9733;</span>
                        </div>
                    </div>
                </div>

                <div class="feedback-content">
                    <!-- Here's the content of the tweet. It can be text, images, or both. -->
                </div>
            </div>

            <div class="feedback">
                <div class="feedback-header">
                    <!-- <img src="avatar.jpg" alt="User Avatar" class="avatar"> -->
                    <div class="user-info">
                        <span class="name">Anonymous</span>
                        <div class="star-rating">
                            <span class="star selected">&#9733;</span> 
                            <span class="star selected">&#9733;</span>
                            <span class="star selected">&#9733;</span>
                            <span class="star selected">&#9733;</span> 
                            <span class="star selected">&#9733;</span>
                        </div>
                    </div>
                </div>

                <div class="feedback-content">
                    <!-- Here's the content of the tweet. It can be text, images, or both. -->
                </div>
            </div>
        </div>
    </div>
    <script src="feedback-management.js"></script>
</body>
</html>