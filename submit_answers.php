<?php
include('connection.php'); 
include 'header.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$chapterId = isset($_GET['chapterId']) ? (int)$_GET['chapterId'] : 0;

$Student_id = $_SESSION['user_id'];
// Fetch questions and answers to validate the responses
$sql = "SELECT Question_ID, Answer FROM question where Chapter_ID = $chapterId";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

$correctAnswers = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $correctAnswers[$row['Question_ID']] = $row['Answer'];
    }
}

$totalQuestions = count($correctAnswers);
$correctCount = 0;

// Iterate through the submitted answers and compare with correct answers
foreach ($_POST as $questionID => $userAnswer) {
    // Validate questionID and userAnswer if necessary
    $qid = str_replace('question_', '', $questionID);
    if (isset($correctAnswers[$qid]) && $correctAnswers[$qid] == $userAnswer) {
        $correctCount++;
    }
}
$score = $correctCount*10;

// Calculate the score
$scorePercentage = 0;
if ($totalQuestions > 0) {
    $scorePercentage = ($correctCount / $totalQuestions) * 100;
}

$search_stmt = $conn->prepare("SELECT Progression_ID FROM progression WHERE Student_ID = ? AND Chapter_ID = ?");
$search_stmt->bind_param("ii", $Student_id, $chapterId); // Assuming both IDs are integers
$search_stmt->execute();
$search_result = $search_stmt->get_result();

if ($search_result->num_rows > 0) {
    while ($row = $search_result->fetch_assoc()) {
        $progression_id = $row['Progression_ID'];
        $delete_stmt = $conn->prepare("DELETE FROM progression WHERE Progression_ID = ?");
        $delete_stmt->bind_param("i", $progression_id);
        $delete_stmt->execute();
    }
}

$stmt = $conn->prepare("INSERT INTO `progression`(`Student_ID`, `Chapter_ID`, `Score`, `Status`) VALUES ('$Student_id','$chapterId','$score','Complete')");

if ($stmt->execute()){
    echo "<script>console.log('success')</script>";
}else{
    echo "<script>console.log('failed')</script>";
}

$stmt->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Results</title>
    <link rel="stylesheet" href="quiz.css">
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    body {
    font-family: 'Poppins', cursive; /* This is a pixelated font */
    background-color: #1e1e1e; /* Dark background for a game-like feel */
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    color: #ffffff; /* Light text color for contrast */
}

    body::before{
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: url('source/game-doodle.jpg');  
        background-position:center;
        background-repeat:repeat;
        opacity: 0.15;
        z-index: -1;
    }

    .result-container {
    background-color: #212121; /* Dark container */
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    transition: transform 0.3s; /* Add some transition for dynamic effect */
    }

    .result-container:hover {
        transform: scale(1.05); /* Scale the container on hover */
    }

    h1 {
        font-size: 24px;
        margin-bottom: 20px;
        color: #ff9800; /* Vibrant color for the heading */
    }
    p {
        font-size: 18px;
        margin: 10px 0;
        color: #b2dfdb; /* Lighter text color for contrast */
    }

    a{
        text-decoration: none;
        color: white;
        font-size: 18px;
        display: block;
        margin-top: 20px;
    
    }

</style>
<body>
    <div class="result-container">
        <h1>Quiz Results</h1>
        <p>You got <?php echo $correctCount; ?> out of <?php echo $totalQuestions; ?> questions correct.</p>
        <p>Your score is <?php echo number_format($scorePercentage, 2); ?>%</p>
        <a href="notesquiz.php?chapterId=<?php echo $chapterId?>">Take Quiz Again</a>
    </div>
</body>
</html>