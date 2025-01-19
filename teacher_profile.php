<?php
session_start();
include 'config.php';

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

$teacher_id = $_GET['id'];
$query = "SELECT * FROM teachers WHERE teacher_id = $teacher_id";
$result = mysqli_query($conn, $query);
$teacher = mysqli_fetch_assoc($result);

// Get review questions
$questions_query = "SELECT * FROM review_questions";
$questions = mysqli_query($conn, $questions_query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Teacher Profile</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        .profile-img { width: 200px; height: 200px; object-fit: cover; }
        .review-form { margin-top: 20px; }
        .star-rating { margin: 10px 0; }
    </style>
</head>
<body>
    <img src="<?php echo $teacher['profile_picture']; ?>" class="profile-img">
    <h2><?php echo $teacher['name']; ?></h2>
    <p>Age: <?php echo $teacher['age']; ?></p>
    <p>Subject: <?php echo $teacher['subject']; ?></p>
    <p>Contact: <?php echo $teacher['contact_address']; ?></p>
    
    <h3>Submit Review</h3>
    <form action="process_review.php" method="POST">
        <input type="hidden" name="teacher_id" value="<?php echo $teacher_id; ?>">
        
        <?php while ($question = mysqli_fetch_assoc($questions)) { ?>
            <div>
                <p><?php echo $question['question_text']; ?></p>
                <input type="radio" name="q_<?php echo $question['question_id']; ?>" value="1"> Yes
                <input type="radio" name="q_<?php echo $question['question_id']; ?>" value="0"> No
            </div>
        <?php } ?>
        
        <div class="star-rating">
            <label>Rating:</label>
            <select name="rating" required>
                <option value="1">1 Star</option>
                <option value="2">2 Stars</option>
                <option value="3">3 Stars</option>
                <option value="4">4 Stars</option>
                <option value="5">5 Stars</option>
            </select>
        </div>
        
        <div>
            <label>Feedback:</label><br>
            <textarea name="feedback" rows="4" cols="50"></textarea>
        </div>
        
        <button type="submit">Submit Review</button>
    </form>
</body>
</html>