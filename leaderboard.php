<?php
    include 'connection.php';
    include 'header.php';

    // SQL query to fetch leaderboard data
    $sql = "SELECT student.S_Username, SUM(progression.Score) AS total_score
            FROM progression
            INNER JOIN student ON student.Student_ID = progression.Student_ID
            GROUP BY student.S_Username
            ORDER BY total_score DESC";

    $result = $conn->query($sql);

    $leaderboard = array();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $leaderboard[] = $row;
        }
    } else {
        echo "0 results";
    }
    $conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            position: relative;
        }

        body::before{
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('source/game-doodle.jpg');  
            background-position:center;
            background-repeat:repeat;
            opacity: 0.15;
            z-index: -1;
        }

        .container {
            background-color: #ffffff;
            padding: 40px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            max-width: 800px;
            width: 100%;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: #ffffff;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Leaderboard</h1>
        <table id="leaderboard">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Username</th>
                    <th>Total Score</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($leaderboard as $index => $player): ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo htmlspecialchars($player['S_Username']); ?></td>
                        <td><?php echo htmlspecialchars($player['total_score']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>