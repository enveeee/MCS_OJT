<?php
session_start();
$conn = new mysqli("localhost", "root", "", "student_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save'])) {
    $name = $_POST['name'];
    $roll_no = $_POST['roll_no'];
    $class = $_POST['class'];
    $c_marks = $_POST['c_marks'];
    $java_marks = $_POST['java_marks'];
    $python_marks = $_POST['python_marks'];
    
    $total_marks = $c_marks + $java_marks + $python_marks;
    $percentage = ($total_marks / 150) * 100;
    
    $stmt = $conn->prepare("INSERT INTO students (name, roll_no, class, c_marks, java_marks, python_marks, total_marks, percentage) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssiiidi", $name, $roll_no, $class, $c_marks, $java_marks, $python_marks, $total_marks, $percentage);
    $stmt->execute();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Information</title>
</head>
<body>
    <h2>Student Information Form</h2>
    <form method="POST">
        Name: <input type="text" name="name" required><br>
        Roll No: <input type="text" name="roll_no" required><br>
        Class: <input type="text" name="class" required><br>
        Subjects:<br>
        C: <input type="number" name="c_marks" min="0" max="50" required><br>
        Java: <input type="number" name="java_marks" min="0" max="50" required><br>
        Python: <input type="number" name="python_marks" min="0" max="50" required><br>
        <button type="submit" name="save">Save</button>
        <a href="view_students.php"><button type="button">Next</button></a>
    </form>
</body>
</html>