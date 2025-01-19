<?php
session_start();
include '../config.php';

$teacher_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $subject = $_POST['subject'];
    $address = $_POST['address'];
    $dept_id = $_POST['dept_id'];
    
    $query = "UPDATE teachers SET 
              name = '$name',
              age = $age,
              subject = '$subject',
              contact_address = '$address',
              dept_id = $dept_id";
    
    // Handle new profile picture if uploaded
    if ($_FILES['profile_picture']['size'] > 0) {
        $target_dir = "uploads/";
        $profile_picture = $target_dir . basename($_FILES["profile_picture"]["name"]);
        move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $profile_picture);
        $query .= ", profile_picture = '$profile_picture'";
    }
    
    $query .= " WHERE teacher_id = $teacher_id";
    mysqli_query($conn, $query);
    header("Location: manage_teachers.php");
}

$query = "SELECT * FROM teachers WHERE teacher_id = $teacher_id";
$result = mysqli_query($conn, $query);
$teacher = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Teacher</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        .form-group { margin-bottom: 15px; }
    </style>
</head>
<body>
    <h2>Edit Teacher</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Name:</label><br>
            <input type="text" name="name" value="<?php echo $teacher['name']; ?>" required>
        </div>
        <div class="form-group">
            <label>Age:</label><br>
            <input type="number" name="age" value="<?php echo $teacher['age']; ?>" required>
        </div>
        <div class="form-group">
            <label>Subject:</label><br>
            <input type="text" name="subject" value="<?php echo $teacher['subject']; ?>" required>
        </div>
        <div class="form-group">
            <label>Contact Address:</label><br>
            <textarea name="address" required><?php echo $teacher['contact_address']; ?></textarea>
        </div>
        <div class="form-group">
            <label>Department:</label><br>
            <select name="dept_id" required>
                <?php
                $dept_query = "SELECT * FROM departments";
                $departments = mysqli_query($conn, $dept_query);
                while ($dept = mysqli_fetch_assoc($departments)) {
                    $selected = ($dept['dept_id'] == $teacher['dept_id']) ? 'selected' : '';
                    echo "<option value='" . $dept['dept_id'] . "' $selected>" . 
                         $dept['dept_name'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Current Profile Picture:</label><br>
            <img src="<?php echo $teacher['profile_picture']; ?>" width="100"><br>
            <label>Upload New Picture (optional):</label><br>
            <input type="file" name="profile_picture">
        </div>
        <button type="submit">Update Teacher</button>
    </form>
</body>
</html>