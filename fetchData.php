<?php

include 'connection.php';

// SQL queries to count feedbacks
$totalFeedbacksResult = $conn->query('SELECT COUNT(*) FROM feedback');
$totalFeedbacks = $totalFeedbacksResult->fetch_row()[0];

$positiveReviewsResult = $conn->query("SELECT COUNT(*) FROM feedback WHERE rating>3");
$positiveReviews = $positiveReviewsResult->fetch_row()[0];

$negativeReviewsResult = $conn->query("SELECT COUNT(*) FROM feedback WHERE rating<=3");
$negativeReviews = $negativeReviewsResult->fetch_row()[0];

$totalReviews = $positiveReviews + $negativeReviews;

// Calculate percentages
$positivePercentage = 0;
$negativePercentage = 0;
if ($totalReviews > 0) { // Prevent division by zero
    $positivePercentage = ($positiveReviews / $totalReviews) * 100;
    $negativePercentage = ($negativeReviews / $totalReviews) * 100;
}

// Fetch the top 3 highest feedback_ID
$topFeedbacksResult = $conn->query("SELECT * FROM feedback ORDER BY feedback_ID DESC LIMIT 3");
$topFeedbacks = $topFeedbacksResult->fetch_all(MYSQLI_ASSOC);

// Return results as JSON
echo json_encode([
    'totalFeedbacks' => $totalFeedbacks,
    'positiveReviews' => $positiveReviews,
    'negativeReviews' => $negativeReviews,
    'positivePercentage' => $positivePercentage,
    'negativePercentage' => $negativePercentage,
    'topFeedbacks' => $topFeedbacks,
]);

$conn->close();
?>