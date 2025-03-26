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
                createNavigation();
            });
    }

    function createNavigation() {
        let navContainer = document.getElementById("questionNav");
        navContainer.innerHTML = ""; // Clear previous data

        for (let i = 0; i < questions.length; i++) {
            let btn = document.createElement("button");
            btn.innerText = i + 1;
            btn.classList.add("question-btn");
            // Add 'active' class to the first button initially
            if (i === 0) {
                btn.classList.add("active");
            }
            btn.dataset.index = i;
            btn.onclick = function () {
                currentQuestionIndex = i;
                displayQuestion();
                updateNavigation();
            };
            navContainer.appendChild(btn);
        }
    }

    function updateNavigation() {
        let buttons = document.querySelectorAll(".question-btn");
        buttons.forEach((btn, index) => {
            if (index === currentQuestionIndex) {
                btn.classList.add("active"); // Current question - blue
            } else {
                btn.classList.remove("active"); // Other questions - green
            }
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
            updateNavigation();
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

    window.onload = function() {
        fetchQuestions();
        
        let prev = document.getElementById("prev");
        let next = document.getElementById("next");

        prev.addEventListener("click", function() {
            if (currentQuestionIndex > 0) {
                currentQuestionIndex--;
                displayQuestion();
            }
        });

        next.addEventListener("click", function() {
            if (currentQuestionIndex < questions.length - 1) {
                currentQuestionIndex++;
                displayQuestion();
            }
        });
    };
    </script>
</head>
<body>
<div id="questionNav" style="text-align: center; margin-bottom: 20px;"></div>

    <div id="quiz">
        <h2 id="question"></h2>
        <div id="options"></div>

        <div id = "button-container">
        <button id="prev">Previous</button>
        <button id="next">Next</button>
        <a link href="/question_form.php"> Want to add a question? Click here </a>
</div>
    </div>

</body>
</html>