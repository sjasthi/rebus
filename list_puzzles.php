<!DOCTYPE html>
<html>
  <head>
    <?PHP
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
    <title>Rebus Puzzle List</title>
  </head>
  <body>
  <style>
      .tdWidth{
          width:1px;
          white-space:nowrap;
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
      <table class="table table-condensed main-tables" id="puzzle_table">
        <thead>
          <tr>
            <th>Puzzle Name</th>
            <th class="tdWidth">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          //session_start();
          $sql = 'SELECT * FROM puzzles ORDER BY puzzle_name, puzzle_id;';
          $db = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
          $db->set_charset("utf8");
          $result =  $db->query($sql);
          $count = 0;
          while($row = $result->fetch_assoc())
          { 
            echo '<tr>
          <td>
          <a href="puzzle.php?puzzleName='.$row["puzzle_name"].'">'.$row["puzzle_name"].'</a>
          </td>
          <td class="tdWidth">
            <a href="puzzle.php?puzzleName='.$row["puzzle_name"].'&id='.$row["puzzle_id"].'">
                <img class="table_image" src="pic/play.png" alt="Play '.$row["puzzle_name"].' puzzle">
            </a>';
          if (adminSessionExists()) {
            echo '
              <a href="change_puzzle.php?puzzleName='.$row["puzzle_name"].'"&button=edit">
                <img class="table_image" src="pic/edit.jpg" alt="Edit '.$row["puzzle_name"].' puzzle">
              </a>
              <a href="list_puzzles.php?puzzleID='.$row["puzzle_id"].'&button=delete">
                <img class="table_image" src="pic/delete.png" alt="Delete '.$row["puzzle_name"].' puzzle">
              </a>
              <a target="_blank" href="print_puzzle.php?id='.$row["puzzle_id"].'">
                <img class="table_image" src="pic/print.png" alt="Print '.$row["puzzle_name"].' puzzle">
              </a>
            ';
          }
          echo '</td>
          </tr>';
            $count++;
          }
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
               echo "<meta http-equiv=\"refresh\" content=\"0;URL=list_puzzles.php\">";
            }
          }

          ?>
        </tbody>
      </table>
    </div>
  </body>
</html>
