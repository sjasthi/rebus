<?php
include_once 'db_configuration.php';

ini_set("log_errors", 1); // go ahead and log the errors

// log the errors to a file called "rebus_errors.log"
ini_set("error_log", "rebus_errors.log"); 

    $value = $_POST['value'];
    $column = $_POST['column'];
    $id = $_POST['id'];
    echo "$value - $column - $id";

    $sql="UPDATE words SET $column = $value WHERE word_id = $id";
    run_sql($sql);

    
?>