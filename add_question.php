<?php
include "quiz.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $question = $_POST["question"];
    $option1 = $_POST["option1"];
    $option2 = $_POST["option2"];
    $option3 = $_POST["option3"];
    $option4 = $_POST["option4"];
    $correct_option = $_POST["correct_option"];

    $stmt = $conn->prepare("INSERT INTO questions (question, option1, option2, option3, option4, correct_option) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $question, $option1, $option2, $option3, $option4, $correct_option);
    
    if ($stmt->execute()) {
        echo "Question added successfully!";
    } else {
        echo "Error adding question.";
    }
    $stmt->close();
}
?>
