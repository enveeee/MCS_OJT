<?php
$conn = mysqli_connect("localhost", "root", "", "student_db");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM students";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Records</title>
</head>
<body>
    <h2>Saved Student Records</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Roll No</th>
            <th>Class</th>
            <th>C</th>
            <th>Java</th>
            <th>Python</th>
            <th>Total</th>
            <th>Percentage</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['roll_no']; ?></td>
            <td><?php echo $row['class']; ?></td>
            <td><?php echo $row['c_marks']; ?></td>
            <td><?php echo $row['java_marks']; ?></td>
            <td><?php echo $row['python_marks']; ?></td>
            <td><?php echo $row['total_marks']; ?></td>
            <td><?php echo number_format($row['percentage'], 2); ?>%</td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>

<?php mysqli_close($conn); ?>