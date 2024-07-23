<?php
include('connection.php'); 
include 'header.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$chapterId = isset($_GET['chapterId']) ? (int)$_GET['chapterId'] : 0;

// Fetch questions and answers
$sql = "SELECT Question_ID, Question, Answer, Option_2, Option_3, Option_4 FROM question WHERE Chapter_ID = $chapterId";
$result = $conn->query($sql);

$questions = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Prepare the answers array
        $answers = [
            ['text' => htmlspecialchars($row['Answer']), 'id' => 'a1'],
            ['text' => htmlspecialchars($row['Option_2']), 'id' => 'a2'],
            ['text' => htmlspecialchars($row['Option_3']), 'id' => 'a3'],
            ['text' => htmlspecialchars($row['Option_4']), 'id' => 'a4'],
        ];
        
        // Shuffle the answers array
        shuffle($answers);

        $questions[] = [
            'Question_ID' => $row['Question_ID'],
            'Question' => htmlspecialchars($row['Question']),
            'Answers' => $answers
        ];
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Page</title>
    <link rel="stylesheet" href="styles/quiz.css">
</head>
<body>
    <form action="submit_answers.php?chapterId=<?php echo $chapterId; ?>" method="post">

        <div class="quiz-container">
            <?php foreach ($questions as $q): ?>
                <div class="question-category">
                    <div class="question"><?php echo $q['Question']; ?></div>
                </div>
                <div class="answer-category">
                    <div class="answers">
                        <?php foreach ($q['Answers'] as $answer): ?>
                            <div class="answer" onclick="selectAnswer('<?php echo $q['Question_ID']; ?>', '<?php echo $answer['id']; ?>')">
                                <input type="radio" name="question_<?php echo $q['Question_ID']; ?>" value="<?php echo $answer['text']; ?>" id="q<?php echo $q['Question_ID']; ?>_<?php echo $answer['id']; ?>" hidden>
                                <label for="q<?php echo $q['Question_ID']; ?>_<?php echo $answer['id']; ?>"><?php echo $answer['text']; ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="submit-button">
            <button type="submit">Submit</button>
        </div>
    </form>
    <script>
        function selectAnswer(questionId, answerId) {
            const radioButton = document.getElementById('q' + questionId + '_' + answerId);
            radioButton.checked = true;

            const answers = document.querySelectorAll('[name="question_' + questionId + '"]');
            answers.forEach(answer => {
                const answerLabel = answer.parentElement;
                answerLabel.classList.remove('selected');
            });

            const selectedLabel = radioButton.parentElement;
            selectedLabel.classList.add('selected');
        }

        document.addEventListener('DOMContentLoaded', () => {
            const answers = document.querySelectorAll('.answer input[type="radio"]:checked');
            answers.forEach(answer => {
                const answerLabel = answer.parentElement;
                answerLabel.classList.add('selected');
            });
        });
    </script>
</body>
</html>



