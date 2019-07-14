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
  </head>
  <title>Rebus</title>
  <body>
    <?PHP
    session_start();
    require('session_validation.php');
    ?>
    <?PHP echo getTopNav(); ?>
    <div class="divTitle" align="center">
      <font class="font">Rebus Puzzle</font>
    </div>
    <br>
    <div>
      <form id ="myform" action="puzzle.php" method="post" onsubmit="process()">
        <div class="container">
          <div class="inputDiv"><input type="textbox" name="puzzleWord" id="name-textbox" placeholder="Enter your Name to see the Puzzle" onclick="this.placeholder = ''" />
          </div>
          <br>
          <div style="text-align:center">
            <?PHP
            echo '<input class="main-buttons" type="submit" name="randomPlay" value="Show me.." />';
            if (adminSessionExists()) {
                //echo '<input class="main-buttons" type="submit" name="iDesign" value="I will design... (Option 1)" />';
              echo '<input class="main-buttons" type="submit" name="iDesign" value="I will design..." />';
            }
            ?>
          </div>
        </div>
      </form>
    </div>
<script>
    function process() {
        var form = document.getElementById('myform');
        var elements = form.elements;
        var values = [];

        values.push(encodeURIComponent(elements[0].name) + '=' + encodeURIComponent(elements[0].value));

        form.action += '?' + values.join('&');
    }
</script>
  </body>
</html>
