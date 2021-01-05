<?php //include 'navbar.php';
session_start();
require('session_validation.php');
// Start session to store variables

if (!isset($_SESSION)) {
    ini_set('session.cache_limiter', 'public');
    session_cache_limiter(false);

    session_start();

}

// Allows user to return 'back' to this page


ini_set("log_errors", 1); // go ahead and log the errors

// log the errors to a file called "rebus_errors.log"
ini_set("error_log", "rebus_errors.log"); 


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

        <div>
        Toggle column: 
        <a class="toggle-vis" data-column="0">Word ID</a> - 
        <a class="toggle-vis" data-column="1">Word</a> - 
        <a class="toggle-vis" data-column="2">English Word</a> - 
        <a class="toggle-vis" data-column="3">Image</a> - 
        <a class="toggle-vis" data-column="4">Actions</a> - 
        <a class="toggle-vis" data-column="5">Length</a> -
        <a class="toggle-vis" data-column="6">Weight</a> - 
        <a class="toggle-vis" data-column="7">Strength</a> - 
        <a class="toggle-vis" data-column="8">Level</a> - 
        <a class="toggle-vis" data-column="9">Date Modified</a> - 
        <a class="toggle-vis" data-column="10">Date Created</a> 
        </div>


        <table id="info" cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered"
               width="100%">

            <thead>

            <tr>

                <th>Word ID</th>

                <th>Word</th>

                <th>English Word</th>


                <th>Actions</th>

                <th>Length</th>

                <th>Weight</th>

                <th>Strength</th>

                <th>Level</th>



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

                    $ID = $row["word_id"];
                    $word = $row["word"];
                    $english_word = $row["english_word"];
                    $length = $row["length"];
                    $weight = $row["weight"];
                    $strength = $row["strength"];
                    $level = $row["level"];

                    $_SESSION['role'] = "Admin";
                    if(isset($_SESSION['role'])) {
?>
                <tr>
                    <td><?php echo $ID; ?></td>
                    <!-- contenteditable="true" onBlur="updateValue(this,'word','<php echo $ID; ?>')" -->
                    <!-- contenteditable="true" onBlur="updateValue(this,'english_word','<php echo $ID; ?>')" -->
                    <td><div><?php echo $word; ?></div></span> </td>
                    <td><div><?php echo $english_word; ?></div></span> </td>
                    <td><div><a href='admin_edit_synonyms.php?id=<?php echo $ID; ?> &button=edit'>
                            <img class="table_image" src="pic/edit.jpg" alt="Edit " <?php $ID; ?>>
                            </a>
                            <a href='list.php?id=<?php echo $ID; ?> &button=delete'>
                                <img class="table_image" src="pic/delete.png" alt="deleteWord">
                            </a>
                            <form class="upload" method="post" name="importFrom" enctype="multipart/form-data" onsubmit="return validateForm()">
                                  <label class="upload"><input class="upload" type="file" name="fileToUpload" id="fileToUpload"></label>
                                  <input class="upload" type="hidden" name="word_id" value="" <?php $ID; ?>/>
                                  <input class="upload" type="submit" value="Upload/Replace Image" name="submit">
                            </form>
                            </div></span> </td>
                    <td><div><?php echo $length; ?></div></span> </td>
                    <td><div><?php echo $weight; ?></div></span> </td>
                    <td><div><?php echo $strength; ?></div></span> </td>
                    <td><div contenteditable="true" onBlur="updateValue(this,'level','<?php echo $ID; ?>')"><?php echo $level; ?></div></span> </td>
                </tr>
                 <?php  
                    }else{ 
                    echo '<tr>
                        <td>' . $row["word_id"] . "</td>
                
                        <td>" . $row["word"] . "</td>
                
                        <td>" . $row["english_word"] . "</td>
                
                      
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
                        <td>" . $row["length"] . "</td>
                        
                        <td>" . $row["weight"] . "</td>
                        <td>" . $row["strength"] . "</td>
                        <td><div contenteditable=\"true\" onBlur=\"updateValue(this,'word','<?php echo $ID; ?>')\">". $row["level"] . "</div></span> </td>
            
                        
                        </tr>";
                }
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

      
                <th>Actions</th>

                <th>Length</th>

                <th>Weight</th>

                <th>Strength</th>

                <th>Level</th>

    

            </tr>

            </tfoot>

        </table>

    </div>

</div>

<!--JQuery-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 

<script type="text/javascript" charset="utf8"
        src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

<!--Data Table-->
<script type="text/javascript" charset="utf8"
        src="https://editor.datatables.net/extensions/Editor/js/dataTables.editor.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>


    <script type="text/javascript" language="javascript">
    $(document).ready( function () {
        
        $('#info').DataTable( {
            dom: 'lBfrtip',
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            paging: true,
            pagingType: "full_numbers",
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ] }
        );

        $('#info thead tr').clone(true).appendTo( '#info thead' );
        $('#info thead tr:eq(1) th').each( function (i) {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    
            $( 'input', this ).on( 'keyup change', function () {
                if ( table.column(i).search() !== this.value ) {
                    table
                        .column(i)
                        .search( this.value )
                        .draw();
                }
            } );
        } );
    
        var table = $('#info').DataTable( {
            orderCellsTop: true,
            fixedHeader: true,
            retrieve: true
        } );
        
    } );

    $(document).ready(function() {
        
    var table = $('#info').DataTable( {
        retrieve: true,
        "scrollY": "200px",
        "paging": false
    } );
 
    $('a.toggle-vis').on( 'click', function (e) {
        e.preventDefault();
 
        // Get the column API object
        var column = table.column( $(this).attr('data-column') );
 
        // Toggle the visibility
        column.visible( ! column.visible() );
    } );
} );

function updateValue(element,column,id){
        var value = element.innerText

        $.ajax({
            type: 'post',
            url:'editable_list.php',
            data:{
                value: value,
                column: column,
                id: id
            },
            success:function(php_result){
				console.log(php_result);
				
            }
            
        })
    }
</script>

</body>

</html>