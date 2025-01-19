<?php
session_start();
include 'config.php';

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

// Get teachers from student's department
$dept_query = "SELECT * FROM teachers WHERE dept_id = " . $_SESSION['dept_id'];
$dept_teachers = mysqli_query($conn, $dept_query);

// Get teachers from other departments
$other_query = "SELECT * FROM teachers WHERE dept_id != " . $_SESSION['dept_id'];
$other_teachers = mysqli_query($conn, $other_query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        .teacher-list { display: flex; flex-wrap: wrap; gap: 20px; }
        .teacher-card { border: 1px solid #ddd; padding: 10px; width: 200px; }
        .teacher-card img { width: 100%; height: 200px; object-fit: cover; }
    </style>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['student_name']; ?></h2>
    
    <h3>Teachers in Your Department</h3>
    <div class="teacher-list">
        <?php while ($teacher = mysqli_fetch_assoc($dept_teachers)) { ?>
            <div class="teacher-card">
                <img src="<?php echo $teacher['profile_picture']; ?>" alt="Profile Picture">
                <h4><a href="teacher_profile.php?id=<?php echo $teacher['teacher_id']; ?>">
                    <?php echo $teacher['name']; ?>
                </a></h4>
            </div>
        <?php } ?>
    </div>
    
    <h3>Teachers in Other Departments</h3>
    <div class="teacher-list">
        <?php while ($teacher = mysqli_fetch_assoc($other_teachers)) { ?>
            <div class="teacher-card">
                <img src="<?php echo $teacher['profile_picture']; ?>" alt="Profile Picture">
                <h4><a href="teacher_profile.php?id=<?php echo $teacher['teacher_id']; ?>">
                    <?php echo $teacher['name']; ?>
                </a></h4>
            </div>
        <?php } ?>
    </div>
</body>
</html>