<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/studentmodule.css">
    <title>Select Chapter</title>
</head>
<body>
<div class="wrapper">
    <div class="chapter">
        <h1>Chapter</h1>
        <div class="container">
            <?php
            include('connection.php');
            include 'header.php';
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
                echo "<p>No results found</p>";
            }
            $conn->close();
            ?>
        </div>
    </div>
</div>
<script>
function loadNotesQuiz(chapterId) {
    window.location.href = "notesquiz.php?chapterId=" + chapterId;
}

document.addEventListener("DOMContentLoaded", function() {
    const buttons = document.querySelectorAll(".item");
    buttons.forEach(button => {
        button.addEventListener("click", function() {
            const chapterId = this.getAttribute("data-chapter-id");
            loadNotesQuiz(chapterId);
        });
    });
});
</script>
</body>
</html>
