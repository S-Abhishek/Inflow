<?php
   // require("../includes/dbh.inc.php");
   // session_start();

   require("../includes/config.php");
   $id = $_SESSION['u_id'];

   if($_GET['data']=='count')
   {
         $src = $_GET['s'];
         $dst = $_GET['d'];

         $sql = "UPDATE U".$id."count ".
         		  " SET id=0".
         		  " WHERE id=".$src.";";

         mysqli_query($conn,$sql);

         $sql = "UPDATE U".$id."count".
         		  " SET id=".$src.
         		  " WHERE id=".$dst.";";
          mysqli_query($conn,$sql);

         $sql = "UPDATE U".$id."count".
         		  " SET id=".$dst.
         		  " WHERE id=0;";

         mysqli_query($conn,$sql);
      }

  if($_GET['data']=='check')
  {
    $t = $_GET['id'];
    $sql = "UPDATE U".$id."check".
           " SET priority=-1 WHERE id = '".$t."';";
            echo $sql;

            if(mysqli_query($conn,$sql))
              echo "yes";
  }


    
?>