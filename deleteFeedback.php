<?php
    header('Access-Control-Allow-Origin: *'); 
    header('Content-Type: application/json');

    $sname = "localhost";
    $uname = "root";
    $password = "";
    $db_name = "sdp_database";

    $conn = mysqli_connect($sname, $uname, $password, $db_name);

    if(!$conn) {
        die("Connection Failed: " . mysqli_connect_error());
    }

    // Check if the ID is set in the POST request
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $userId = $_POST['feedbackId'];
    
        if (is_null($userId) || !is_numeric($userId)) {
            echo json_encode(['success' => false, 'message' => 'Invalid Feedback ID']);
            exit;
        }
    
        // Prepare the SQL statement to prevent SQL injection
        $stmt = $conn->prepare("DELETE FROM feedback WHERE Feedback_ID = ?");
        if (!$stmt) {
            echo json_encode(['success' => false, 'message' => 'Error preparing statement: ' . $conn->error]);
            exit;
        }
    
        $stmt->bind_param("i", $userId); // 'i' specifies the variable type => 'integer'
    
        // Execute the statement
        if ($stmt->execute()) {
            // Check if any row was affected
            if ($stmt->affected_rows > 0) {
                echo json_encode(['success' => true, 'message' => 'Feedback deleted successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Feedback not found or already deleted']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Error deleting feedback: ' . $stmt->error]);
        }
    
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    }
    
    $conn->close();
?>