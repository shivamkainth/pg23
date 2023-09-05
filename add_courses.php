<?php

// User ID 
$userId = 123;

// Array of course IDs to add
$courseIds = [456, 789, 123]; 
$courseName = $_POST['courses'][$courseId]['name'];

$credits = $_POST['courses'][$courseId]['credits'];


// Connect to database
$db = new mysqli('localhost', 'root', 'asdf', 'auth');

// Check connection
if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
} 

// Loop through course IDs
foreach ($courseIds as $courseId) {

  // Insert new enrollment
  $stmt = $db->prepare("INSERT INTO enrollments (user_id, course_id, course_name, credits)  
                      VALUES (?, ?, ?, ?)");

$stmt->bind_param('issi', $userId, $courseId, $courseName, $credits);

  
  // Execute statement
  if(!$stmt->execute()) {
    echo "Error inserting course: " . $courseId;
  }
}

// Close database connection
$db->close();

?>