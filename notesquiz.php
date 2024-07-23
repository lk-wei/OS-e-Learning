<?php
include('connection.php');
include 'header.php';

// Get Chapter_ID from query parameters
$chapterId = isset($_GET['chapterId']) ? (int)$_GET['chapterId'] : 0;
$_SESSION['chapterId'] = $chapterId;

// Fetch notes based on Chapter_ID
$sql = "SELECT Notes_ID, Notes_Name FROM notes WHERE Chapter_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $chapterId);
$stmt->execute();
$result = $stmt->get_result();

$notes = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $notes[] = $row;
    }
}

// Fetch quizzes based on Chapter_ID
$quizzes_sql = "SELECT Quiz_ID, Quiz_Name FROM quiz WHERE Chapter_ID = ?";
$quiz_stmt = $conn->prepare($quizzes_sql);
$quiz_stmt->bind_param("i", $chapterId);
$quiz_stmt->execute();
$quizzes_result = $quiz_stmt->get_result();

$quizzes = [];
if ($quizzes_result->num_rows > 0) {
    while($row = $quizzes_result->fetch_assoc()) {
        $quizzes[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes and Quizzes</title>
    <link rel="stylesheet" href="styles/notesquiz.css">
</head>
<body>
    <button id="undo-button" class="undo-button">
        <img src="undo_24dp_FILL0_wght400_GRAD0_opsz24.png" alt="Undo">
    </button>    
    <div class="quiz-container">
        <div class="box">
            <div class="container">
                <div class="option">
                    <button id="quiz-btn">Quiz</button>
                    <button id="notes-btn">Notes</button>
                    <button id="progression-btn" class="progression">Progression</button>
                </div>
                <div class="quiz active">
                    <div id="quiz-container">
                        <?php foreach ($quizzes as $quiz): ?>
                            <div class="quiz-item">
                                <p><?php echo htmlspecialchars($quiz['Quiz_Name']); ?></p>
                                <label><input type="checkbox"> Completed</label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="notes">
                    <div id="notes-container">
                        <?php foreach ($notes as $note): ?>
                            <div class="notes-item">
                                <a href="editnote.php?id=<?php echo $note['Notes_ID']; ?>&chapterId=<?php echo $chapterId; ?>"><?php echo htmlspecialchars($note['Notes_Name']); ?></a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="notesquiz.js"></script>
</body>
</html>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const quizButton = document.getElementById('quiz-btn');
    const notesButton = document.getElementById('notes-btn');
    const quizSection = document.querySelector('.quiz');
    const notesSection = document.querySelector('.notes');
    const progressionButton = document.getElementById('progression-btn');
    const undoButton = document.getElementById('undo-button');
    
    quizButton.addEventListener('click', function () {
        if (<?php echo $chapterId; ?> === 8) {
        alert('No quiz available! Redirecting to game...');
        window.location.href = 'gamemenu.php';
        } else {
            window.location.href = 'quiz.php?chapterId=<?php echo $chapterId; ?>';
            quizSection.classList.add('active');
            notesSection.classList.remove('active');
            progressionButton.textContent = 'Progression';
            progressionButton.onclick = null; // Remove any previous onclick handler
        }
    });

    notesButton.addEventListener('click', function () {
        notesSection.classList.add('active');
        quizSection.classList.remove('active');
        progressionButton.textContent = '+Add';
        progressionButton.onclick = function() {
            window.location.href = 'studentnotes.php?chapterId=<?php echo $chapterId; ?>';
        };
    });

    // Update this event listener to redirect to studentmodule.php
    undoButton.addEventListener('click', function () {
        window.location.href = 'studentmodule.php';
    });
});
</script>
