<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Quiz Build Page</title>
        <link rel="stylesheet" href = "style.css">
    </head>
    <body>
        <?php
        //Start Session and retrieve data
        session_start();
        $quizInfo = $_SESSION['quizInfo'];
        $questions = $quizInfo['questions'];
        $title = $quizInfo['title'];
        $currentQuestion = $_SESSION['currentQuestionNumber'];
        $userAnswers = $_SESSION['userAnswers'];

        //Display quiz title
        $output = '<h1>' . $title . '</h1>';

        //PREVIOUS BUTTON
        //check if previous or next were clicked
        if(isset($_POST['btnPrevious'])){
            //check if they answered the question
            if(isset($_POST['Q' . $currentQuestion])){
                //if yes, add the value to the user answer array and send back to the session
                $userAnswers[$currentQuestion] = $_POST['Q' . $currentQuestion];
            }
            $_SESSION['userAnswers'] = $userAnswers;
            //decrement and send new value to session
            $currentQuestion--;
            $_SESSION['currentQuestionNumber'] = $currentQuestion;

        //NEXT BUTTON
        }else if(isset($_POST['btnNext'])){
            //Check if they answered the question
            if(isset($_POST['Q' . $currentQuestion])){
                //if yes, add the value to the user answer array and send back to the session
                $userAnswers[$currentQuestion] = $_POST['Q' . $currentQuestion];  
            }
            $_SESSION['userAnswers'] = $userAnswers;
            //increment and send new value to session
            $currentQuestion++;
            $_SESSION['currentQuestionNumber'] = $currentQuestion;
        
        //SUBMIT BUTTON    
            //If submit is clicked, check that all questions have been answered
        }else if(isset($_POST['btnSubmitQuiz'])){
            if(isset($_POST['Q' . $currentQuestion])){
                $userAnswers[$currentQuestion] = $_POST['Q' . $currentQuestion];  
            }
            $_SESSION['userAnswers'] = $userAnswers;
            if(in_array(-1, $userAnswers)){
                header("location: errorPage.php");
            }else{
                header("location: results.php");
            }
        }

        $output .= '<div id="questionCard">';
        //Display question number
        $output .= '<h2>Question ' . ($currentQuestion + 1) . '</h2>';

        //build form
        $output .= '<form action="" method="POST">';
        
        //display question text
        $output .= '<p>' . $questions[$currentQuestion]['questionText'] . '</p>';
        
        //loop through choices to display
        $choices = $questions[$currentQuestion]['choices'];
        for($i = 0; $i<count($choices); $i++){
            $id = $choices[$i];
            $output .= '<input type="radio" name= "Q' . $currentQuestion . '" value = "' . $i . '" id="' . $id . '" ';
            //check if this question has been answered
            if($userAnswers[$currentQuestion] != -1){
                if($i == $userAnswers[$currentQuestion]){
                    $output .= 'checked';
                }
            }
            $output .= '/>';
            $output .= '<label for="' . $id . '">' . $id . '</label>';
            $output .= '<br>';
        }
        //if we are on the first question, disable the previous button
        $output .= '<button type="submit" name="btnPrevious"';
        if($currentQuestion == 0){
            $output .= ' disabled';
        }
        $output .=  '>Previous</button>';
        //if we are on the final question, disable the next button
        $output .= '<button type="submit" name="btnNext"';
        if($currentQuestion == count($questions) - 1){
            $output .= ' disabled';
        }
        $output .= '>Next</button>';
        //submit quiz button
        $output .= '<button type="submit" name="btnSubmitQuiz">Submit Quiz</button>';
        $output .= '</form>';
        $output .= '</div>';
        //display all info
        echo $output;
        ?>
    </body>
</html>