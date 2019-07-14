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
<title>User Manual Rebus</title>

<body>
<?PHP
//session_start();
echo getTopNav();
?>
<br>

<div class="container" style="background-color: #f9f9f9;">
    <div>
        <h1 align="center">Rebus Puzzle: User Manual</h1>
    </div>
    <br>
    <div>
        <h3><p>Rebus is a picture and words based puzzle. Upon entering a word on the home input menu, the system
                generates a puzzle based on the word entered by the user. Each image shown on the puzzle contains the
                corresponding letter and it's position of the word that the user has to guess.</p></h3>
        <div>
            <h3>Admin Settings:</h3>
            <ol>
                <br><li class="aboutPageText">
                    Add Word: This menu option can be used to add new pair of words to the database.
                    Users can select an Image along with the words but it is not mandatory.
                    Images can be added later through <b>Word List</b> option as well.
                </li><br>

                <br><li class="aboutPageText">
                    Word List: This menu option can be used to view all the available words, english words and corresponding
                    images that are available in the database. Options to search and sort the words is available
                    along with page size configuration. Additionally, Words and Images can be edited and/or deleted
                    as well.
                </li><br>

                <br><li class="aboutPageText">
                    Users: This menu option can be used to add and delete admin users from the system.
                </li><br>

                <br><li class="aboutPageText">
                    Export: This menu option can be used to export all the data from tables in the database into an excel file. The
                    file will be downloaded to the folder specified in your browser.
                </li><br>

                <br> <li class="aboutPageText">
                    Import: This menu option can be used to import an excel file into the database.
                    <i><b>Caution:</b></i> Importing a new excel file will clear out all the data from your existing database
                    and replace it with the content of the imported excel file.
                </li><br>


                <br><li class="aboutPageText">
                    Configure: This menu option can be used to set the <i>columns per row</i> when generating puzzles on the following puzzle generation modes:
                    <ul>
                        <li>One To Many</li>
                        <li>Many To One</li>
                        <li>One To Many Plus</li>
                    </ul>
                </li><br>

                <br><li class="aboutPageText">
                    Backup: This menu option can be used to back up your database into the <i>SQL_FILES</i> folder on your domain host.
                    <i><b>Note:</b></i> The file will get saved in <i>.sql</i> format. Any number of backups within 24 hours
                    will be replaced with the latest version. However, new files are generated once everyday.
                </li><br>

                <br><li class="aboutPageText">
                    Report: This menu option can be used to view different reports that relates to the system.
                    <ul>
                        <li>Report on word usage in the system.</li>
                        <li>Report on total number of each data in each entity.</li>
                        <li>Report on total images in the system.</li>
                    </ul>
                </li><br>

                <br><li class="aboutPageText">
                    One Word Many Puzzle: This menu option opens up a new window where you can enter a word and the system generates
                    as many puzzles as possible by using all the data from the database.
                    <i>Note: </i>The multiple puzzle generation stops when the system runs out of word for any corresponding character.
                    <ul>
                        <li>
                            The page contains different options to change the display mode of the generated puzzle.
                            <ul>
                                <li>
                                    Image display preferences.
                                </li>
                                <li>
                                    Answer display preferences.
                                </li>
                            </ul>
                        </li>
                        <li>
                            Clicking the <i>SILC</i> icon at the top will show and hide the options for "Print Ready" mode.
                        </li>
                    </ul>
                </li><br>

                <br><li class="aboutPageText">
                    Many Words One Puzzle: This menu option opens up a new window where you can enter a list of words and the system generates puzzles
                    for each word.
                    <ul>
                        <li>
                            The words can be entered separated by a comma or entered as a list of words.
                        </li>
                        <li>
                            The default number of words the system will process is set to 100 but it can be changed as needed.
                        </li>
                        <li>
                            The page contains different options to change the display mode of the generated puzzle.
                            <ul>
                                <li>
                                    Image display preferences.
                                </li>
                                <li>
                                    Answer display preferences.
                                </li>
                            </ul>
                        </li>
                        <li>
                            Clicking the <i>SILC</i> icon at the top will show and hide the options for "Print Ready" mode.
                        </li>
                    </ul>
                </li><br>

                <br><li class="aboutPageText">
                    One Word Many Puzzle Plus: This menu option opens up a new window where you can enter a word and specify how many puzzles
                    are to be generated for the provided word.
                    <ul>
                        <li>
                            The default number of puzzles the system will generate is set to 10 but it can be changed as needed.<br>
                            <i>Note: </i>In case the system runs out of available words to generate the puzzle, the system generates puzzles in
                            default mode where just the corresponding letters will be displayed.
                        </li>
                        <li>
                            The page contains different options to change the display mode of the generated puzzle.
                            <ul>
                                <li>
                                    Image display preferences.
                                </li>
                                <li>
                                    Answer display preferences.
                                </li>
                            </ul>
                        </li>
                        <li>
                            Clicking the <i>SILC</i> icon at the top will show and hide the options for "Print Ready" mode.
                        </li>
                    </ul>
                </li><br>
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