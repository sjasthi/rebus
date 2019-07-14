<!DOCTYPE html>
<html>
<head>
    <?PHP
    session_start();
    require('session_validation.php');
    //require ('list.php');
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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src = "javascript/typeahead.min.js"></script>
    <link rel="stylesheet" href="styles/custom_nav.css" type="text/css">
    <title>Rebus Word List</title>
</head>
<body>
<style type="text/css">
    .bs-example{
        font-family: sans-serif;
        position: relative;
        margin: 50px;
    }
    .typeahead, .tt-query, .tt-hint {
        border: 2px solid #CCCCCC;
        border-radius: 8px;
        font-size: 24px;
        height: 30px;
        line-height: 30px;
        outline: medium none;
        padding: 8px 12px;
        width: 396px;
    }
    .typeahead {
        background-color: #FFFFFF;
    }
    .typeahead:focus {
        border: 2px solid #0097CF;
    }
    .tt-query {
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
    }
    .tt-hint {
        color: #999999;
    }
    .tt-dropdown-menu {
        background-color: #FFFFFF;
        border: 1px solid rgba(0, 0, 0, 0.2);
        border-radius: 8px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        margin-top: 12px;
        padding: 8px 0;
        width: 422px;
    }
    .tt-suggestion {
        font-size: 24px;
        line-height: 24px;
        padding: 3px 20px;
    }
    .tt-suggestion.tt-is-under-cursor {
        background-color: #0097CF;
        color: #FFFFFF;
    }
    .tt-suggestion p {
        margin: 0;
    }
</style>
<?php
require('db_configuration.php');
?>
<?PHP echo getTopNav(); ?>
<div id="pop_up_fail" class="container pop_up" style="display:none">
    <div class="pop_up_background">
        <img class="pop_up_img_fail" src="pic/info_circle.png">
        <div class="pop_up_text">Incorrect! <br>Try Again!</div>
        <button class="pop_up_button" onclick="toggle_display('pop_up_fail')">OK</button>
    </div>
</div>


<div class="container">
    <form action="" method="post">
    <img src="./pic/searchIcon.png" style="height: 40px; width: 40px">
    <input  type="text" name="key" id="key" onkeyup="showHint(this.value)" autocomplete="off" spellcheck="false" placeholder="Search for names.." >
        <p><span id="txtHint"></span></p>
    <!--    <div id="result"></div>-->
    </form>
</div>
    <script>
        function showHint(str) {
            if (str.length == 0) {
                document.getElementById("txtHint").innerHTML = "";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("txtHint").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "search.php?key=" + str, true);
                xmlhttp.send();
            }
        }
//        $(document).ready(function(){
//            $('typeahead').typeahead({
//                name: 'typeahead',
//                remote:'list_words.php?key=%QUERY',
//                limit : 10
//            });
//        });
    </script>

    <?php
//    $search=$_GET['key'];
//    $array = array();
//    echo $sql = "SELECT * FROM words where word LIKE '%{$search}%' or english_word LIKE '%{$search}%'";
//     $result = run_sql($sql);
//    while($row=$result->fetch_assoc())
//    {
//        $array[] = $row['english_word'];
//    }
//    echo $data = json_encode($array, JSON_FORCE_OBJECT);
    ?>

        <?php

//        if(ISSET($_REQUEST['key'])) {
//            $search = $_REQUEST['key'];
//            $sql = 'SELECT * FROM words where word LIKE \'%' . $search . '%\' or english_word LIKE \'%' . $search . '%\';';
//            $result = run_sql($sql);

            if(ISSET($_POST['key'])) {
                $search = $_POST['key'];
                $sql = 'SELECT * FROM words where word LIKE \'%' . $search . '%\' or english_word LIKE \'%' . $search . '%\';';
                $result = run_sql($sql);
//                while($row=$result->fetch_assoc())
//                {
//                    $word = $row['word'];
//                    $eng_word = $row['english_word'];
//                    $b_word = '<strong>'.$search.'</strong>';
//                    $b_eng_word ='<strong>'.$search.'</strong>';
//                    $final_word = str_ireplace($search, $b_word, $word);
//                    $final_eng_word = str_ireplace($search, $b_eng_word, $eng_word);
//
//                    echo '<div class="show" align="left">';
//                    echo '<img src="" style="width:50px; height:50px; float:left; margin-right:6px;" /><span class="name"><?php echo $final_word;
//                    echo '</div>';

                //}
          //  }
        }else {
            $sql = 'SELECT * FROM words;';
            $result = run_sql($sql);
          //  $resArr = mysqli_fetch_array($result, MYSQLI_NUM);
        }

        $data = array();
        while($row = $result->fetch_assoc())
        {
            array_push($data, $row);
        }
        $count =0;
        $limit = 50;
        $totalRows = $result->num_rows;
        if(isset($_GET['page']))
        {
            $page=$_GET['page'] + 1;
            $offset = $limit * ($page-1) ;

        }else{
            $page = 1;
            $offset = 0;

        }
       // echo "Max Page:";
       $maxPages = ceil($totalRows/$limit);
       // $sql = 'SELECT * FROM words LIMIT '.$offset.','.$limit.' ;';
       // $result = run_sql($sql);

