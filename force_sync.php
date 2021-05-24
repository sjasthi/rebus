<?php
    require('session_validation.php');
    set_time_limit(1000);
// ================ Includes ================

require 'db_configuration.php';

// Include the word processor file.
require_once 'includes/indic-wp.php';
$language = "Telugu";

// ================ Variables ================

$headerMessage = "";
$headerColor = "#ffae42";

// ================ Operations ================

// Perform sync operations requested by the user.
runSync($language);

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="styles/custom_nav.css" type="text/css">
    <link href="css/parse_style.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="styles/main_style.css" type="text/css"> -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->

    <link rel="stylesheet" href="styles/custom_nav.css" type="text/css">
    <title>Force Sync</title>
</head>

<body>
    <?php
    echo getTopNav();
    ?>
    <!-- Message -->
    <div class="text-center" style="width: 500px; height:30px; margin: 0 auto; margin-top: 25px; margin-bottom:25px; background-color:<?php echo $headerColor ?>; color: white;"><?php echo $headerMessage; ?></div>

    <?php

    // Reset message.
    $headerColor = "#ffae42";
    $headerMessage = "";

    ?>

    <!-- Form -->
    <div class="text-center" style="border:1px solid; Width: 500px; margin: 0 auto;">
        <h2>Force Sync</h2>

        <form method="post">
            <!-- Length -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" name="sync_length" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                    Length
                </label>
            </div>

            <!-- Strength -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" name="sync_strength" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                    Strength
                </label>
            </div>

            <!-- Weight -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" name="sync_weight" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                    Weight
                </label>
            </div>

            <!-- Character Frequency -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" name="sync_level" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                    Level
                </label>
            </div>
            
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" name="sync_characters" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                    Characters
                </label>
            </div><br><br>

            <!-- Submit -->
            <button type="submit" class="btn btn-outline-warning" style="margin-bottom: 10px;">Sync</button>
        </form>

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>

<!-- FUNCTIONS -->
<?php

// Retrives words from the DB.
function getWords()
{
    global $headerMessage;
    global $headerColor;

    // Get all Telugu words.
    $sql = "SELECT * FROM words";

    // Run query.
    $result = run_sql($sql);
    if (!$result) {
        $headerMessage = "Failed to query DB";
        $headerColor = "pink";
    }

    return $result;
}

