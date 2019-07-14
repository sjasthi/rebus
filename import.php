<?php 
	header( 'Content-Type: text/html; charset=utf-8' );
	require('InsertUtil.php');
	require('DeleteUtil.php');
	include './PHPExcel/PHPExcel/IOFactory.php';
	
	$error = false;
	$result = "";

	if(isset($_POST['submit'])){

		//function to delete all data except for users table from the db. 
		deleteAllData();
				
		$inputFileName = $_FILES["fileToUpload"]["tmp_name"];
		
		try {
			$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load($inputFileName);
		} catch (Exception $e) {
			die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) 
			. '": ' . $e->getMessage());
		}

		$sheet = $objPHPExcel->getSheet(0);
		$highestRow = $sheet->getHighestRow();
		$highestColumn = $sheet->getHighestColumn();
  		
		for ($row = 2; $row <= $highestRow; $row++) {
			//  Read the row of data into an array
			$word = $sheet->getCell('A' . $row )->getValue();
			$english_word = $sheet->getCell('B'.$row)->getValue();
			$image = $sheet->getCell('C'.$row)->getValue();

			// to remove invalid character eg: \u00a0
            $word = validate_word($word);
            $english_word = validate_input($english_word);
            $image = validate_input($image);

//			var_dump($word);
//			var_dump($english_word);
//			var_dump($image);

			// Insert new data into Words & Characters Table
			insertIntoWordsTable($word, $english_word, $image);
			//insertIntoCharactersTable($word);
		}
		echo '<h2 style="color:	green;" class="upload">Import Successful!</h2>';
	}


?>
