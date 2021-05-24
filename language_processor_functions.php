<?php
	require_once 'includes/indic-wp.php';
	function getWordChars($word)
	{
		$letters = new wordProcessor($word,"Telugu");
		$logicalChars = $letters->getLogicalChars();
		return $logicalChars;
	}

	function getWordLength($word)
	{
		$length = new wordProcessor($word, "Telugu");
		$getLength = $length->getLength();
		return $getLength;
	}
?>