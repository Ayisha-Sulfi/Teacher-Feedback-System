<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $teacher_id = $_POST['teacher_id'];
    $student_id = $_SESSION['student_id'];
    $rating = $_POST['rating'];
    $feedback = $_POST['feedback'];
    
    // Insert review
    $query = "INSERT INTO reviews (student_id, teacher_id, star_rating, feedback)
              VALUES ($student_id, $teacher_id, $rating, '$feedback')";
    mysqli_query($conn, $query);
    $review_id = mysqli_insert_id($conn);
    
    // Process question responses
    $questions_query = "SELECT question_id FROM review_questions";
    $questions = mysqli_query($conn, $questions_query);
    
    while ($question = mysqli_fetch_assoc($questions)) {
        $question_id = $question['question_id'];
        $response = $_POST['q_' . $question_id];
        
        $query = "INSERT INTO question_responses (review_id, question_id, response)
                  VALUES ($review_id, $question_id, $response)";
        mysqli_query($conn, $query);
    }
    
    header("Location: teacher_profile.php?id=" . $teacher_id);
}
?>