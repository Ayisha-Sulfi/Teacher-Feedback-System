<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        .menu { margin-bottom: 20px; }
        .menu a { margin-right: 20px; }
    </style>
</head>
<body>
    <div class="menu">
        <a href="manage_teachers.php">Manage Teachers</a>
        <a href="manage_reviews.php">Manage Reviews</a>
        <a href="manage_questions.php">Manage Questions</a>
    </div>
</body>
</html>
