<?php
header('Content-Type: text/html; charset=utf-8');
require_once('db_configuration.php');
require('language_processor_functions.php');
require('utility_functions.php');
require('common_sql_functions.php');

/**
 * This method inserts given data into the Words table
 * @param $word
 * @param $eng_word
 * @param $image
 */
function insertIntoWordsTable($word, $eng_word, $image)
{
    //Check to see if entered words exists in the DB.
    $sqlCheck = 'SELECT * FROM words WHERE word = \'' . $word . '\';';
    $result = run_sql($sqlCheck);
    $num_rows = $result->num_rows;

    if ($num_rows == 0) {
        //insert each new words into words table.
        $sqlAddWord = 'INSERT INTO words (word_id, word, english_word, image) VALUES (DEFAULT, \'' . $word . '\', \'' . $eng_word . '\', \'' . $image . '\');';
        $result = run_sql($sqlAddWord);
        $word_id = $result;
        $logicalChars = getWordChars($word);

        for ($j = 0; $j < count($logicalChars); $j++) {
            //insert each letter into char table.
            if($logicalChars[$j] != " ") {
                $sqlAddLetters = 'INSERT INTO characters (word_id, character_index, character_value) VALUES (\'' . $word_id . '\', \'' . $j . '\', \'' . $logicalChars[$j] . '\');';
                run_sql($sqlAddLetters);
            }
        }
        echo '<h2 style="color:	green;" class="upload">Success: Word is added.</h2>';
    } else {
        //The words already exists in the database.
        echo '<h2 style="color:	red;" class="upload">Word already exists in the database.</h2>';
        //Do Nothing if the words already exists in the DB.
    }
}

/**
 * Inserts the characters of the given word into the Characters Table
 * Uses IndicTextAnalyzer method to break down the words into characters
 * @param $word
 */
function insertIntoCharactersTable($word)
{
    // Get words id
    $sql = 'SELECT word_id FROM words WHERE word =\'' . $word . '\';';
    $result = run_sql($sql);
    $row = $result->fetch_assoc();
    $word_id = $row["word_id"];

    $logicalChars = getWordChars($word);

    for ($j = 0; $j < count($logicalChars); $j++) {
        //insert each letter into char table.
        if($logicalChars[$j] != " ") {
            $sqlAddLetters = 'INSERT INTO characters (word_id, character_index, character_value) VALUES (\'' . $word_id . '\', \'' . $j . '\', \'' . $logicalChars[$j] . '\');';
            run_sql($sqlAddLetters);
        }
    }
}

?>
