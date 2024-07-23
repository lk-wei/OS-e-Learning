<?php
include('connection.php');

// Get Note_ID and Chapter_ID from query parameters
$noteId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$chapterId = isset($_GET['chapterId']) ? (int)$_GET['chapterId'] : 0;

// Fetch note details based on Note_ID
$sql = "SELECT Notes_Name, Content FROM notes WHERE Notes_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $noteId);
$stmt->execute();
$result = $stmt->get_result();
$note = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $noteName = $_POST['noteName'];
    $content = $_POST['content'];

    $update_sql = "UPDATE notes SET Notes_Name = ?, Content = ? WHERE Notes_ID = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ssi", $noteName, $content, $noteId);

    if ($update_stmt->execute()) {
        header("Location: notesquiz.php?chapterId=$chapterId");
        exit(); // Ensure no further code is executed after the redirect
    } else {
        echo "Error: " . $update_stmt->error;
    }

    $update_stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Note</title>
    <link rel="stylesheet" href="studentnotes.css">
    <style>
        /* Include the same CSS styles as in the make note page */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .undo-button {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 10px;
            border: 3px solid #333;
            border-radius: 100%;
            cursor: pointer;
            background-color: #ff6f61;
            color: white;
        }

        .undo-button img {
            width: 50px;
            height: 50px;
        }

        #noteArea {
            height: 80vh;
            width: 80vw;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f5f5f5;
            resize: none;
        }

        .save-button-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 100;
        }

        #saveButton {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #saveButton:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <button id="undo-button" class="undo-button">
        <img src="undo_24dp_FILL0_wght400_GRAD0_opsz24.png" alt="Undo">
    </button>
    <form method="POST" action="">
        <input type="text" name="noteName" value="<?php echo htmlspecialchars($note['Notes_Name']); ?>" required>
        <textarea id="noteArea" name="content" required><?php echo htmlspecialchars($note['Content']); ?></textarea>

        <div class="save-button-container">
            <button id="saveButton" type="submit">Save</button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Undo button click event
            document.getElementById('undo-button').addEventListener('click', function() {
                window.location.href = 'notesquiz.php?chapterId=<?php echo (int)$_GET['chapterId']; ?>';
            });
        });
    </script>
</body>
</html>
