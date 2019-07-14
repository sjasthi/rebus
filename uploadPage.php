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
    <title>Rebus Import</title>
</head>
<?PHP
require('session_validation.php');
//require('import.php');
/*
if ((!isset($_SESSION['valid_admin'])){
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=login.php\">";
}
else{
}
*/
?>

<body>
<?PHP
session_start();
echo getTopNav();
?>
<div id="export">
    <br><br>
    <h2 class="upload">Import the word list (Source: Excel File; Target: Database)</h2><br><br>
    <div id="import">
        <p id="error" style="display: none;">Error: You must select a file to import</p>
        <?php
        require('import.php');
        if ($error) {
            ?>
            <p id="error" style="display:block;background-color: #ce4646;padding:5px;color:#fff;">
                <?php echo $result; ?>
            </p>
        <?php } ?>
        <form class="upload" method="post" name="importFrom" enctype="multipart/form-data"
              onsubmit="return validateForm()">
            <label class="upload"><input class="upload" type="file" name="fileToUpload" id="fileToUpload"></label>
            <input class="upload" type="submit" value="Submit File" name="submit">
        </form>
    </div>
    <br><br>
</div>

<script>
    function validateForm() {
        var eng = document.forms["importFrom"]["fileToUpload"].value;
        if (eng == "") {

            document.getElementById("error").style = "display:block;background-color: #ce4646;padding:5px;color:#fff;";
            return false;
        }
    }

</script>
</body>

</html>