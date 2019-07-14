<!DOCTYPE html>
<html>
<head>
    <?PHP
    require_once('db_configuration.php');
    require_once('create_puzzle.php');
    //require_once('add_words_process.php');
    //require('InsertUtil.php');
    session_start();
    require('session_validation.php');
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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles/main_style.css" type="text/css">
</head>
<title>Rebus Edit Words</title>
    <body>
    <?PHP echo getTopNav();

        if (isset($_GET['id'])) {
            $word_id= $_GET['id'];
            //echo $word_id;
            if ($word_id != NULL) {
                $sqlcheck = 'SELECT * FROM words WHERE word_id = \'' . $word_id. '\';';
                $result = run_sql($sqlcheck);
                $row = $result->fetch_assoc();
                $word_id = $row["word_id"];
                $word = $row["word"];
                $eng_word = $row["english_word"];
                $img = $row["image"];
                //echo $word . ',' . $eng_word . ',' . $img;

//                if ($data != $wordProvided) {
//                    $show = $show . ", " . $data;
//                }
            }
        }

    echo '<div>
        <br>
        <br>
        <!--    <button type="button" id="addRow" name="addRow" onclick="AddTableRows()">Add More Rows</button>-->
        <table class="table table-condensed main-tables" id="word_table" style="margin-left:11%;">
            <thead>
            <tr>
                <th>Word</th>
                <th>English Word</th>
                <th>Image Thumbnail</th>
                <th>Update Thumbnail</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                    <tr>
                        <td><input type="textbox" name="word" id="name" value='.$word.'></td>
                        <td><input type="textbox" name="eng_word" id="eng_word" value='.$eng_word.'></td>
                        <td><img class="thumbnailSize" src="./Images/' . $row['image'] . '" alt ="' . $row['image'] . '"></td>
                        <td><input class="upload" type="file" name="fileToUpload" id="fileToUpload" /></td>
                        <td><input class="upload" type="submit" value="Update Word" name="submit" onclick="success()"/></td>
                    </tr>
                </form>
            </tbody>
        </table>
    </div>';
        ?>

            <?php


            if (isset($_POST['submit'])) {
                if (isset($_POST['word'])) {
                    $word = $_POST['word'];
                }
                if (isset($_POST['eng_word'])) {
                    $eng = $_POST['eng_word'];
                }
                            $inputFileName = $_FILES["fileToUpload"]["tmp_name"];
                            //echo $inputFileName;

                            $target_dir = "./Images/";
                            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                            //echo $target_file;
                            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
                            $imageName = basename($_FILES["fileToUpload"]["name"]);
                            // echo $imageName;
                            if(!empty($imageName)) {
                                copy($inputFileName, $target_file);
                            }

                $deleteCharacters = 'DELETE FROM characters WHERE word_id = ' . $word_id . ' ; ';
                //echo $deleteCharacters;
                run_sql($deleteCharacters);

                $sql = 'UPDATE words SET word = \''.$word.'\', english_word = \''.$eng.'\', image =\''.$img.'\' WHERE word_id = '.$word_id.';';
                $result = run_sql($sql);
                //echo $sql;
                $uploadOk = 1;

                //update the characters table
                $logicalChars = getWordChars($word);

                for ($j = 0; $j < count($logicalChars); $j++) {
                    //update each letter into char table.
                    if($logicalChars[$j] != " ") {
                        $sqlAddLetters = 'INSERT INTO characters (word_id, character_index, character_value) VALUES (\'' . $word_id . '\', \'' . $j . '\', \'' . $logicalChars[$j] . '\');';
                        run_sql($sqlAddLetters);
                    }
                }

                //echo '<h2 style="color:	green;" class="upload">Success: Word is updated.</h2>';
                echo '<script>window.location.href = "list.php"</script>';


            }
            ?>
            <script>
                function validateForm() {
                    var eng = document.forms["importFrom"]["fileToUpload"].value;
                    if (eng == "") {

                        document.getElementById("error").style = "display:block;background-color: #ce4646;padding:5px;color:#fff;";
                        return false;
                    }
                }

                function AddTableRows() {
                    alert("add rows");
                    // Find a <table> element with id="myTable":
                    var table = document.getElementById("myTable");

                    // Create an empty <tr> element and add it to the 1st position of the table:
                    var row = table.insertRow(git);

                }

                function success() {
                    alert("The word has been updated. Please search for the word on the word list table.");
                }

            </script>
    </body>
</html>
