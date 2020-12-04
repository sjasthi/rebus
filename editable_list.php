<?php
include_once 'db_configuration.php';

ini_set("log_errors", 1); // go ahead and log the errors

// log the errors to a file called "rebus_errors.log"
ini_set("error_log", "rebus_errors.log"); 

// You can also enable logging through script
// You can also specify the custom error log
$message = "editable_list.php";
error_log( $message); 

    $value = $_POST['value'];
    $column = $_POST['column'];
    $id = $_POST['id'];
    echo "$value - $column - $id";

    // $sql = "DELETE characters WHERE word_id = '$id'";
    // mysqli_query($db, $sql);

    $sql="UPDATE words SET $column = $value WHERE word_id = $id";
    run_sql($sql);
    
    // insertIntoCharactersTable($value);

//     function insertIntoCharactersTable($word)
// {
//     // Get words id
//     $sql = 'SELECT word_id FROM words WHERE word =\'' . $word . '\';';
//     $result = run_sql($sql);
//     $row = $result->fetch_assoc();
//     $word_id = $row["word_id"];

//     $logicalChars = getWordChars($word);

//     for ($j = 0; $j < count($logicalChars); $j++) {
//         //insert each letter into char table.
//         if($logicalChars[$j] != " ") {
//             $sqlAddLetters = 'INSERT INTO characters (word_id, character_index, character_value) VALUES (\'' . $word_id . '\', \'' . $j . '\', \'' . $logicalChars[$j] . '\');';
//             run_sql($sqlAddLetters);
//         }
//     }
// }
    
?>