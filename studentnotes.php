<?php
include('connection.php');
include 'header.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $noteName = $_POST['noteName'];
    $content = $_POST['content'];
    $chapterId = $_POST['chapterId'];
    $studentId = $_SESSION['user_id'];

    $sql = "INSERT INTO notes (Notes_Name, Content, Chapter_ID, Student_ID) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $noteName, $content, $chapterId, $studentId);

    if ($stmt->execute()) {
        header("Location: notesquiz.php?chapterId=$chapterId");
        exit(); // Ensure no further code is executed after the redirect
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Note Editor</title>
    <link rel="stylesheet" href="styles/studentnotes.css">
</head>
<body>
    <button id="undo-button" class="undo-button">
        <img src="undo_24dp_FILL0_wght400_GRAD0_opsz24.png" alt="Undo">
    </button>    
    <form method="POST" action="">
        <input type="hidden" name="chapterId" value="<?php echo (int)$_GET['chapterId']; ?>">
        <textarea id="noteArea" name="content" placeholder="Start typing your notes here..." required></textarea>
        <input type="hidden" name="noteName" value="">
        <div class="save-button-container">
            <button type="submit" id="saveButton">Save</button>
        </div>
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('saveButton').addEventListener('click', function(event) {
                const noteName = prompt('Please enter the name for your note:');
                if (noteName) {
                    document.querySelector('input[name="noteName"]').value = noteName;
                } else {
                    alert('Note name is required to save.');
                    event.preventDefault(); // Prevent form submission if note name is not provided
                }
            });

            document.getElementById('undo-button').addEventListener('click', function() {
                window.location.href = 'notesquiz.php?chapterId=<?php echo (int)$_GET['chapterId']; ?>';
            });
        });
    </script>
</body>
</html>
