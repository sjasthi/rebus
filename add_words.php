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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="javascript/typeahead.min.js"></script>
    <link rel="stylesheet" href="styles/custom_nav.css" type="text/css">
    <title>Rebus Add Word</title>
	
	<style>	
		.addResult {
            display: none;
		}
			
		.mainText {
			font-size: 1.5em;
		}

		.form-control {
			border: 1px solid black;
		}
	</style>	
</head>
<body>
<?php
require('db_configuration.php');
require('InsertUtil.php');
?>
<?PHP echo getTopNav(); ?>
<div id="pop_up_fail" class="container pop_up" style="display:none">
    <div class="pop_up_background">
        <img class="pop_up_img_fail" src="pic/info_circle.png">
        <div class="pop_up_text">Incorrect! <br>Try Again!</div>
        <button class="pop_up_button" onclick="toggle_display('pop_up_fail')">OK</button>
    </div>
</div>


<div>
    <br/>
	<?php
		$words = [];
	?>
    <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">	
		<div class="row">
			<div class="text-center">
				<input class="btn btn-primary btn-lg" type="submit" value="Add" name="submit"/>
			</div>
		</div>			
	    <br/>
		<table class="table table-condensed main-tables" id="word_table" style="margin-left: 5%">
			<thead>
			<tr>
				<th>Word</th>
				<th>English Word</th>
				<th>Image Thumbnail</th>
			</tr>
			</thead>
			<tbody>
				<tr>
            		<td><textarea class="form-control" name="words[]" id="name" cols="30" rows="2"></textarea></td>
					<!-- <td><input type="textbox" name="words[]" id="name"/></td> -->
					<td><input type="textbox" name="eng_words[]" id="eng_word"/></td>
					<td><input class="upload" type="file" name="filesToUpload[]" id="fileToUpload"/></td>
				</tr>
				<tr>
				<td><textarea class="form-control" name="words[]" id="name" cols="20" rows="2"></textarea></td>
					<!-- <td><input type="textbox" name="words[]" id="name"/></td> -->
					<td><input type="textbox" name="eng_words[]" id="eng_word"/></td>
					<td><input class="upload" type="file" name="filesToUpload[]" id="fileToUpload"/></td>
				</tr>
				<tr>
					<td><textarea class="form-control" name="words[]" id="name" cols="20" rows="2"></textarea></td>
					<!-- <td><input type="textbox" name="words[]" id="name"/></td> -->
					<td><input type="textbox" name="eng_words[]" id="eng_word"/></td>
					<td><input class="upload" type="file" name="filesToUpload[]" id="fileToUpload"/></td>
				</tr>

				<tr>
					<td><textarea class="form-control" name="words[]" id="name" cols="20" rows="2"></textarea></td>
					<!-- <td><input type="textbox" name="words[]" id="name"/></td> -->
					<td><input type="textbox" name="eng_words[]" id="eng_word"/></td>
					<td><input class="upload" type="file" name="filesToUpload[]" id="fileToUpload"/></td>
				</tr>
				<tr>
					<td><textarea class="form-control" name="words[]" id="name" cols="20" rows="2"></textarea></td>
					<!-- <td><input type="textbox" name="words[]" id="name"/></td> -->
					<td><input type="textbox" name="eng_words[]" id="eng_word"/></td>
					<td><input class="upload" type="file" name="filesToUpload[]" id="fileToUpload"/></td>
				</tr>
				<tr>
					<td><textarea class="form-control" name="words[]" id="name" cols="20" rows="2"></textarea></td>
					<!-- <td><input type="textbox" name="words[]" id="name"/></td> -->
					<td><input type="textbox" name="eng_words[]" id="eng_word"/></td>
					<td><input class="upload" type="file" name="filesToUpload[]" id="fileToUpload"/></td>
				</tr>
				<tr>
					<td><textarea class="form-control" name="words[]" id="name" cols="20" rows="2"></textarea></td>
					<!-- <td><input type="textbox" name="words[]" id="name"/></td> -->
					<td><input type="textbox" name="eng_words[]" id="eng_word"/></td>
					<td><input class="upload" type="file" name="filesToUpload[]" id="fileToUpload"/></td>
				</tr>
				<tr>
					<td><textarea class="form-control" name="words[]" id="name" cols="20" rows="2"></textarea></td>	
					<!-- <td><input type="textbox" name="words[]" id="name"/></td> -->
					<td><input type="textbox" name="eng_words[]" id="eng_word"/></td>
					<td><input class="upload" type="file" name="filesToUpload[]" id="fileToUpload"/></td>
				</tr>
				<tr>
					<td><textarea class="form-control" name="words[]" id="name" cols="20" rows="2"></textarea></td>
					<!-- <td><input type="textbox" name="words[]" id="name"/></td> -->
					<td><input type="textbox" name="eng_words[]" id="eng_word"/></td>
					<td><input class="upload" type="file" name="filesToUpload[]" id="fileToUpload"/></td>
				</tr>
				<tr>
					<td><textarea class="form-control" name="words[]" id="name" cols="20" rows="2"></textarea></td>
					<!-- <td><input type="textbox" name="words[]" id="name"/></td> -->
					<td><input type="textbox" name="eng_words[]" id="eng_word"/></td>
					<td><input class="upload" type="file" name="filesToUpload[]" id="fileToUpload"/></td>
				</tr>

