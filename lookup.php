<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="styles.css">
<script src="script.js"></script>
<link rel="icon" href="emp-logo.png" type="image/png">
<title>Lookup</title>
</head>
<body>
<div class="container">

<?php 
include "navbar.html";
?>

<br><br>

<h1><u>Employee Lookup</u></h1>
    
<form action="" method="GET">
    
    <b><label for="name">Employee Name:</label>
        <input type="text" id="name" name="name"><br><br>  
        
        <label for="employee_id">Employee ID:</label>
        <input type="text" id="employee_id" name="employee_id"><br><br>
        
        <label for="department">Department:</label>
        <select id="department" name="department">
            <option value="">All</option>
            <option value="Human Resources">Human Resources</option>
            <option value="Management">Management</option>
            <option value="Administration">Administration</option>
            <option value="Accounting">Accounting</option>
            <option value="Information Technology">Information Technology</option>
            <option value="Customer Service">Customer Service</option>
            <option value="Sales">Sales</option>
        </select><br><br>
        
        <label for="employment_status">Employment Status:</label>
        <select id="employment_status" name="employment_status">
            <option value="">All</option>
            <option value="Full-time">Full-time</option>
            <option value="Part-time">Part-time</option>
            <option value="Contract">Contract</option>
            <option value="Leave">Leave</option>
            <option value="Former Employee">Former Employee</option>
        </select><br><br>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email"><br><br>
        
        <input type="submit" name="submit" value="Search"></b><br><br>
        </form>

<?php
    include "DBConnection.php"; // Include the database connection code

    $employee_id = isset($_GET["employee_id"]) ? $_GET["employee_id"] : "";
    $department = isset($_GET["department"]) ? $_GET["department"] : "";
    $employment_status = isset($_GET["employment_status"]) ? $_GET["employment_status"] : "";
    $name = isset($_GET["name"]) ? $_GET["name"] : "";
    $email = isset($_GET["email"]) ? $_GET["email"] : "";

    if (isset($_GET["submit"])) {
        $query = "SELECT * FROM employee WHERE 
                  (employee_id LIKE '%$employee_id%') AND
                  (department = '$department' OR '$department' = '') AND
                  (employment_status = '$employment_status' OR '$employment_status' = '') AND
                  (name LIKE '%$name%') AND
                  (email LIKE '%$email%')";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            echo "<table>
                    <tr>
                        <th>Employee Name</th>
                        <th>Employee ID</th>
                        <th>Department</th>
                        <th>Employment Status</th>
                        <th>Email</th>
                        <th>Employee Documentation File</th>
                    </tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['name']}</td>
                        <td>{$row['employee_id']}</td>
                        <td>{$row['department']}</td>
                        <td>{$row['employment_status']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['file_upload']}</td>
                      </tr>";
            }

            echo "</table>";
        } else {
            echo "No results found.";
        }
    }
    ?>

<br><br>
</div>
</body>
</html>