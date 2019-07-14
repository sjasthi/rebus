<?php //include 'navbar.php';

require('session_validation.php');
// Start session to store variables

if (!isset($_SESSION)) {

    session_start();

}

// Allows user to return 'back' to this page

ini_set('session.cache_limiter', 'public');

session_cache_limiter(false);


?>

<!DOCTYPE html>

<html>

<head>
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
    <title>Rebus Word List</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/css/dataTables.bootstrap.min.css"
          rel="stylesheet"/>

    <?PHP echo getTopNav(); ?>
</head>

<body class="body_background">
<div id="wrap">

    <div class="container">

        <h3>Word List</h3>

        <table id="info" cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered"
               width="100%">

            <thead>

            <tr>

                <th>Word ID</th>

                <th>Word</th>

                <th>English Word</th>

                <th>Image</th>

                <th>Actions</th>

            </tr>

            </thead>

            <tbody>


            <?php

            require 'db_configuration.php';


            $sql = "SELECT * FROM words";

            $result = run_sql($sql);


            if ($result->num_rows > 0) {

                // output data of each

                while ($row = $result->fetch_assoc()) {

                    echo '<tr>

                        <td>' . $row["word_id"] . "</td>
                
                        <td>" . $row["word"] . "</td>
                
                        <td>" . $row["english_word"] . "</td>
                
                        <td><img class=\"thumbnailSize\" src=\"./Images/" . $row["image"] . "\"  alt =\"" . $row["image"] . "\" ></td>
                        
                        <td>
                            <a href='admin_edit_synonyms.php?id=" . $row["word_id"] . "&button=edit'>
                                <img class=\"table_image\" src=\"pic/edit.jpg\" alt=\"Edit " . $row["word_id"] . " word\">
                            </a>
                            <a href='list.php?id=" . $row["word_id"] . "&button=delete'>
                                <img class=\"table_image\" src=\"pic/delete.png\" alt=\"deleteWord\">
                            </a>
                            <form class=\"upload\" method=\"post\" name=\"importFrom\" enctype=\"multipart/form-data\" onsubmit=\"return validateForm()\">
                                  <label class=\"upload\"><input class=\"upload\" type=\"file\" name=\"fileToUpload\" id=\"fileToUpload\"></label>
                                  <input class=\"upload\" type=\"hidden\" name=\"word_id\" value=\"" . $row["word_id"] . "\" />
                                  <input class=\"upload\" type=\"submit\" value=\"Upload/Replace Image\" name=\"submit\">
                            </form> 
                        </td>
                        
                        </tr>";
                }
            } else {
                echo "0 results";
            }

            $result->close();

            // *** delete button functionality ***
            if (isset($_GET['id'])) {
                if ($_GET['button'] == 'delete') {
                    $id = $_GET['id'];

                    $sql = 'DELETE FROM characters WHERE word_id=' . $id . ';';
                    $result = $db->query($sql);

                    $sql = 'DELETE FROM words WHERE word_id=' . $id . ';';
                    $result = $db->query($sql);

                    echo ' <script> alert(\'Record has been successfully deleted!!\'); window.location.replace("list.php"); </script>';
                }
            }

            if (isset($_POST['submit'])) {
                $inputFileName = $_FILES["fileToUpload"]["tmp_name"];
                $target_dir = "./Images/";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
                $imageName = basename($_FILES["fileToUpload"]["name"]);
                copy($inputFileName, $target_file);
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if ($check !== false) {
                    $sql = 'UPDATE words SET image=\'' . $imageName . '\' WHERE word_id=' . $_POST['word_id'] . '';
                    $result = run_sql($sql);
                    echo ' <script> alert(\'Image Upload Successful!!\'); window.location.replace("list.php"); </script>';
                } else {
                    echo ' <script> alert(\'Image is not valid!\');</script>';
                }
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

            </script>

            </tbody>

            <tfoot>

            <tr>

                <th>Word ID</th>

                <th>Word</th>

                <th>English Word</th>

                <th>Image</th>

                <th>Actions</th>

            </tr>

            </tfoot>

        </table>

    </div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">

    $(document).ready(function () {

        $('#info').DataTable();

    });

</script>

</body>

</html>

