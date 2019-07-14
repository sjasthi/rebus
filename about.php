<!DOCTYPE html>
<html>
<head>
    <?PHP
    session_start();
    require('session_validation.php')
    ?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles/main_style.css" type="text/css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="styles/custom_nav.css" type="text/css">
    <link rel="stylesheet" href="styles/about_page.css" type="text/css">
</head>
<title>About Rebus</title>

<body>
    <?PHP
    //session_start();
    echo getTopNav();
    ?>
    <br>

    <div class="container" style="background-color: #f9f9f9;">
        <div>
            <h1 align="center">About Rebus Puzzle</h1>
        </div>
        <br>
        <div>
            <h4><p>Rebus is a picture and words based puzzle. Upon entering a word on the home input menu, the system
                generates a puzzle based on the word entered by the user. Each image shown on the puzzle contains the
                corresponding letter and it's position of the word that the user has to guess.</p></h4>
            <div>
                <h3>How to play:</h3>
                <ol>
                    <br><li class="aboutPageText">Home Page</li><br><img src="./howTo/index.PNG" class="aboutPageImage"><br>

                    <br><li class="aboutPageText">Enter your name and click on <b><i>"Show Me.."</i></b> button</li><br><img src="./howTo/typeName.PNG" class="aboutPageImage"><br>

                    <br><li class="aboutPageText">Change Input Mode for longer words if necessary</li><br><img src="./howTo/inputMode.PNG" class="aboutPageImage"><br>

                    <br><li class="aboutPageText">Guess the words</li><br><img src="./howTo/puzzle.PNG" class="aboutPageImage"><br>

                    <br> <li class="aboutPageText">Click on <b><i>"Submit Solution"</i></b> after you guess the words each image.</li><br>

                    <ul>
                        <li class="aboutPageText">Correct guess</li><br><img src="./howTo/correctGuess.PNG" class="aboutPageImage"><br>

                        <br><li class="aboutPageText">Incorrect guess</li><br><img src="./howTo/incorrectGuess.PNG" class="aboutPageImage"><br>

                    </ul>

                    <br><li class="aboutPageText">You need to be logged in order to see the <i>Solution</i> of the puzzle. Please contact your <u><i>System Administrator</i></u> for the privilege.</li><br>

                    <br><li class="aboutPageText">Try again if you want to guess the words again or click on the <b><i>SILC logo</i></b> to go back to the home page and play with a different word.</li><br>
                </ol>

            </div>
            <div>
                <p style="float: right;">
                    Designer, Instructor and System Administrator: <i>Dr Siva R. Jasthi</i><br>
                    Developed By: <i>Prashant Shrestha</i><br>
                    <b><i>Capstone Project - Summer 2017</i></b><br>
                    <b><i>Copyright SILC Rebus</i></b><br></p>
            </div>


        </div>
    </div>

</body>

</html>