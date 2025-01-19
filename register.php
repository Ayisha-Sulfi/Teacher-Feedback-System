<!DOCTYPE html>
<html>
<head>
    <title>Student Registration</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        .form-group { margin-bottom: 15px; }
        input, select { padding: 5px; width: 200px; }
        button { padding: 10px; background: #007bff; color: white; border: none; }
    </style>
</head>
<body>
    <h2>Student Registration</h2>
    <form action="process_registration.php" method="POST">
        <div class="form-group">
            <label>Name:</label><br>
            <input type="text" name="name" required>
        </div>
        <div class="form-group">
            <label>Department:</label><br>
            <select name="department" required>
                <?php
                $query = "SELECT * FROM departments";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['dept_id'] . "'>" . $row['dept_name'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Admission No:</label><br>
            <input type="text" name="admission_no" required>
        </div>
        <div class="form-group">
            <label>Password:</label><br>
            <input type="password" name="password" required>
        </div>
        <button type="submit">Register</button>
    </form>
</body>
</html>
