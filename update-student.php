<?php
    include 'connection.php';
    include 'header.php';

    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        if(!isset($_GET['id'])){
            header("Location: user-management.php");
            exit;
        }

        $id = $_GET['id'];

        $sql = "SELECT * FROM student WHERE Student_ID = $id";
        $result = mysqli_query($conn, $sql);

        $users = array();
        if ($result->num_rows === 1) {
        while($row = $result->fetch_assoc()) {
            $users[] = $row;
            }
        }
    }
    else{
        $id = $_POST['id'];
        $userID = $_POST['userID'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $contactnumber = $_POST['contactnumber'];
        $guardianID = $_POST['guardianID'];

        do {
            if(empty($userID)  || empty($username)|| empty($email) || empty($password) || empty($contactnumber) || empty($guardianID)){
                echo "Please fill in all fields";
                break;
            }
            $sql = "UPDATE student SET Student_ID = '$userID', S_Username = '$username', S_Email = '$email', S_Password = '$password', S_Contact_Number = '$contactnumber', Guardian_ID = '$guardianID' WHERE Student_ID = $id";

            $result = $conn->query($sql);

            if (!$result) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
                
            header("Location: user-management.php");
            exit;

        }while(true);  
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        body{
            font-family: Poppins, sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0;
            position: relative;
        }
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url(source/game-doodle.jpg);
            background-position:center;
            background-repeat:repeat;
            opacity: 0.15; 
            z-index: -1; 
        }
        .container {
            background-color: white;
            padding: 40px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        form {
            display: flex;
            flex-direction: column;
        }
        .form-group {
            display: flex;
            align-items: center;
            gap: 100px; /* Increased spacing */
            margin-bottom: 15px; /* Increased spacing */
        }
        label {
            margin-right: 10px; /* Space between label and input */
            font-size: 18px; /* Increased font size */
            width: 20%; /* Adjust based on preference */
        }
        input, input[type="submit"] {
            flex-grow: 1;
            font-size: 18px; /* Increased font size */
            padding: 10px; /* Padding for better visibility */
        }
        input[type="submit"] {
            font-family: Poppins, sans-serif;
            width: 100%;
            padding: 12px;
            background: linear-gradient(45deg, #007bff, #6610f2); /* Gradient background */
            color: #fff;
            border: none;
            border-radius: 8px; /* Rounded corners */
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle shadow */
            transition:  all 0.3s;
        }
        input[type="submit"]:hover {
            background: linear-gradient(45deg, #0056b3, #520dab);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }
        .back-button {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition-duration: 0.4s;
        }
        .back-button:hover {
            background-color: #0056b3;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <form method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
            <div class="form-group">
                <label for="userID">Student_ID:</label>
                <input type="text" id="userID" name="userID" required value="<?php echo htmlspecialchars($users[0]['Student_ID']); ?>">
            </div>
            
            <div class="form-group">
                <label for="age">S_Username:</label>
                <input type="text" id="username" name="username" required value="<?php echo htmlspecialchars($users[0]['S_Username']); ?>">
            </div>

            <div class="form-group">
                <label for="email">S_Email:</label>
                <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($users[0]['S_Email']); ?>">
            </div>
            
            <div class="form-group">
                <label for="age">S_Password:</label>
                <input type="password" id="password" name="password" required value="<?php echo htmlspecialchars($users[0]['S_Password']); ?>">
            </div>
            
            <div class="form-group">
                <label for="age">S_Contact_Number:</label>
                <input type="text" id="contactnumber" name="contactnumber" required value="<?php echo htmlspecialchars($users[0]['S_Contact_Number']); ?>">
            </div>

            <div class="form-group">
                <label for="age">Guardian_ID:</label>
                <input type="number" id="password" name="guardianID" required value="<?php echo htmlspecialchars($users[0]['Guardian_ID']); ?>">
            </div>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>