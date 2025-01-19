<?php
session_start();
include '../config.php';

// Get all reviews with teacher and student information
$query = "SELECT r.*, t.name as teacher_name, s.name as student_name,
          AVG(r.star_rating) as avg_rating
          FROM reviews r
          JOIN teachers t ON r.teacher_id = t.teacher_id
          JOIN students s ON r.student_id = s.student_id
          GROUP BY t.teacher_id
          ORDER BY avg_rating DESC";
$reviews = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Reviews</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        .review-summary { margin-bottom: 30px; }
        .review-list { margin-top: 20px; }
        .review-item { border: 1px solid #ddd; padding: 10px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <h2>Review Summary</h2>
    <div class="review-summary">
        <h3>Top Rated Teachers</h3>
        <?php
        $top_query = "SELECT t.name, AVG(r.star_rating) as avg_rating
                      FROM reviews r
                      JOIN teachers t ON r.teacher_id = t.teacher_id
                      GROUP BY t.teacher_id
                      ORDER BY avg_rating DESC
                      LIMIT 5";
        $top_teachers = mysqli_query($conn, $top_query);
        while ($teacher = mysqli_fetch_assoc($top_teachers)) {
            echo "<p>" . $teacher['name'] . " - Average Rating: " . 
                 number_format($teacher['avg_rating'], 2) . "</p>";
        }
        ?>
        
        <h3>Recent Reviews</h3>
        <div class="review-list">
            <?php while ($review = mysqli_fetch_assoc($reviews)) { ?>
                <div class="review-item">
                    <h4>Teacher: <?php echo $review['teacher_name']; ?></h4>
                    <p>Student: <?php echo $review['student_name']; ?></p>
                    <p>Rating: <?php echo $review['star_rating']; ?> stars</p>
                    <p>Feedback: <?php echo $review['feedback']; ?></p>
                    <p>Date: <?php echo $review['created_at']; ?></p>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>