<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="styles.css">
<script src="script.js"></script>
<link rel="icon" href="" type="image/png">
<title>Submission</title>
</head>
<body>
<div class="container">

<br><br>

<?php 
include "navbar.html";
?>

<h1>Employee Submission Form</h1>
    <form action="submission.php" method="POST" enctype="multipart/form-data">
       <b> <label for="name">Employee Full Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="employee_id">Employee ID:</label>
        <input type="text" id="employee_id" name="employee_id" required><br><br>
        
        <label for="department">Department:</label>
        <select id="department" name="department" required>
            <option value="Human Resources">Human Resources</option>
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
    $name = $_POST["name"];
    $employee_id = $_POST["employee_id"];
    $department = $_POST["department"];
    $employment_status = $_POST["employment_status"];
    $email = $_POST["email"];
    
    // File upload handling
    $targetDir = "file_uploads/";
    $file_upload = $targetDir . basename($_FILES["file_upload"]["name"]);
    move_uploaded_file($_FILES["file_upload"]["tmp_name"], $file_upload);
    
    // Insert data into the database
    $query = "INSERT INTO employee (name, employee_id, department, employment_status, email, file_upload) 
              VALUES ('$name', '$employee_id', '$department', '$employment_status', '$email', '$file_upload')";
    
    
    // Error handling
    if (mysqli_query($conn, $query)) {
        echo "<b>Submission Successful!</b>";
    } else {
        echo "Submission Not Successful. Error: " . mysqli_error($conn);
    }

mysqli_close($conn); // close database connection
}
?>


<br><br>
</div>
</body>
</html>