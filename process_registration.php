<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $dept_id = $_POST['department'];
    $admission_no = $_POST['admission_no'];
    $password = $_POST['password'];
    
    $query = "INSERT INTO students (name, dept_id, admission_no, password) 
              VALUES ('$name', '$dept_id', '$admission_no', '$password')";
    
    if (mysqli_query($conn, $query)) {
        header("Location: login.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>