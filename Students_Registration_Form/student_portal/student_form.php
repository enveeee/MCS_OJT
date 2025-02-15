<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Information</title>
</head>
<body>
    <h2>Student Information Form</h2>
    <form method="POST" action="calculate.php">
        Name: <input type="text" name="name" required><br>
        Roll No: <input type="text" name="roll_no" required><br>
        Class: <input type="text" name="class" required><br>
        Subjects:<br>
        C: <input type="number" name="c_marks" min="0" max="50" required><br>
        Java: <input type="number" name="java_marks" min="0" max="50" required><br>
        Python: <input type="number" name="python_marks" min="0" max="50" required><br>
        <button type="submit">Save</button>
        <a href="view_students.php"><button type="button">Next</button></a>
    </form>
</body>
</html>