<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="styles.css">
<script src="script.js"></script>
<link rel="icon" href="emp-logo.png" type="image/png">
<title>Delete</title>
<script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this employee record? This action cannot be undone.");
        }
    </script>
</head>
<body>
<div class="container">

<?php 
include "navbar.html";
?>

<br><br>

<h1><u>Employee Delete Form</u></h1>
    <form action="delete.php" method="POST" onsubmit="return confirmDelete();">
        <h3>Employee Information:</h3>    
        <label for="employee_id">Employee ID:</label>
        <input type="text" id="employee_id" name="employee_id" required><br><br>
        
        <label for="name">Employee Full Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        
        <input type="submit" value="Delete">
    </form>

<?php
include "DBConnection.php"; // Database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_id = $_POST["employee_id"];
    $name = $_POST["name"];
    
    // Prepare and bind
    $stmt = $conn->prepare("DELETE FROM employee WHERE employee_id = ? AND name = ?");
    $stmt->bind_param("ss", $employee_id, $name);
    
    // Execute the statement
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "<b>Record Deleted Successfully!</b>";
        } else {
            echo "No matching records found.";
        }
    } else {
        echo "Delete Not Successful. Error: " . $stmt->error;
    }

    $stmt->close(); // Close statement
    $conn->close(); // Close database connection
}
?>


<br><br>
</div>
</body>
</html>