<?php

	require("../includes/config.php");
	
	render("stats_form.php", NULL, ["title" => "Statistics"]);
	// if(isset($_SESSION['u_id']))
	// {

	// 	render("stats_form.php", ["title" => "Statistics"]);

	// }
	// else
	// {
	// 	redirect("/index.php");
	// }
?>