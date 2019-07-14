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
<title>Rebus Reports</title>
<body>

<?PHP
session_start();
require('session_validation.php');
?>
<?PHP echo getTopNav(); ?>
<div id="container" align="center">
    <?php
    /* Include the `fusioncharts.php` file that contains functions  to embed the charts. */
    include("includes/fusioncharts.php");
    require("db_configuration.php");

    $array = array();
    $sql = "SELECT * FROM puzzles";
    $presult = run_sql($sql);
    $array["puzzles"] = $presult->num_rows;

    $sql = "SELECT * FROM puzzle_words";
    $pwresult = run_sql($sql);
    $array["puzzle_words"] = $pwresult->num_rows;

    $sql = "SELECT * FROM words";
    $wresult = run_sql($sql);
    $array["words"] = $wresult->num_rows;

    $sql = "SELECT * FROM characters";
    $cresult = run_sql($sql);
    $array["characters"] = $cresult->num_rows;

    $sql = "SELECT * FROM users";
    $uresult = run_sql($sql);
    $array["users"] = $uresult->num_rows;


    /* Report that displays total number of words used for the puzzle */
    $arrData = array("chart" => array(
        "caption" => "Words Breakdown",
        "startingangle" => "120",
        "showlabels" => "0",
        "showlegend" => "1",
        "enablemultislicing" => "0",
        "slicingdistance" => "15",
        "showpercentvalues" => "1",
        "showpercentintooltip" => "0",
        "theme" => "ocean"
    ));

    $arrData["data"] = array();

    // Push the data into the array
    array_push($arrData["data"], array(
        "label" => "Words used in Puzzles",
        "value" => $pwresult->num_rows
    ));
    array_push($arrData["data"], array(
        "label" => "Unused words",
        "value" => $wresult->num_rows - $pwresult->num_rows
    ));

    /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */
    $jsonEncodedData = json_encode($arrData);

    //Create an object for the column chart using the FusionCharts PHP class constructor.
    echo '<div id="chart1">';
    $columnChart = new FusionCharts("Pie2D", "wordsChart", 600, 300, "chart1",
        "json", $jsonEncodedData);
    echo $columnChart->render(); // Render the chart
    echo '</div>';


    /* Report that displays total number of rows for each tables in the database */
    $arrData = array("chart" => array(
        "caption" => "Database Report",
        "paletteColors" => "#0075c2",
        "bgColor" => "#ffffff",
        "borderAlpha" => "20",
        "canvasBorderAlpha" => "0",
        "usePlotGradientColor" => "0",
        "plotBorderAlpha" => "10",
        "showXAxisLine" => "1",
        "xAxisLineColor" => "#999999",
        "showValues" => "0",
        "divlineColor" => "#999999",
        "divLineIsDashed" => "1",
        "showAlternateHGridColor" => "0"
    ));

    $arrData["data"] = array();

    // Push the data into the array
    foreach ($array as $key => $value) {
        array_push($arrData["data"], array(
                "label" => $key,
                "value" => $value
            )
        );
    }

    /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */
    $jsonEncodedData = json_encode($arrData);

    //Create an object for the column chart using the FusionCharts PHP class constructor.
    echo '<br><div id="chart2">';
    $columnChart = new FusionCharts("column2D", "databaseReport", 600, 300, "chart2",
        "json", $jsonEncodedData);
    echo $columnChart->render(); // Render the chart
    echo '</div>';


    /* Report that displays number of words entry that do not have images */

    $sql = "SELECT * FROM words where words.image = ''";
    $result = run_sql($sql);
    $noimageWords = $result->num_rows;

    $arrData = array("chart" => array(
        "caption" => "Words Image Report",
        "startingangle" => "120",
        "showlabels" => "0",
        "showlegend" => "1",
        "enablemultislicing" => "0",
        "slicingdistance" => "15",
        "showpercentvalues" => "1",
        "showpercentintooltip" => "0"
    ));

    $arrData["data"] = array();

    // Push the data into the array
    array_push($arrData["data"], array(
        "label" => "Words with no image",
        "value" => $noimageWords
    ));
    array_push($arrData["data"], array(
        "label" => "Words with Image",
        "value" => $wresult->num_rows - $noimageWords
    ));

    /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */
    $jsonEncodedData = json_encode($arrData);

    //Create an object for the column chart using the FusionCharts PHP class constructor.
    echo '<br><div id="chart3">';
    $columnChart = new FusionCharts("Pie3D", "wordImageChart", 600, 300, "chart3",
        "json", $jsonEncodedData);
    echo $columnChart->render(); // Render the chart
    echo '</div>';

    ?>
</div>
</body>
</html>
