<?php
include('connection.php');
include 'header.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$guardian_id = $_SESSION['user_id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guardian - Student List</title>
    <link rel="stylesheet" href="styles/guardiancheck.css">
</head>
<body>
    <h2 style="text-align:center;">Student</h2>
    <div class="student-container">
        <?php
        $sql = "SELECT Student_ID, S_Username, S_Contact_Number FROM student WHERE Guardian_ID = ?";
        
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("i", $guardian_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<a href="studentprogress.php?Student_ID=' . htmlspecialchars($row["Student_ID"]) . '" class="student-detail">';
                echo '<div>';
                echo '<h2>' . htmlspecialchars($row["S_Username"]) . '</h2>';
                echo '<p>Student_ID: ' . htmlspecialchars($row["Student_ID"]) . '</p>';
                echo '<p>Student_Username: ' . htmlspecialchars($row["S_Username"]) . '</p>';
                echo '<p>Student_Contact_Number: ' . htmlspecialchars($row["S_Contact_Number"]) . '</p>';
                echo '</div>';
                echo '</a>';
            }
        } else {
            echo "0 results";
        }

        $stmt->close();
        $conn->close();
        ?>
    </div>
</body>
</html>