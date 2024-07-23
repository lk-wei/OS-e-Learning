<?php
include('connection.php');
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/studentmodule.css">
    <title>Document</title>
</head>
<body>
<div class="wrapper">
    <div class="chapter">
        <h1>Chapter</h1>
        <div class="container">
            <?php
            $sql = "SELECT Chapter_ID, Description FROM Chapter";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="item-container">';
                    echo '<button class="item" data-chapter-id="' . $row["Chapter_ID"] . '">' . $row["Chapter_ID"] . '</button>';
                    echo '<div class="CD">';
                    echo '<h2>Chapter Details</h2>';
                    echo '<h3>' . $row["Description"] . '</h3>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>
        </div>
    </div>
</div>
<script>
    function loadNotesQuiz(event) {
        const chapterId = event.target.getAttribute('data-chapter-id');
        window.location.href = "lecturenotesquiz.php?chapterId=" + chapterId;
    }

    document.addEventListener("DOMContentLoaded", function() {
        const buttons = document.querySelectorAll(".item");
        buttons.forEach(button => {
            button.addEventListener("click", loadNotesQuiz);
        });
    });
</script>
</body>
</html>