<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Quiz Results Page</title>
        <link rel="stylesheet" href = "style.css">
    </head>
    <body>
        <?php
            //Start Session and retrieve data
            session_start();
            $userAnswers = $_SESSION['userAnswers'];
            $quizInfo = $_SESSION['quizInfo'];
            $questions = $quizInfo['questions'];
            $title = $quizInfo['title'];

            //Display quiz title
            $output = '<h1>Results</h1>';
            $output .= '<p>(Correct answers shown in green)</p>';
            $output .= '<h2>' . $title . '</h2>';

            //Display the questions
            $output .= '<div id = "results">';
            $scoreCounter = 0;
            for($i = 0; $i<count($questions); $i++){
                //Figure out the correct answer and the user answer
                $output .= '<h3>Question ' . ($i + 1) . "</h3>";
                $currentQuestion = $questions[$i];
                $correctAnswer = $currentQuestion['answer'];
                $userAnswer = $userAnswers[$i];
                //increment the score if the correct answer
                if($userAnswer == $correctAnswer){
                    $scoreCounter++;
                }
                $output .= $currentQuestion['questionText'] . '<br>';
                //loop through the choices to display them
                $output .= '<ul>';
                for($j=0; $j<count($currentQuestion['choices']); $j++){
                    $id = $currentQuestion['choices'][$j];
                    $output .= '<li ';
                    if($j == $correctAnswer){
                        $output .= 'class="correct" ';
                    }else if($j == $userAnswer){
                        $output .= 'class="incorrect" ';
                    }

                    if($j == $userAnswer){
                        $output .= 'id="userChoice"';
                    }

                    $output .= '>' . $id . '</li>';
                }
                $output .= '</ul>';
                $output .= '</div>';
            }
            $output .= '<div id="score">';
            $output .= '<h1>Score: ' . $scoreCounter . '/' . count($questions) . '</h1>';
            $output .= '</div>';

            echo $output;
        ?>
    </body>
</html>