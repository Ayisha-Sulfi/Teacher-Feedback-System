<?php
session_start();
include '../config.php';

// Add Teacher
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $subject = $_POST['subject'];
    $address = $_POST['address'];
    $dept_id = $_POST['dept_id'];
    
    // Handle file upload for profile picture
    $target_dir = "uploads/";
    $profile_picture = $target_dir . basename($_FILES["profile_picture"]["name"]);
    move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $profile_picture);
    
    $query = "INSERT INTO teachers (name, age, subject, contact_address, profile_picture, dept_id) 
              VALUES ('$name', $age, '$subject', '$address', '$profile_picture', $dept_id)";
    mysqli_query($conn, $query);
}

// Get all teachers
$query = "SELECT * FROM teachers";
$teachers = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Teachers</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        .teacher-list { margin-top: 20px; }
        .teacher-item { border: 1px solid #ddd; padding: 10px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <h2>Add New Teacher</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <div>
            <label>Name:</label><br>
            <input type="text" name="name" required>
        </div>
        <div>
            <label>Age:</label><br>
            <input type="number" name="age" required>
        </div>
        <div>
            <label>Subject:</label><br>
            <input type="text" name="subject" required>
        </div>
        <div>
            <label>Contact Address:</label><br>
            <textarea name="address" required></textarea>
        </div>
        <div>
            <label>Department:</label><br>
            <select name="dept_id" required>
                <?php
                $dept_query = "SELECT * FROM departments";
                $departments = mysqli_query($conn, $dept_query);
                while ($dept = mysqli_fetch_assoc($departments)) {
                    echo "<option value='" . $dept['dept_id'] . "'>" . $dept['dept_name'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div>
            <label>Profile Picture:</label><br>
            <input type="file" name="profile_picture" required>
        </div>
        <button type="submit">Add Teacher</button>
    </form>
    
    <h2>Teacher List</h2>
    <div class="teacher-list">
        <?php while ($teacher = mysqli_fetch_assoc($teachers)) { ?>
            <div class="teacher-item">
                <img src="<?php echo $teacher['profile_picture']; ?>" width="100">
                <h3><?php echo $teacher['name']; ?></h3>
                <p>Age: <?php echo $teacher['age']; ?></p>
                <p>Subject: <?php echo $teacher['subject']; ?></p>
                <p>Contact: <?php echo $teacher['contact_address']; ?></p>
                <a href="edit_teacher.php?id=<?php echo $teacher['teacher_id']; ?>">Edit</a>
                <a href="delete_teacher.php?id=<?php echo $teacher['teacher_id']; ?>" 
                   onclick="return confirm('Are you sure?')">Delete</a>
            </div>
        <?php } ?>
    </div>
</body>
</html>