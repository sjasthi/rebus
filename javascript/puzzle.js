	function submit_validation()
	{
		var words = "<?php echo $words ?>";
		alert(words);
		var wordsArray = words.split(",");
		var table = document.getElementById("puzzle_table");
		var tableLength = table.rows.length;
		var words_correct = true;
		var childrenLength = 0;
		
		for (var i = 1; i < tableLength; i++)
		{
			var word = "";
			childrenLength = table.rows[i].cells[1].children.length;
			for (var j = 0; j < childrenLength; j++)
			{
				word += table.rows[i].cells[1].children[j].value;
			}
			
			if(wordsArray[(i-1)] != word)
			{
				words_correct = false;
			}
        }
		if(words_correct) // success case
		{
			//alert("Sucess!");
			var el = document.getElementById("succes_photo");
			el.style.display = "block";
		}
		else{ // failure case
			var el = document.getElementById("pop_up_fail");
			el.style.display = "block";
			clear_puzzle();
		}
	}
	
	function show_solution()
	{
		var words = "<?php echo $words ?>";
		var wordsArray = words.split(",");
		var table = document.getElementById("puzzle_table");
		var tableLength = table.rows.length;
	
		var childrenLength = 0;
		
		for (var i = 1; i < tableLength; i++)
		{
			childrenLength = table.rows[i].cells[1].children.length;
			for (var j = 0; j < childrenLength; j++)
			{
				table.rows[i].cells[1].children[j].value = wordsArray[(i-1)].substring(j, (j+1));
			}
        }
	}
	
	function clear_puzzle()
	{
		var table = document.getElementById("puzzle_table");
		var tableLength = table.rows.length;
		var childrenLength = 0;
		
		for (var i = 1; i < tableLength; i++)
		{
			childrenLength = table.rows[i].cells[1].children.length;
			for (var j = 0; j < childrenLength; j++)
			{
				
				if(!(table.rows[i].cells[1].children[j].className.includes("active")))
				{
					table.rows[i].cells[1].children[j].value = "";
				}
			}
        }
	}
	
		function toggle_display(o) {
		var el = document.getElementById(o);
		el.style.display = "none";
	}