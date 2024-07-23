<?php
include('connection.php');
include 'header.php';
// Get Chapter_ID from query parameters
$chapterId = isset($_GET['chapterId']) ? (int)$_GET['chapterId'] : 0;

$questions_sql = "SELECT Question_ID, Question FROM question WHERE Chapter_ID = ?";
$question_stmt = $conn->prepare($questions_sql);
$question_stmt->bind_param("i", $chapterId);
$question_stmt->execute();
$questions_result = $question_stmt->get_result();

$questions = [];
if ($questions_result->num_rows > 0) {
    while($row = $questions_result->fetch_assoc()) {
        $questions[] = $row;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/notesquiz.css">
</head>

<style>
    .option {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
</style>

<body>
    <button id="undo-button" class="undo-button">
        <img src="undo_24dp_FILL0_wght400_GRAD0_opsz24.png" alt="Undo">
    </button>    
    <div class="question-container">
        <div class="box">
            <div class="container">
                <div class="option">
                    <button id="question-btn">Question</button>
                    <button id="add-btn" class="add" >+Add</button>
                </div>
                <div class="question active">
                    <div id="question-container">
                        <?php foreach ($questions as $question): ?>
                            <div class="question-item">
                                <p><?php echo htmlspecialchars($question['Question']); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const addButton = document.getElementById('add-btn');
        const undoButton = document.getElementById('undo-button');
        const chapterId = <?php echo $chapterId; ?>; // Extract Chapter ID from PHP

        // Redirect to lecturequestion.php with Chapter ID on +Add button click
        addButton.addEventListener('click', function() {
            window.location.href = 'lecturequestion.php?chapterId=' + chapterId;
        });

        // Redirect to lecturemodule.php with Chapter ID on undo button click
        undoButton.addEventListener('click', function () {
            window.location.href = 'lecturemodule.php?chapterId=' + chapterId;
        });
    });
</script>
</body>
</html>
