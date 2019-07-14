<?php
header('Content-Type: text/html; charset=utf-8');
require_once('db_configuration.php');


function deleteAllData()
{
    run_sql('SET foreign_key_checks = 0;');

    $sqlDeleteCharacters = 'DELETE FROM characters;';
    run_sql($sqlDeleteCharacters);

    $sqlDeleteWords = 'DELETE FROM words ';
    run_sql($sqlDeleteWords);

    run_sql('SET foreign_key_checks = 0;');
    run_sql('ALTER TABLE words AUTO_INCREMENT = 1;');
}


?>
