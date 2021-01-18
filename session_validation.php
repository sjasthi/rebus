<?php
require_once 'includes/session_start.php';
require_once 'user_sessions.php';

	/**
	 * Returns true if user has a valid
	 * session else false
	 */
	function sessionExists() {
		return is_logged_in();
	}
	/**
	 * Returns true if user has a valid session
	 * and if the user is an admin
	 */
	function adminSessionExists() {
		return is_admin();
	}
	/**
	 * Generates topnav to display admin topnav
	 * if admin is logged in else displays
	 * normal navbar
	 */
	function getTopNav() {
		require_once 'includes/session_start.php';
		$topNav = "";
		if (adminSessionExists()) {
			$topNav = '<nav class="navbar navbar-default" role="navigation" style="background-color: transparent;">
			<div class="container">
			<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button><a href="./index.php"><img class="logo" src="./pic/logo.png" /></a>
			<div class="name-wrapper"><font class="nav-font">REBUS</font>
			</div></div>
			<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav" style="float: right;">
				<li>
					<a href="./admin.php"><button id="admin" class="navOption">Admin</button></a>
				</li>
				<li>
					<a href="./puzzle_list.php"><button id="list" class="navOption">List</button></a>
				</li>
				<li>
					<a href="./about.php"><button id="addword" class="navOption">About</button></a>
				</li>
				<!--<li>
					<a href="./addWordPair.php"><button id="addpuzzle" class="navOption">Add<br> Word<br> Pairs</button></a>
				</li> -->
				<li> 
					<a href="./logout.php"><button id="logout" name ="logout" class="navOption">Logout</button></a>
				</li>
			</ul>
			</div><!--.nav-collapse --></div></nav>';
		}
		else if (sessionExists()) {
			$topNav = '<nav class="navbar navbar-default" role="navigation" style="background-color: transparent;">
			<div class="container">
			<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span><span class="icon-bar"></span>
			<span class="icon-bar"></span><span class="icon-bar"></span>
			</button><a href="./index.php"><img class="logo" src="./pic/logo.png" /></a>
			<div class="name-wrapper"><font class="nav-font">REBUS</font>
			</div></div><div class="collapse navbar-collapse">
			<ul class="nav navbar-nav" style="float: right;">
			<li>
				<a href="./puzzle_list.php"><button id="list" class="navOption">List</button></a>
			</li>
			<li>
				<a href="./about.php"><button id="addword" class="navOption">About</button></a>
			</li>
			<!--<li>
				<a href="./addWordPair.php"><button id="addpuzzle" class="navOption">Add<br> Word<br> Pairs</button></a>
			</li> -->
			<li>
				<a href="./logout.php"><button id="logout" name ="logout" class="navOption">Logout</button></a>
			</li>
			</ul></div><!--.nav-collapse --></div></nav>';
		}
		else{
			$topNav = '<nav class="navbar navbar-default" role="navigation" style="background-color: transparent;">
			<div class="container">
			<div class="navbar-header"><button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
			<a href="./index.php"><img class="logo" src="./pic/logo.png" /></a>
			<div class="name-wrapper">
			<font class="nav-font">REBUS</font>
			</div>
			</div>
			<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav" style="float: right;">
			<li>
				<a href="./puzzle_list.php"><button id="list" class="navOption">List</button></a>
			</li>
			<li>
				<a href="./about.php"><button id="addword" class="navOption">About</button></a>
			</li>
			<!--<li>
				<a href="./addWordPair.php"><button id="addpuzzle" class="navOption">Add<br> Word<br> Pairs</button></a>
			</li> -->
			<li>
				<a href="' . LOGIN_LINK . '"><button id="login" class="navOption">Login</button></a>
			</li>
			</ul>
			</div>
			<!--.nav-collapse -->
			</div>
        </nav>';
		}
		return $topNav;
	}

	function puzzleNav(){ 

		$puzzleNav = '<div style="width: 100%; background-color: #92d050; text-align: center;"><img src="./pic/logo.png" style="height: 190px; width:auto; cursor: pointer;" onclick="showHideOptions()"> </div><br>';
		return $puzzleNav;
	}
?>
