<?php
require_once('db_configuration.php');
require_once('common_sql_functions.php');
require_once('language_processor_functions.php');
require_once('utility_functions.php');

function insertWordsAndCharacter($listOfWords)
{
    $listOfWords = validate_array($listOfWords);
    for ($i = 0; $i < count($listOfWords); $i++) {
        //Check to see if entered words exists in the DB.
        $sqlcheck = 'SELECT * FROM words WHERE word_value = \'' . $listOfWords[$i] . '\';';
        echo "<p>$sqlcheck</p>";
        $result = run_sql($sqlcheck);
        if (!$result) {
            echo "Checking words failed!";
        }
        $num_rows = $result->num_rows;
        if ($num_rows == 0) {
            //insert each new words into words table.
            $sqlAddWord = 'INSERT INTO words (word_id, word_value, english_word) VALUES (DEFAULT, \'' . $listOfWords[$i] . '\', \'' . $repId . '\');';
            echo "<p>$sqlAddWord</p>";
            $result = run_sql($sqlAddWord);
            if (!$result) {
                echo "Inserting words failed!";
            }
            // Get words id
            $sql = 'SELECT word_id FROM words WHERE word_value =\'' . $listOfWords[$i] . '\';';
            $result = run_sql($sql);
            if (!$result) {
                echo "Getting words id failed!";
            }
            $row = $result->fetch_assoc();
            $word_id = $row["word_id"];
            $logicalChars = getWordChars($listOfWords[$i]);
            echo "<br><br><br>";
            var_dump($logicalChars);
            for ($j = 0; $j < count($logicalChars); $j++) {
                //insert each letter into char table.
                $sqlAddLetters = 'INSERT INTO characters (word_id, character_index, character_value) VALUES (\'' . $word_id . '\', \'' . $j . '\', \'' . $logicalChars[$j] . '\');';
                $result = run_sql($sqlAddLetters);
                if (!$result) {
                    echo "Inserting character failed! ";
                }
            };
        } else {
            //The words already exists in the database.
            //echo "the words already exists.";
            //Do Nothing if the words already exists in the DB.
        }
    }
}

?>