<?php

	require("../includes/config.php");
	
	if(isset($_SESSION['u_id']))
	{

			render("body.php", NULL, ["title" => "Dashboard"]);
	}
	else
	{
		if(isset($_GET["signup_social"]))
			render("forms.php", "userid_form.php", ["title" => "Dashboard"]);
		else
			render("forms.php", NULL, ["title"=>"Forms"]);
		// include("../views/forms.php");
	}
?>


