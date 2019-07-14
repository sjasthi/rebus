	<?php
		session_start();
		
		if(isset($_SESSION['valid_user'])){
			@ $old_user = $_SESSION['valid_user'];
			unset($_SESSION['valid_user']);
			session_destroy();
		}
		else if (isset($_SESSION['valid_admin'])){
			@ $old_user = $_SESSION['valid_admin'];
			unset($_SESSION['valid_admin']);
			session_destroy();
		}
		else{
		}

		echo "<meta http-equiv=\"refresh\" content=\"0;URL=login.php\">";


  ?>
