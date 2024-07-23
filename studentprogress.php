<?php
include('connection.php');
include 'header.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: loginguardian.php");
    exit();
}

if (!isset($_GET['Student_ID'])) {
    echo "No student selected.";
    exit();
}

$student_id = $_GET['Student_ID'];

// Fetch student username
$sql = "SELECT S_Username FROM student WHERE Student_ID = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $student_username = htmlspecialchars($row["S_Username"]);
} else {
    echo "Student not found.";
    exit();
}

$stmt->close();

// Fetch progression data
$sql_progression = "SELECT Chapter_ID, Score FROM progression WHERE Student_ID = ?";
$stmt_progression = $conn->prepare($sql_progression);
if ($stmt_progression === false) {
    die("Prepare failed: " . $conn->error);
}

$stmt_progression->bind_param("i", $student_id);
$stmt_progression->execute();
$result_progression = $stmt_progression->get_result();

$progression_data = [];
while ($row = $result_progression->fetch_assoc()) {
    $progression_data[] = $row;
}

$stmt_progression->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Progress</title>
    <link rel="stylesheet" href="styles/guardiancheck.css">
    <style>
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

        .container {
            background-color: #ffffff;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            margin: 50px auto;
            max-width: 600px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .container h2 {
            font-size: 22px;
            color: #555;
            margin-bottom: 10px;
            text-align: center;
        }

        .container h3 {
            font-size: 18px;
            color: #777;
            margin-bottom: 5px;
        }

        .progression {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #ccc;
        }

        .progression-header {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 2px solid #333;
        }

        .undo-button:hover {
            background-color: #ff5733;
        }
    </style>
</head>
<body>
    <button id="undo-button" class="undo-button">
        <img src="undo_24dp_FILL0_wght400_GRAD0_opsz24.png" alt="Undo">
    </button>
    <h2 style="text-align: center;"><?php echo $student_username; ?></h2>
    <div class="container">
        <h2>Progression</h2>
        <div class="progression-header">
            <h3>Chapter_ID</h3>
            <h3>Chapter_Score</h3>
        </div>
        <?php if (!empty($progression_data)) : ?>
            <?php foreach ($progression_data as $progression) : ?>
                <div class="progression">
                    <h3><?php echo htmlspecialchars($progression['Chapter_ID']); ?></h3>
                    <h3><?php echo htmlspecialchars($progression['Score']); ?></h3>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>No progression data available.</p>
        <?php endif; ?>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const undoButton = document.getElementById('undo-button');
        
            undoButton.addEventListener('click', function () {
                window.location.href = 'guardiancheck.php';
            });
        });
    </script>
</body>
</html>
