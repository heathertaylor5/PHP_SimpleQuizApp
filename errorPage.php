<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Quiz Error Page</title>
        <link rel="stylesheet" href = "style.css">
    </head>
    <body>
        <?php
            session_start();
            $userAnswers = $_SESSION['userAnswers'];
            $_SESSION['currentQuestionNumber'] = 0;
            $output = "<h1>The following questions have been missed:</h1><br>";
            for($i =0; $i<count($userAnswers); $i++){
                if($userAnswers[$i] == -1){
                    $output .= "Question " . ($i + 1) . "<br>";
                }
            }
            $output .= '<form action="showQuestion.php" method="POST">';
            $output .= '<button type="submit">Go Back</button>';
            $output .= '</form>';
            echo $output;
        ?>
    </body>
</html>