// Performs the actual sync operations.
function runSync($language){
    if (isset($_POST['sync_length'])) $sync_length = $_POST['sync_length'];
    if (isset($_POST['sync_strength'])) $sync_strength = $_POST['sync_strength'];
    if (isset($_POST['sync_weight'])) $sync_weight = $_POST['sync_weight'];
    if (isset($_POST['sync_level'])) $sync_level = $_POST['sync_level'];
    if (isset($_POST['sync_characters'])) $sync_characters = $_POST['sync_characters'];


    global $headerColor;
    global $headerMessage;

    // Set to true if any operation is performed.
    // Used when setting the message for the user.
    $syncExecuted = false;

    // sync_length operation
    if (isset($sync_length)) {

        // An operation is being performed.
        // Used when setting the message for the user.
        $syncExecuted = true;

        $result = getWords();

        // How many rows were retrieved?
        $numRows = $result->num_rows;

        // If any were found...
        if ($numRows > 0) {

            // Perform the operation each word.        
            for ($i = 0; $i < $numRows; $i++) {
                $row = $result->fetch_array();
                $id = $row['word_id'];
                $word = $row['word'];
                $wordProcessor = new wordProcessor($word, $language);

                // Find the word's length.
                $tcount = $wordProcessor->parseToLogicalCharacters($word);
                $len = count($tcount);

                // Update that value in the DB.
                $sql = "UPDATE `words` SET `length` = '$len' WHERE `word_id` = $id";
                run_sql($sql);
            }
        }
    }

    // sync_strength operation
    if (isset($sync_strength)) {

        // An operation is being performed.
        // Used when setting the message for the user.
        $syncExecuted = true;

        // Retrive all words from the DB.
        $result = getWords();

        // How many rows were retrieved?
        $numRows = $result->num_rows;

        // If any were found...
        if ($numRows > 0) {

            // Perform the operation each word.        
            for ($i = 0; $i < $numRows; $i++) {
                $row = $result->fetch_array();
                $id = $row['word_id'];
                $word = $row['word'];

                // Find the word's strength.
                if (!is_english($word)){ 
                    $processor = new wordProcessor($word, 'telugu');
                    $strength = $processor->getWordStrength('telugu');
                } else {
                    $processor = new wordProcessor($word, 'english');
                    $strength = $processor->getWordStrength('english');
                }
                // Update that value in the DB.
  
                $sql = "UPDATE `words` SET `strength` = '$strength' WHERE `word_id` = $id;";
                run_sql($sql);
                
            }
            
        }
    }

    // sync_weight operation
    if (isset($sync_weight)) {
        
        // An operation is being performed.
        // Used when setting the message for the user.
        $syncExecuted = true;

        // Retrive all Telugu words from the DB.
        $result = getWords();

        // How many rows were retrieved?
        $numRows = $result->num_rows;

        // If any were found...
        if ($numRows > 0) {

            // Perform the operation each word.        
            for ($i = 0; $i < $numRows; $i++) {
                $row = $result->fetch_array();
                $id = $row['word_id'];
                $word = $row['word'];

                // Find the word's weight.
                if (!is_english($word)){ 
                    $processor = new wordProcessor($word, 'telugu');
                    $weight = $processor->getWordWeight('telugu');
                } else {
                    $processor = new wordProcessor($word, 'english');
                    $weight = $processor->getWordWeight('english');
                }
                // Update that value in the DB.

                $sql = "UPDATE `words` SET `weight` = '$weight' WHERE `word_id` = $id";
                run_sql($sql);
            }
        }
    }

    // sync_frequency operation
    if (isset($sync_level)) {
        
        // An operation is being performed.
        // Used when setting the message for the user.
        $syncExecuted = true;

        // Retrive all words from the DB.
        $result = getWords();

        // How many rows were retrieved?
        $numRows = $result->num_rows;

        // If any were found...
        if ($numRows > 0) {

            // Perform the operation each word.        
            for ($i = 0; $i < $numRows; $i++) {
                $row = $result->fetch_array();
                $id = $row['word_id'];
                $word = $row['word'];

                // Find the word's weight.
                if (!is_english($word)){ 
                    $processor = new wordProcessor($word, 'telugu');
                    $level = $processor->getWordStrength('telugu');
                } else {
                    $processor = new wordProcessor($word, 'english');
                    $level = $processor->getWordStrength('english');
                }
                // Update that value in the DB.

                $sql = "UPDATE `words` SET `level` = '$level' WHERE `word_id` = $id";
                run_sql($sql);
            }
        }
    }

    if (isset($sync_characters)) {
        
        // An operation is being performed.
        // Used when setting the message for the user.
        $syncExecuted = true;

        // Retrive all words from the DB.
        $result = getWords();

        // How many rows were retrieved?
        $numRows = $result->num_rows;

        //Delete all of the data from characters table
        $deleteData = 'TRUNCATE TABLE characters;';
        run_sql($deleteData);

        // If any were found...
        if ($numRows > 0) {

            // Perform the operation each word.        
            for ($i = 0; $i < $numRows; $i++) {
                $row = $result->fetch_array();
                $id = $row['word_id'];
                $word = $row['word'];

                // Update that value in the DB.
                $processor = new wordProcessor($word, "");
                $logicalChars = $processor->getLogicalChars();

                for ($j = 0; $j < count($logicalChars); $j++) {
                    //insert each letter into char table.
                    if($logicalChars[$j] != " ") {
                        $sqlAddLetters = 'INSERT INTO characters (word_id, character_index, character_value) VALUES (\'' . $id . '\', \'' . $j . '\', \'' . $logicalChars[$j] . '\');';
                        run_sql($sqlAddLetters);
                    }
                }
            }
        }
    }

    // If the header message isn't set at this point, all operations were a success.
    // Indicate as much to the user.
    if ($syncExecuted && $headerMessage == "") {
        $headerMessage = "Operation succeeded!";
        $headerColor = "lightgreen";
    }
}

function is_english($str)
{
    if (strlen($str) != strlen(utf8_decode($str))) {
        return false;
    } else {
        return true;
    }
}
?>