<?php
session_start();
include '../config.php';

// Add new question
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_question'])) {
    $question_text = $_POST['question_text'];
    $query = "INSERT INTO review_questions (question_text) VALUES ('$question_text')";
    mysqli_query($conn, $query);
}

// Delete question
if (isset($_GET['delete'])) {
    $question_id = $_GET['delete'];
    $query = "DELETE FROM review_questions WHERE question_id = $question_id";
    mysqli_query($conn, $query);
}

// Get all questions
$query = "SELECT * FROM review_questions";
$questions = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Review Questions</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        .question-list { margin-top: 20px; }
        .question-item { border: 1px solid #ddd; padding: 10px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <h2>Add New Question</h2>
    <form action="" method="POST">
        <div>
            <label>Question Text:</label><br>
            <textarea name="question_text" required></textarea>
        </div>
        <button type="submit" name="add_question">Add Question</button>
    </form>
    
    <h2>Current Questions</h2>
    <div class="question-list">
        <?php while ($question = mysqli_fetch_assoc($questions)) { ?>
            <div class="question-item">
                <p><?php echo $question['question_text']; ?></p>
                <a href="?delete=<?php echo $question['question_id']; ?>"
                   onclick="return confirm('Are you sure?')">Delete</a>
            </div>
        <?php } ?>
    </div>
</body>
</html>