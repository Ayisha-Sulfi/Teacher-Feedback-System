<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $admission_no = $_POST['admission_no'];
    $password = $_POST['password'];
    
    $query = "SELECT * FROM students WHERE admission_no = '$admission_no' AND password = '$password'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) == 1) {
        $student = mysqli_fetch_assoc($result);
        $_SESSION['student_id'] = $student['student_id'];
        $_SESSION['student_name'] = $student['name'];
        $_SESSION['dept_id'] = $student['dept_id'];
        header("Location: dashboard.php");
    } else {
        header("Location: login.php?error=1");
    }
}
?>