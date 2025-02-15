<?php
$conn = mysqli_connect("localhost", "root", "", "student_db");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $roll_no = $_POST['roll_no'];
    $class = $_POST['class'];
    $c_marks = $_POST['c_marks'];
    $java_marks = $_POST['java_marks'];
    $python_marks = $_POST['python_marks'];

    $total_marks = $c_marks + $java_marks + $python_marks;
    $percentage = ($total_marks / 150) * 100;

    $sql = "INSERT INTO students (name, roll_no, class, c_marks, java_marks, python_marks, total_marks, percentage) 
            VALUES ('$name', '$roll_no', '$class', '$c_marks', '$java_marks', '$python_marks', '$total_marks', '$percentage')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Student record saved successfully!'); window.location.href='view_students.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>