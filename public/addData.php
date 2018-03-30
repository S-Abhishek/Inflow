<?php 

	require("../includes/dbh.inc.php");
	require("../includes/config.php");

	$id = $_SESSION['u_id'];

	if($_GET['data']=='count'){

		$t = $_GET['titl'];
		$date = $_GET['d'];
		$time = $_GET['t'];
		$type = $_GET['typ'];

		$type = implode(" ", explode("-",$type));

		$sql = "INSERT INTO U".$id."count(title,deadline,type)".
			   " values('".$t."','".$date." ".$time."','".$type."');";

	}
	if($_GET['data']=='check'){

		$t = $_GET['title'];
		$t = implode(" ", explode("-",$t));
		$p = $_GET['pri'];
		$tag = $_GET['tag'];
		$sql = "INSERT INTO U".$id."check(title,priority,tag)".
				" values('".$t."',".$p.",'".$tag."');";
	}
	if($_GET['data']=='tag'){
		$t = $_GET['tag'];
		$t = implode(" ", explode("-",$t));
		$sql = "INSERT INTO U".$id."tags(name)".
				" values('".$t."');";
	}
	if($_GET['data']=='count1')
	{

		$t = $_GET['titl'];
		$date = $_GET['d'];
		$time = $_GET['t'];
		$sql = "INSERT INTO U".$id."sch(title,datee,timee)".
			   " values('".$t."','".$date."','".$time."');";

			   

	}

    mysqli_query($conn,$sql);

    $sql2 = "SELECT LAST_INSERT_ID()";

    echo mysqli_fetch_array(mysqli_query($conn,$sql2))[0];

  ?>
   


