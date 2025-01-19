<!DOCTYPE html>
<html>
<head>
    <title>Student Login</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        .form-group { margin-bottom: 15px; }
        input { padding: 5px; width: 200px; }
        button { padding: 10px; background: #007bff; color: white; border: none; }
    </style>
</head>
<body>
    <h2>Student Login</h2>
    <form action="process_login.php" method="POST">
        <div class="form-group">
            <label>Admission No:</label><br>
            <input type="text" name="admission_no" required>
        </div>
        <div class="form-group">
            <label>Password:</label><br>
            <input type="password" name="password" required>
        </div>
        <button type="submit">Login</button>
    </form>
</body>
</html>
