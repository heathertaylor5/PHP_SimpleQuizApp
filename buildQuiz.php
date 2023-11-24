<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Quiz Build Page</title>
    </head>
    <body>
        <?php
        //Get fileUtils
        include 'FileUtils.php';

        //create variables for each quiz
        $geographyQuizFile = "WorldGeography.json";
        $mathQuizFile = "NumberSystems.json";

        //determine which quiz the user selected
        $quizSelection = $_GET['quizzes'];

        //get the proper quiz file based on user's selection - Direct them to the error page if there is an issue
        if($quizSelection == 'geography'){
            $quizFile = $geographyQuizFile;
        }else if($quizSelection == 'math'){
            $quizFile = $mathQuizFile;
        }else{
            header("location: errorPage.php");
        }

        //read the file and decode
        $fileContents = readFileIntoString($quizFile);
        $quiz = json_decode($fileContents, true);

        //determine the length of the quiz
        $numQuestions = count($quiz['questions']);

        //Store data in session
        session_start();
        $_SESSION['quizInfo'] = $quiz;
        $_SESSION['currentQuestionNumber'] = 0;

        //Fill an array for user answers with -1 and send to session
        $userAnswers = array_fill(0, $numQuestions, -1);
        $_SESSION['userAnswers'] = $userAnswers;

        //Direct browser to showQuestion page
        header("location: showQuestion.php");
        ?>
    </body>
</html>