<?php
			if (isset($_POST['submit'])) {
				$words = [];
				$engWords = [];
				$filesToUpload = [];
							
				if (isset($_POST['words'])) {
					$words = $_POST['words'];
				}

				if (isset($_POST['eng_words'])) {
					$engWords = $_POST['eng_words'];
				}
		
 				foreach ($words as $i => $word) {
					 //echo "this is i: $i and this is: $word and this is words: $words";
//					echo($i.'|'.$word.'|'.$engWords[$i].PHP_EOL);
					$splitWords = $word; //Remove dot at end if exists
					$splitWords = preg_replace('/\s+/', '', $splitWords);
					$array = explode(',', $splitWords); //split string into array seperated by ', '
					//print_r($array);
					if (!empty($words[$i])) {
						$engWord = $engWords[$i];
						
						//if (isset($_POST['fileToUpload'])) {

						$imageName = "";
						$inputFileName = $_FILES["filesToUpload"]["tmp_name"][$i];
						//echo $inputFileName;

						$target_dir = "./Images/";
						$imageName = basename($_FILES["filesToUpload"]["name"][$i]);
						$target_file = $target_dir . $imageName;
						$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
						
						//echo $imageName;
//	BUG!:  This does a destructive overwrite if there happens to be an image file named <$imageName> in the ./Images/ path						
						if (!empty($imageName)) {
							copy($inputFileName, $target_file);
						}
						foreach($array as $value) //loop over values
						{
							// $tcount = parseToLogicalCharacters($value);
							// $len = count($tcount);
							// $processor = new wordProcessor($value, 'telugu');
							// $strength = $processor->getWordStrength('telugu');
							// $processor2 = new wordProcessor($value, 'telugu');
							// $weight = $processor2->getWordWeight('telugu');

							echo '"' . $value . '": '; //print value
							insertIntoWordsTable($value, $engWord, $imageName);
							// insertLengthStrengthWeightLevel($value, $len, $strength, $weight)
							echo '<br>';
						}
						
					}
				} 
			}
			?>
			<script>
				function validateForm() {
					var eng = document.forms["importFrom"]["filesToUpload"].value;
					if (eng == "") {
						document.getElementById("error").style = "display:block;background-color: #ce4646;padding:5px;color:#fff;";
						return false;
					}
				}

/* 				function AddTableRows() {
					alert("add rows");
					// Find a <table> element with id="myTable":
					var table = document.getElementById("myTable");

					// Create an empty <tr> element and add it to the 1st position of the table:
					var row = table.insertRow(git);
				}
 */				

			</script>
			</tbody>
		</table>
    </form>	
</div>
</body>
</html>
