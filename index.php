<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href = "style.css" rel = "stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Quiz</title>
    <script>
        let questions = [];
        let currentQuestionIndex = 0;
        let correctAnswers = 0;

        function fetchQuestions() {
            fetch('quiz.php')
                .then(response => response.json())
                .then(data => {
                    questions = data;
                    displayQuestion();
                });
        }

        function displayQuestion() {
            if (currentQuestionIndex < questions.length) {
                let q = questions[currentQuestionIndex];
                document.getElementById("question").innerText = q.question;
                document.getElementById("options").innerHTML = `
                    <button onclick="checkAnswer(1)">${q.option1}</button>
                    <button onclick="checkAnswer(2)">${q.option2}</button>
                    <button onclick="checkAnswer(3)">${q.option3}</button>
                    <button onclick="checkAnswer(4)">${q.option4}</button>
                `;
            } else {
                document.getElementById("quiz").innerHTML = `<h2>You got ${correctAnswers} correct answers!</h2>`;
                
            }
        }

        function checkAnswer(selectedOption) {
            if (selectedOption == questions[currentQuestionIndex].correct_option) {
                correctAnswers++;
            }
            currentQuestionIndex++;
            displayQuestion();
        }

        window.onload = fetchQuestions;
    </script>
</head>
<body>
    <div id="quiz">
        <h2 id="question"></h2>
        <div id="options"></div>
    </div>

    <a link href = "/question_form.php"> Want to add a question? Click here </a>
</body>
</html>
