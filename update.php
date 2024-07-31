<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="styles.css">
<script src="script.js"></script>
<link rel="icon" href="emp-logo.png" type="image/png">
<title>Update</title>
</head>
<body>
<div class="container">

<?php 
include "navbar.html";
?>
<br>
<a href="delete.php" style="
    text-decoration: none;
    color: white;
    background-color: black;
    padding: 10px 15px;
    border-radius: 5px;
    font-weight: bold;
    display: inline-block;
    transition: background-color 0.3s ease;
">Employee Delete Page</a>

<br><br>

<h1><u>Employee Update Form</u></h1>
    <form action="update.php" method="POST" enctype="multipart/form-data">
    <b>
    <h3>Current Information:</h3>    
    <label for="employee_id">Employee ID:</label>
        <input type="text" id="employee_id" name="employee_id" required><br><br><br><br><br><br>

        <h3>Updated Information:</h3> 

        <label for="name">Employee Full Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="employee_id_2">Employee ID:</label>
        <input type="text" id="employee_id_2" name="employee_id_2" required><br><br>
        
        <label for="department">Department:</label>
        <select id="department" name="department" required>
            <option value="Human Resources">Human Resources</option>
            <option value="Management">Management</option>
            <option value="Administration">Administration</option>
            <option value="Accounting">Accounting</option>
            <option value="Information Technology">Information Technology</option>
            <option value="Customer Service">Customer Service</option>
            <option value="Sales">Sales</option>
        </select><br><br>

        <label for="employment_status">Employment Status:</label>
        <select id="employment_status" name="employment_status" required>
            <option value="Full-time">Full-time</option>
            <option value="Part-time">Part-time</option>
            <option value="Contract">Contract</option>
            <option value="Leave">Leave</option>
            <option value="Former Employee">Former Employee</option>
        </select><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="file_upload">Upload File:</label>
        <input type="file" id="file_upload" name="file_upload" accept=".pdf,.doc,.docx" title="Accepted file types: PDF, DOC, DOCX"><br><br></b>

        <input type="submit" value="Submit">
    </form>
    

<?php
include "DBConnection.php"; // Database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_id = $_POST["employee_id"];
    $name = $_POST["name"];
    $employee_id_2 = $_POST["employee_id_2"];
    $department = $_POST["department"];
    $employment_status = $_POST["employment_status"];
    $email = $_POST["email"];
    
    // File upload handling
    $targetDir = "file_uploads/";
    $file_upload = $targetDir . basename($_FILES["file_upload"]["name"]);
    move_uploaded_file($_FILES["file_upload"]["tmp_name"], $file_upload);
    
    // Prepare and bind
    $stmt = $conn->prepare("UPDATE employee SET name = ?, employee_id = ?, department = ?, employment_status = ?, email = ?, file_upload = ? WHERE employee_id = ?");
    $stmt->bind_param("sssssss", $name, $employee_id_2, $department, $employment_status, $email, $file_upload, $employee_id);
    
    // Execute the statement
    if ($stmt->execute()) {
        echo "<b>Update Successful!</b>";
    } else {
        echo "Update Not Successful. Error: " . $stmt->error;
    }

mysqli_close($conn); // close database connection
}
?>


<br><br>
</div>
</body>
</html>