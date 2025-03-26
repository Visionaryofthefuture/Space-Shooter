<?php

$conn = new mysqli("localhost", "soumyajit-das", "Password hidden", "WST");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// fetch_questions.php (Fetch questions)
$sql = "SELECT * FROM questions";
$result = $conn->query($sql);

$questions = [];
while ($row = $result->fetch_assoc()) {
    $questions[] = $row;
}
echo json_encode($questions);
?>
