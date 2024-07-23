const tableContainer = document.getElementById('tableContainer');
const selectBox = document.getElementById('user-role');

function insertCell(row, text) {
    let cell = row.insertCell();
    cell.textContent = text;
}

function setupTableForRole(role) {
    tableContainer.innerHTML = ''; // Clear existing table

    // Create a new table
    let table = document.createElement('table');
    table.className = 'role-table'; // Add a class for styling
    table.setAttribute('data-role', role);
    let thead = document.createElement('thead');
    let tbody = document.createElement('tbody');
    table.appendChild(thead);
    table.appendChild(tbody);

    let columns;

    // Define columns based on the role
    switch (role) {
        case 'Admin':
            columns = ['Admin ID', 'Username', 'Email', 'Password', 'Action'];
            break;
        case 'Student':
            columns = ['Student ID', 'Username', 'Email', 'Password', 'Contact Number','Guardian ID', 'Action'];
            break;
        case 'Guardian':
            columns = ['Guardian ID', 'Username', 'Email', 'Password', 'Contact Number', 'Action'];
            break;
        case 'Lecturer':
            columns = ['Lecturer ID', 'Username', 'Email', 'Password', 'Contact Number', 'Action'];
            break;
        default:
            columns = ['Username', 'Email', 'Contact Number', 'Action'];
    }

    // Define a mapping of column names to class names
    const columnClassMapping = {
        'Admin ID': 'id-head',
        'Student ID': 'id-head',
        'Lecturer ID': 'id-head',
        'Username':'table-head',
        'Email': 'table-head',
        'Password': 'table-head',
        'Contact Number': 'table-head',
        'Points': 'table-head',
        'Student Name': 'table-head',
        'Guardian ID':'id-head',
        'Action':'action-head',
    };

    const row = thead.insertRow();
    columns.forEach(col => {
        const th = document.createElement('th');
        th.textContent = col;
        th.className = columnClassMapping[col];

        row.appendChild(th);
    });

    // Append the table to the container
    tableContainer.appendChild(table);

    addCustomTableRow(table);

    fetchAndPopulateData(role, table);
}

