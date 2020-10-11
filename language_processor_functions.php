<?php
	require('./IndicTextAnalyzer/word_processor.php');
	function getWordChars($word)
	{
		$letters = new wordProcessor($word,"");
		$logicalChars = $letters->getLogicalChars();
		return $logicalChars;
	}

	function getWordLength($word)
	{
		$length = new wordProcessor($word, "");
		$getLength = $length->getLength();
		return $getLength;
	}
?>