<?php
header('Content-Type: text/html; charset=utf-8');
require_once('db_configuration.php');
//DEFINE('DATABASE_HOST', 'localhost');
//DEFINE('DATABASE_DATABASE', 'ics325');
//DEFINE('DATABASE_USER', 'prashant');
//DEFINE('DATABASE_PASSWORD', 'password$2');
//
//$db = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
//$db->set_charset("utf8");
//
//    $key=$_GET['term'];
//    $array = array();
//  echo  $query="select * from users where username LIKE '%{$key}%'";
//$result = $db->query($query);
//    while($row=$result->fetch_assoc())
//    {
//      $array[] = $row['username'];
//    }
//    echo json_encode($array, JSON_FORCE_OBJECT);

$key = $_REQUEST["key"];

$hint = "";

// lookup all hints from array if $q is different from ""
if ($key !== "") {
    $query= 'SELECT * FROM words where word LIKE \'%'.$key.'%\' or english_word LIKE \'%'.$key.'%\';';

    $result = run_sql($query);
    while($row=$result->fetch_assoc())
    {
        $array[] = $row['word']. "\t". $row['english_word'];

    }
    //echo "<strong>Suggestions:</strong> <br> ";
    echo (implode("<br>",$array));
}

// Output "no suggestion" if no hint was found or output correct values
?>
