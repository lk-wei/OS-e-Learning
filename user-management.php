<?php
    include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/user-management.css">
    <title>Document</title>

    <script>
        window.onload = function() {
            <?php if(isset($_SESSION['success'])): ?>
                alert("<?php echo $_SESSION['success']; ?>");
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>
        };
    </script>
</head>
<body>
    <div class="container">
        <div class="title">
            <h1>
                User Management
            </h1>
        </div>

        <div class="custom-line"></div>

        <div class="filter">
            <div class="select-box">
                <select id="user-role" name="user-role">
                    <option value="" selected></option>
                    <option value="Admin">Admin</option>
                    <option value="Student">Student</option>
                    <option value="Guardian">Guardian</option>
                    <option value="Lecturer">Lecturer</option>
                </select>
            </div>
    
            <div class="button-group">
                <button id="create-user-btn" class="create-user-btn">Create User</button>
            </div>
        </div>
        
        <div class="custom-line"></div>

        <div id="tableContainer">
            <table id= "role-table" class="role-table">
                <thead>
                    <tr>
                        <th id="name-column" class="table-head">Name </th>
                        <th id="email-column" class="table-head">Email</th>
                        <th id="others-column" class="table-head">Others</th>
                    </tr>
                </thead>
                <tr class="table-line">
                    <td colspan="4"></td>
                </tr>
                <tbody>
                    <tr>
                        <!-- Data will be displayed here -->
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Admin Form -->
        <div id="signupModal" class="signup-modal">
            <div class="signup-modal-content">
                <span class="close">&times;</span>
                <form class="adminForm" id="adminForm" action="submitAdmin.php" style="display:none;" method="post">
                    <input type="text" id="adminUsername" name="A_Username" placeholder="Name">
                    <input type="email" id="adminEmail" name="A_Email" placeholder="Email">
                    <input type="password" id="adminPassword" name="A_Password" placeholder="Password">
                    <!-- Other admin-specific inputs -->
                    <button type="submit" class="submitForm" data-role="Admin">Submit</button>
                </form>
        
                <!-- Student Form -->
                <form class="studentForm" id="studentForm" action="submitStudent.php" style="display:none;" method="post">
                    <input type="text" id="studentUsername" name="S_Username" placeholder="Name">
                    <input type="email" id="studentEmail" name="S_Email" placeholder="Email">
                    <input type="password" id="studentPassword" name="S_Password" placeholder="Password">
                    <input type="text" id="studentContactNumber" name="S_Contact_Number" placeholder="Contact Number">
                    <input type="text" id="studentGuardianID" name="Guardian_ID" placeholder="Guardian ID">
                    <!-- Other user-specific inputs -->
                    <button type="submit" class="submitForm" data-role="Student">Submit</button>
                </form>
        
                <!-- Lecturer Form -->
                <form class="lecturerForm" id="lecturerForm" action="submitLecturer.php" style="display:none;" method="post">
                    <input type="text" id="lecturerUsername" name="L_Username" placeholder="Username">
                    <input type="email" id="lecturerEmail" name="L_Email" placeholder="Email">
                    <input type="password" id="lecturerPassword" name="L_Password" placeholder="Password">
                    <input type="text" id="lecturerContactNumber" name="L_Contact_Number" placeholder="Contact Number">
                    <!-- Other user-specific inputs -->
                    <button type="submit" class="submitForm" data-role="Lecturer">Submit</button>
                </form>
        
                <!-- Guardian Form -->
                <form class="guardianForm" id="guardianForm" action="submitGuardian.php" style="display:none;" method="post">
                    <input type="text" id="guardianUsername" name="G_Username" placeholder="Name">
                    <input type="email" id="guardianEmail" name="G_Email" placeholder="Email">
                    <input type="password" id="guardianPassword" name="G_Password" placeholder="Password">
                    <input type="text" id="guardianContactNumber" name="G_Contact_Number" placeholder="Contact Number">
                    <!-- Other user-specific inputs -->
                    <button type="submit" class="submitForm" data-role="Guardian">Submit</button>
                </form>
            </div>
        </div>
    </div>
    
    <script src="user-management.js"></script>
</body>
</html>