function insertButtons(row) { 
    const actionCell = row.insertCell();
    actionCell.className = 'table-head';

    const updateButton = document.createElement('button');
    updateButton.textContent = 'Update';
    updateButton.className = 'update_user_btn';
    updateButton.id = 'update-user-btn';
    updateButton.onclick = function() {
        console.log('Update button clicked');
        const selectedRole = document.getElementById('user-role').value;
        const row = this.closest('.table-row');
        const rowId = row.getAttribute('data-id');

        if(selectedRole === 'Admin'){
            window.location.href = `update-admin.php?id=${rowId}`;
        } else if(selectedRole === 'Student'){
            window.location.href = `update-student.php?id=${rowId}`;
        } else if (selectedRole === 'Lecturer'){
            window.location.href = `update-lecturer.php?id=${rowId}`;
        } else if (selectedRole === 'Guardian'){
            window.location.href = `update-guardian.php?id=${rowId}`;
        }
        else {
            alert('Please select a role.');
        }
    };
    actionCell.appendChild(updateButton);

    const deleteButton = document.createElement('button');
    deleteButton.textContent = 'Delete';
    deleteButton.className = 'delete_user_btn';
    deleteButton.id = 'delete-user-btn';
    deleteButton.onclick = function() {
        // Your delete logic here
        console.log('Delete button clicked');
        const selectedRole = document.getElementById('user-role').value;
        const row = this.closest('.table-row');
        const rowId = row.getAttribute('data-id');
        let deleteUrl = ''; // Initialize the URL variable

        // Determine the URL based on the selected role
        switch (selectedRole) {
            case 'Admin':
                deleteUrl = 'delete_admin.php';
                break;
            case 'Student':
                deleteUrl = 'delete_student.php';
                break;
            case 'Lecturer':
                deleteUrl = 'delete_lecturer.php';
                break;
            case 'Guardian':
                deleteUrl = 'delete_guardian.php';
                break;
            default:
                alert('Invalid role selected');
                return; // Exit the function if the role is not recognized
        }

        if (confirm('Are you sure you want to delete this user?')) {
            // AJAX request using the Fetch API
            fetch(deleteUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `id=${rowId}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    this.closest('tr').remove();
                    alert('User deleted successfully');
                } else {
                    alert('Error deleting user');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error deleting user');
            });
        }
    };
    actionCell.appendChild(deleteButton);
}

function fetchAndPopulateData(role, table) {
    const idFieldsByRole = {
        'Admin': 'Admin_ID',
        'Student': 'Student_ID',
        'Lecturer': 'Lecturer_ID',
        'Guardian': 'Guardian_ID'
    };

    let fetchUrl = '';
    switch (role) {
        case 'Admin':
            fetchUrl = 'fetchAdminData.php';
            break;
        case 'Student':
            fetchUrl = 'fetchStudentData.php';
            break;
        case 'Lecturer':
            fetchUrl = 'fetchLecturerData.php';
            break;
        case 'Guardian':
            fetchUrl = 'fetchGuardianData.php';
            break;
        default:
            console.error('Role not recognized');
            return;
    }
    
    fetch(fetchUrl)
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(allData => {
        console.log("Fetched Data:", allData);
        const tbody = table.getElementsByTagName('tbody')[0];
        if (!tbody) {
            console.error('No tbody found in the table.');
            return;
        }
        allData.forEach(user => {
            const row = tbody.insertRow();
            row.className = 'table-row';
            
            const roleIdField = idFieldsByRole[role]; // Assuming 'role' is defined and accessible
            if (roleIdField && user[roleIdField]) {
                row.setAttribute('data-id', user[roleIdField]);
            } else {
                // Step 4: Fallback for Missing ID Fields
                console.error(`ID field for role ${role} not found or role is undefined.`);
            }

            const fields = {
                'Admin': ['Admin_ID', 'A_Username', 'A_Email', 'A_Password'],
                'Student': ['Student_ID', 'S_Username', 'S_Email', 'S_Password', 'S_Contact_Number','Guardian_ID'],
                'Lecturer': ['Lecturer_ID', 'L_Username', 'L_Email', 'L_Password', 'L_Contact_Number'],
                'Guardian': ['Guardian_ID', 'G_Username', 'G_Email', 'G_Password', 'G_Contact_Number']
            };
            (fields[role] || []).forEach(field => insertCell(row, user[field]));

            // Call insertButtons to add the buttons to the row
            insertButtons(row);
        });
    })
    .catch(error => console.error('Error:', error));
}

function addCustomTableRow(table) {
    const tableRow = document.createElement('tr');
    tableRow.className = 'table-line';
    const tableData = document.createElement('td');

    const numberOfColumns = table.rows[0].cells.length;
    tableData.setAttribute('colspan', numberOfColumns.toString());
    tableRow.appendChild(tableData);
    tableData.innerHTML = '</td>';
    table.querySelector('tbody').appendChild(tableRow); 
}

console.log('Script loaded');

document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded');
    // Function to hide all forms
    function hideAllForms() {
        document.getElementById('adminForm').style.display = 'none';
        document.getElementById('studentForm').style.display = 'none';
        document.getElementById('lecturerForm').style.display = 'none';
        document.getElementById('guardianForm').style.display = 'none';
    }

    selectBox.addEventListener('change', function() {
        const selectedRole = this.value;
        console.log('Selected role:', selectedRole);
        hideAllForms();
        setupTableForRole(selectedRole);
    });

    document.querySelector('.create-user-btn').addEventListener('click', function() {
        const selectedRole = document.getElementById('user-role').value;

        hideAllForms();

        if (selectedRole === 'Admin') {
            document.getElementById('adminForm').style.display = 'block';
        } else if (selectedRole === 'Student') {
            document.getElementById('studentForm').style.display = 'block';
        } else if (selectedRole === 'Lecturer') {
            document.getElementById('lecturerForm').style.display = 'block';
        } else if (selectedRole === 'Guardian') {
            document.getElementById('guardianForm').style.display = 'block';
        }

        openstudentModal();
    });

    function clearFormInputs() {
        document.querySelectorAll('.student-modal-content input').forEach(input => {
            input.value = '';
        });
    }

    document.querySelectorAll('.submitForm').forEach(button => {
        button.addEventListener('click', function() {
            let role = this.getAttribute('data-role');
            if (role === 'Admin') {

                let username = document.getElementById('adminUsername').value;
                let email = document.getElementById('adminEmail').value;
                let contact_number = document.getElementById('adminPassowrd').value;
                
                addRowToTable(username, email, contact_number);
                
            } else if (role === 'Student') {
                
                let username = document.getElementById('studentUsername').value;
                let email = document.getElementById('studentEmail').value;
                let password = document.getElementById('studentPassword').value;
                let contact_number = document.getElementById('studentContactNumber').value;
                let guardianid = document.getElementById('studentGuardianID').value;
                
                addRowToTable(username, email, password, contact_number, guardianid);
                
            } else if (role === 'Lecturer') {
                
                let name = document.getElementById('lecturerUsername').value;
                let email = document.getElementById('lecturerEmail').value;
                let password = document.getElementById('lecturerPassword').value;
                let contact_number = document.getElementById('lecturerContactNumber').value;
                
                addRowToTable(name, email, password, contact_number);
                
            } else if (role === 'Guardian') {

                let username = document.getElementById('huardianUsername').value;
                let email = document.getElementById('guardianEmail').value;
                let password = document.getElementById('guardianPassword').value;
                let contact_number = document.getElementById('guardianContactNumber').value;
                
                addRowToTable(username, email, password, contact_number);
        }
        clearFormInputs();
        closestudentModal();
        });
    });
});

function addRowToTable(name, email, thirdInfo, fourthInfo = '', fifthInfo = '') {
    // Select the table body where rows will be added
    let tbody = document.querySelector('.role-table tbody');

    let row = document.createElement('tr');

    let nameCell = document.createElement('td');
    nameCell.textContent = name;
    row.appendChild(nameCell);

    let emailCell = document.createElement('td');
    emailCell.textContent = email;
    row.appendChild(emailCell);

    // Third info cell (could be points or contact number)
    let thirdInfoCell = document.createElement('td');
    thirdInfoCell.textContent = thirdInfo;
    row.appendChild(thirdInfoCell);

    // Fourth info cell (conditionally added if there's fourthInfo)
    if (fourthInfo) {
        let fourthInfoCell = document.createElement('td');
        fourthInfoCell.textContent = fourthInfo;
        row.appendChild(fourthInfoCell);
    }

    // Fifth info cell (optional)
    if (fifthInfo) {
        let fifthInfoCell = document.createElement('td');
        fifthInfoCell.textContent = fifthInfo;
        row.appendChild(fifthInfoCell);
    }
    tbody.appendChild(row);
}

// Get the modal
const signup_modal = document.getElementById("signupModal");
const closeButton = document.querySelector(".close");

// Function to open the modal
function openstudentModal() {
    signup_modal.style.display = "block";
    document.body.style.overflow = "hidden"; // Optional: Prevent scrolling while modal is open
    document.body.style.backdropFilter = "blur(10px)"; // Blur the background
}

// Function to close the modal
function closestudentModal() {
    signup_modal.style.display = "none";
    document.body.style.overflow = "auto"; // Optional: Re-enable scrolling
    document.body.style.filter = "none"; // Remove blur from background
}

closeButton.onclick = function() {
    closestudentModal();
}