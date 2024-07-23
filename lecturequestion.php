<?php
include('connection.php'); 
include 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $chapterId = (int)$_GET['chapterId'];
    $question = $_POST['question'];
    $correctAns = $_POST['correctAnswer'];
    $answer1 = $_POST['answer1'];
    $answer2 = $_POST['answer2'];
    $answer3 = $_POST['answer3'];
    $answer4 = $_POST['answer4'];

    $answers = array($answer1,$answer2,$answer3,$answer4);

    for ($i = 0; $i < count($answers); $i++){
        if (($i +1) == (int)$correctAns){
            $correctAns = $answers[$i];
            unset($answers[$i]);
            break;
        }
    }
    $answers = array_values($answers);

    $stmt = $conn->prepare("INSERT INTO `question`(`Question`, `Chapter_ID`, `Answer`, `Option_2`, `Option_3`, `Option_4`) VALUES ('$question', '$chapterId', '$correctAns', '$answers[0]', '$answers[1]', '$answers[2]')");


    if ($stmt->execute()){
        echo "success";
        header("Location: lecturenotesquiz.php?chapterId=$chapterId");
    }else{
        echo "failed";
    }

    $stmt->close();

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .quiz-form {
            background-color: #f2f2f2;
            padding: 20px;
            margin: auto;
            width: 50%;
            border-radius: 5px;
        }
        .quiz-form h2 {
            text-align: center;
        }
        .quiz-form label {
            margin-bottom: 10px;
            display: block;
        }
        .quiz-form input[type="text"] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .quiz-form input[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .quiz-form input[type="submit"]:hover {
            background-color: #45a049;
        }
        .answer-group {
            margin-bottom: 20px;
        }
        .answer-group input[type="radio"] {
            margin-top: 10px;
        }
    </style>
    <title>Create New Question</title>
</head>
<body>

<div class="quiz-form">
    <h2>Create a New Quiz</h2>
    <form action="" method="post">
        <label for="question">Question:</label>
        <input type="text" id="question" name="question" required>
        
        <div class="answer-group">
            <label for="answer1">Answer 1:</label>
            <input type="text" id="answer1" name="answer1" placeholder="Answer 1" required>
            <input type="radio" id="correct1" name="correctAnswer" value="1" required>
        </div>
        
        <div class="answer-group">
            <label for="answer2">Answer 2:</label>
            <input type="text" id="answer2" name="answer2" placeholder="Answer 2" required>
            <input type="radio" id="correct2" name="correctAnswer" value="2" required>
        </div>
        
        <div class="answer-group">
            <label for="answer3">Answer 3:</label>
            <input type="text" id="answer3" name="answer3" placeholder="Answer 3" required>
            <input type="radio" id="correct3" name="correctAnswer" value="3" required>
        </div>
        
        <div class="answer-group">
            <label for="answer4">Answer 4:</label>
            <input type="text" id="answer4" name="answer4" placeholder="Answer 4" required>
            <input type="radio" id="correct4" name="correctAnswer" value="4" required>
        </div>
        
        <input type="submit" value="Submit">
    </form>
</div>
</div>
</body>
</html>