//        echo "Page;" .$page;
//        echo $offset;
//        $remainingRows = $totalRows - ($page * $limit);
//        echo "Rem";
//        echo $left_rec = $remainingRows - ($page * $limit);
        $i=0;
        while ($i < $maxPages){
            echo "<a href = \"?page=$i\" style=\"font-size:160%;\"> [" .($i+1)."] </a> ";
            $i++;
        }
echo'<a href="./add_word.php"><img src="./pic/adminAddWord.png" style="margin-left:48%"></a>';
echo '<div>
    <table class="table table-condensed main-tables" id="puzzle_table">
        <thead>
        <tr>
            <th>Word ID</th>
            <th>Word</th>
            <th>English Word</th>
            <th>Image Thumbnail</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>';

        for($count=$offset; $count < $limit * $page; $count++){
       // while ($row = $result->fetch_assoc()) {
            if(count($data) > $count) {
            $row = $data[$count];

                $word_id = $row['word_id'];
                echo '<tr>
          <td>' . $word_id . '</td>
          <td>' . $row['word'] . '</td>
          <td>' . $row['english_word'] . '</td>
          <td><img class="thumbnailSize" src="./Images/' . $row['image'] . '" alt ="' . $row['image'] . '"></td>
          <td>
          <a href="admin_edit_synonyms.php?id=' . $word_id . '"&button=edit">
            <img class="table_image" src="pic/edit.jpg" alt="Edit ' . $word_id . ' word">
          </a>
          <a href="list_words.php?id=' . $word_id . '&button=delete">
            <img class="table_image" src="pic/delete.jpg" alt="deleteWord">
          </a>
            <form class="upload" method="post" name="importFrom" enctype="multipart/form-data" onsubmit="return validateForm()">
              <label class="upload"><input class="upload" type="file" name="fileToUpload" id="fileToUpload"></label>
              <input class="upload" type="hidden" name="word_id" value="' . $word_id . '" />
              <input class="upload" type="submit" value="Upload/Replace Image" name="submit">
            </form>
          </td>
          </tr>';
                // $count++;
            }
        }


        if (isset($_POST['submit'])) {

            $inputFileName = $_FILES["fileToUpload"]["tmp_name"];
            echo $inputFileName;
            echo $_POST['word_id'];

            $target_dir = "./Images/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            echo $target_file;
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
            $imageName = basename($_FILES["fileToUpload"]["name"]);
            echo $imageName;
            copy($inputFileName, $target_file);

            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $sql = 'UPDATE words SET image=\'' . $imageName . '\' WHERE word_id=' . $_POST['word_id'] . '';
                $result = run_sql($sql);
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
            echo '<h2 style="color:	green;" class="upload">Import Successful!</h2>';
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $location . '">';
        }

        // *** delete button functionality ***
                if(isset($_GET['id']))
                {
                    if($_GET['button'] === 'delete')
                    {
                        $id = $_GET['id'];

                        $sql = 'DELETE FROM words WHERE word_id='.$id.';';
                        //$result =  $db->query($sql);
                        $result = run_sql($sql);
                        echo $result;

                        //header("Location:list_puzzles.php"); stoped woking and gave an error
                        //echo "<meta http-equiv=\"refresh\" content=\"0;URL=list_puzzles.php\">";
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
    </table>
</div>
</body>
</html>
