

<?php //include 'navbar.php';

require('session_validation.php');
// Start session to store variables

if(!isset($_SESSION))

{

    session_start();

}

// Allows user to return 'back' to this page

ini_set('session.cache_limiter','public');

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

    <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet"/>

    <?PHP echo getTopNav(); ?>
</head>

<body class="body_background">
<div id="wrap">

    <div class="container">

        <h3>Puzzle List</h3>

        <table id="info" cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered" width="100%">

            <thead>

            <tr>

                <th>Puzzle Name</th>

                <th>Actions</th>

            </tr>

            </thead>

            <tbody>





            <?php

            require 'db_configuration.php';


            $sql = "SELECT * FROM puzzles";

            $result = run_sql($sql);



            if ($result->num_rows > 0) {


                // output data of each

                while($row = $result->fetch_assoc()) {

                    echo '<tr>

                        <td>' . $row["puzzle_name"] . '</td>  
                      
                        <td>
                            <a href="puzzle.php?puzzleName=' . $row["puzzle_name"] . '&id=' . $row["puzzle_id"]. '">
                                <img class="table_image" src="pic/play.png" alt="Play ' . $row["puzzle_name"]. ' puzzle">
                            </a>';
                              if (adminSessionExists()) {
                                echo '
                                  <a href="change_puzzle.php?puzzleName=' .$row["puzzle_name"] . '&button=edit" \">
                                    <img class="table_image" src="pic/edit.jpg" alt="Edit ' . $row["puzzle_name"] . ' puzzle">
                                  </a>
                                  <a href="puzzle_list.php?puzzleID=' . $row["puzzle_id"] . '&button=delete">
                                    <img class="table_image" src="pic/delete.png" alt="Delete ' . $row["puzzle_name"] . ' puzzle">
                                  </a>
                                  <a target ="_blank" href="print_puzzle.php?id=' . $row["puzzle_id"] . '">
                                    <img class="table_image" src="pic/print.png" alt="Print ' . $row["puzzle_name"] . ' puzzle">
                                  </a>
                                  <a href="#">
                                    <img class="table_image" src="pic/save_listPuzzle.png" alt="Print ' . $row["puzzle_name"] . ' puzzle">
                                  </a>
                                ';
                              }
                              echo '</td>
                        
                        </tr>';

                }







            } else {

                echo "0 results";

            }

            $result->close();

            // *** delete button functionality ***
            if(isset($_GET['puzzleID']))
            {
                if($_GET['button'] == 'delete')
                {
                    $id = $_GET['puzzleID'];

                    $sql = 'DELETE FROM puzzle_words WHERE puzzle_id='.$id.';';
                    $result =  $db->query($sql);

                    $sql = 'DELETE FROM puzzles WHERE puzzle_id='.$id.';';
                    $result =  $db->query($sql);
                    //header("Location:list_puzzles.php"); stoped woking and gave an error
                    echo "<meta http-equiv=\"refresh\" content=\"0;URL=puzzle_list.php\">";
                }
            }

            ?>

            </tbody>

            <tfoot>

            <tr>

                <th>Puzzle Name</th>

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

    $(document).ready(function() {

        $('#info').DataTable();

    });

</script>

</body>

</html>

