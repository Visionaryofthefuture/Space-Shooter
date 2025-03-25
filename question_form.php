<link href = "style.css" rel = "stylesheet">

<h2>Add a New Question</h2>

<form id="addQuestionForm">
    <input type="text" id="questionText" placeholder="Enter question" required><br>
    <input type="text" id="option1" placeholder="Option 1" required><br>
    <input type="text" id="option2" placeholder="Option 2" required><br>
    <input type="text" id="option3" placeholder="Option 3" required><br>
    <input type="text" id="option4" placeholder="Option 4" required><br>
    <input type="number" id="correctOption" placeholder="Correct option (1-4)" required><br>
    <button type="submit">Add Question</button>
</form>

<script>
    document.getElementById("addQuestionForm").addEventListener("submit", function(event) {

        let formData = new FormData();
        formData.append("question", document.getElementById("questionText").value);
        formData.append("option1", document.getElementById("option1").value);
        formData.append("option2", document.getElementById("option2").value);
        formData.append("option3", document.getElementById("option3").value);
        formData.append("option4", document.getElementById("option4").value);
        formData.append("correct_option", document.getElementById("correctOption").value);

        fetch("add_question.php", {
            method: "POST",
            body: formData
        }).then(response => response.text())
        .then(data => {
            alert(data);
        });
    });
</script>
