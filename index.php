<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <title>Quiz Index Page</title>
    <link rel="stylesheet" href = "style.css">
    </head>
    <body>
        <h1>Quiz App</h1>
        <form action="buildQuiz.php" method = "GET">
            <p>Select a quiz and press Start to begin:</p>
            <select name="quizzes" id="quizzes">
                <option value="geography">World Geography</option>
                <option value="math">Number Systems</option>
            </select>
            <button type="submit">Start</button>
        </form>
    </body>
</html>