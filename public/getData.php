<?php
	require("../includes/dbh.inc.php");
	require("../includes/config.php");

	$id = $_SESSION['u_id'];

	if($_GET['data']=='count'){

		$sql = "SELECT * from U".$id."count;";
			
	}

	if($_GET['data']=='check'){

		$sql = "SELECT * from U".$id."check;";
	}

	if($_GET['data']=='tags'){

		$sql = "SELECT * from U".$id."tags;";
	}
	if($_GET['data']=='checkd')
	{
		$sql="SELECT * from U".$id."sch WHERE datee=CURDATE();";
	}
	$arr = array();
	$result = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_assoc($result))
		array_push($arr,$row);
	echo json_encode($arr);
?>