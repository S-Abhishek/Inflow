<?php
	// usage of require is more suitable
	require("../includes/config.php");
	/*this if statement is done so that  the user cannot directly use the url to see the php code , with name "submit" whether its clicked or not*/
	if (isset($_POST['submit'])) 
	{
		//include_once 'dbh.inc.php'; 
		/*this is to make sure that they dont write code inside the block*/
		$first=mysqli_real_escape_string($conn,$_POST['first']);
		$last=mysqli_real_escape_string($conn,$_POST['last']);
		$email=mysqli_real_escape_string($conn,$_POST['email']);
		$uid=mysqli_real_escape_string($conn,$_POST['uid']);
		// $pwd=mysqli_real_escape_string($conn,$_POST['pwd']);

		//Error handlers
		//Check if everything filled out
		$flag_pwd = 0;
		$flag_social = 0;
		if(!isset($_POST["flag"]))
		{
				if(empty($pwd))
					$flag_pwd = 1;
			$pwd=mysqli_real_escape_string($conn,$_POST['pwd']);
		}
		else
		{
			$flag_social=1;
		}
		// echo $flag_social . "<br>";
		// echo !isset($_POST["flag"]);
		if (empty($first) ||  empty($email) ||  empty($uid) || $flag_pwd) 
		{
				/*redirection*/
			if($flag_social == 0)
				header("Location: ../index.php?signup=empty");
			else
			{
				echo $first, $email, $uid, $flag_pwd;
				// header("Location: ../index.php?signup_social=empty");
				exit();
			}
			echo "Hi";
			exit(); /*closes the script*/

		}
		else
		{
			//check if input characters are valid
			if (!preg_match("/^[a-zA-Z]*$/",$first) ||!preg_match("/^[a-zA-Z\s]*$/",$last))
			{
				if($flag_social == 0)
					header("Location: ../index.php?signup=invalid");
				else
					header("Location: ../index.php?signup_social=invalid");
				exit(); /*closes the script*/
			}
			else
			{
				//check if email is valid
				if (!filter_var($email,FILTER_VALIDATE_EMAIL))
				{
					if($flag_social == 0)
						header("Location: ../index.php?signup=email");
					else
						header("Location: ../index.php?signup_social=email");
					exit(); /*closes the script*/
				} 
				/*else
				{
					$sql="SELECT * FROM user WHERE user_uid='$uid'";
					$result=mysqli_query($conn,$sql);
					$resultCheck=mysqli_num_rows($result);

					if ($resultCheck >0) 
					{
						header("Location: ../signup.php?signup=email");
						exit(); //closes the script
					} 
					else
					{
						//hashing the password 
						$hashedpwd=password_hash($pwd,PASSWORD_DEFAULT);
						//insert the user into the database
						$sql="INSERT into user (user_first,user_last,user_email,user_uid,user_pwd) VALUES ('$first','$last','$email','$uid','$hashedpwd');";
						mysqli_query($conn,$sql);
						$row=mysqli_fetch_assoc($result);
						//header("Location: ../signup.php?signup=success");
						$_SESSION['u_id']=$row['user_id'];
						$_SESSION['u_first']=$row['user_first'];
						$_SESSION['u_last']=$row['user_last'];
						$_SESSION['u_email']=$row['user_email'];
						$_SESSION['u_uid']=$row['user_uid'];

						header("Content-type: application/json");
    					print(json_encode($row, JSON_PRETTY_PRINT));
						//echo $_SESSION['u_id'];
						//redirect("/index.php");
					}
				}*/
				
				// more succint way of doing the above operation
				else
				{
				    
				    // $sql ="CREATE TABLE IF NOT EXISTS `user` (
        //                   `user_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        //                   `user_first` varchar(50) NOT NULL,
        //                   `user_last` varchar(50) NOT NULL,
        //                   `user_email` varchar(50) NOT NULL UNIQUE,
        //                   `user_uid` varchar(50) NOT NULL UNIQUE,
        //                   `user_pwd` varchar(250) NOT NULL
        //                 ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

						$sql ="CREATE TABLE IF NOT EXISTS `user` (
                          `user_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                          `user_first` varchar(50) NOT NULL,
                          `user_last` varchar(50) NOT NULL,
                          `user_email` varchar(50) NOT NULL UNIQUE,
                          `user_uid` varchar(50) NOT NULL UNIQUE,
                        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
                        
                    mysqli_query($conn,$sql);
                    
					//hashing the password 
					// $hashedpwd=password_hash($pwd,PASSWORD_DEFAULT);

					$sql="INSERT IGNORE into user (user_first,user_last,user_email,user_uid)VALUES('$first','$last','$email','$uid');";
					mysqli_query($conn,$sql);
					$row = mysqli_affected_rows($conn);
					if($row != 1)
					{
						if($flag_social == 0)
							header("Location: ../index.php?signup=exists");// throw error - username/email already exists
						else
						{
							$sql = "SELECT * FROM user WHERE user_uid = '$uid';";
							$result = mysqli_query($conn,$sql);

							$result1 = $result;

							$row = mysqli_fetch_assoc($result);

							$num_rows = mysqli_num_rows($result1);
							// username already exists and email id does not exist
							if($num_rows > 0 && $row["user_email"] != $email)
								header("Location: ../index.php?signup_social=exists");
							else if($num_rows == 0)
							{
								$sql = "SELECT user_email FROM user WHERE user_email = '$email';";
								$result = mysqli_query($conn,$sql);

								$num_rows_1 = mysqli_num_rows($result);

								// email already associated with another username
								if($num_rows_1 > 0)
									// render("userid_form.php",["title" => "Signup", "signup_social" => "one", "error" => "email_exists"]);
									header("Location: ../index.php?signup_social=email_exists");

							}
							// email already exists(=> already registered as local user) - merge local and social
							else
							{
								$sql = "CREATE TABLE IF NOT EXISTS `user_social` (
								  `provider_uid` varchar(255) NOT NULL,
								  `user_id` int(11) NOT NULL,
								  `provider_name` varchar(255) NOT NULL,
								  FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
								  UNIQUE (`provider_uid`,`provider_name`)
								) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

								mysqli_query($conn, $sql);

								$provider_name = $_SESSION["provider_name"];
								$identifier = $_SESSION["identifier"];

								$sql = "SELECT * FROM user WHERE user_email = '$email';";
			                    $result = mysqli_query($conn,$sql);

			                    $row = mysqli_fetch_assoc($result);
			                    $user_id = (int)$row["user_id"];

								$sql = "INSERT IGNORE into user_social (provider_uid, user_id, provider_name)
									VALUES('$identifier', $user_id, '$provider_name');";

								mysqli_query($conn, $sql);

								$_SESSION['u_id']=$row['user_id'];
								$_SESSION['u_first']=$row['user_first'];
								$_SESSION['u_last']=$row['user_last'];
								$_SESSION['u_email']=$row['user_email'];
								$_SESSION['u_uid']=$row['user_uid'];

								redirect("/index.php");
								// echo "Here1";

								// redirect("/index.php");
							}
						}
					}
					else
					{
						$sql = "SELECT user_id FROM user WHERE user_email = '$email';";
	                    $result = mysqli_query($conn,$sql);

	                    $row = mysqli_fetch_assoc($result);

						$user_id = (int)$row["user_id"];
						if($flag_social == 0)
						{
							$sql ="CREATE TABLE IF NOT EXISTS `user_local` (
	                          `user_id` int(11) NOT NULL PRIMARY KEY,
	                          `user_pwd` varchar(250) NOT NULL,
	                          FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
	                        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

	                        mysqli_query($conn,$sql);

	                        // $sql = "SELECT user_id FROM user WHERE user_email = '$email';";
	                        // $result = mysqli_query($conn,$sql);

	                        // $row = mysqli_fetch_assoc($result);

	                        // $user_id = (int)$row["user_id"];
	                        // echo $user_id;

	                        $hashedpwd=password_hash($pwd,PASSWORD_DEFAULT);
	                        
	                        $sql="INSERT IGNORE into user_local (user_id,user_pwd)VALUES($user_id,'$hashedpwd');";
							mysqli_query($conn,$sql);
						}
						else
						{
							$sql = "CREATE TABLE IF NOT EXISTS `user_social` (
							  `provider_uid` varchar(255) NOT NULL,
							  `user_id` int(11) NOT NULL,
							  `provider_name` varchar(255) NOT NULL,
							  FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
							  UNIQUE (`provider_uid`,`provider_name`)
							) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

							mysqli_query($conn, $sql);

							$provider_name = $_SESSION["provider_name"];
							$identifier = $_SESSION["identifier"];


							$sql = "INSERT IGNORE into user_social (provider_uid, user_id, provider_name)
								VALUES('$identifier', $user_id, '$provider_name');";

							mysqli_query($conn, $sql);

							// $sql ="CREATE TABLE IF NOT EXISTS `user_local` (
							//   `provider_uid` varchar(255) NOT NULL,
	      //                     `user_id` int(11) NOT NULL,
	      //                     `provider_name` varchar(255) NOT NULL,
	      //                      FOREIGN KEY () REFERENCES parent(id)
	      //                   ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
						}
                        
                    	// mysqli_query($conn,$sql);

						$sql="SELECT * FROM user WHERE user_uid='$uid'";
						$result=mysqli_query($conn,$sql);	
						$row=mysqli_fetch_assoc($result);
						$sql2 = "CREATE TABLE U".$row['user_id']."count(".
								"id int(4) PRIMARY KEY AUTO_INCREMENT,".
								"title varchar(50),".
								"deadline datetime,".
								"type varchar(20) );";
						mysqli_query($conn,$sql2);
						$sql3 = "CREATE TABLE U".$row['user_id']."check(".
								"id int(4) PRIMARY KEY AUTO_INCREMENT,".
								"title varchar(50),".
								"priority int(1),".
								"tag int(3) );";
						mysqli_query($conn,$sql3);
						$sql2 = "CREATE TABLE U".$row['user_id']."tags(".
								"id int(4) PRIMARY KEY AUTO_INCREMENT,".
								"name varchar(20) UNIQUE );";
						mysqli_query($conn,$sql2);
						$sqls="CREATE TABLE U".$row['user_id']."sch(".
								"id int(4) PRIMARY KEY AUTO_INCREMENT,".
								"title varchar(20),".
								"datee date,".
								"timee time);";
						mysqli_query($conn,$sqls);
						$_SESSION['u_id']=$row['user_id'];
						$_SESSION['u_first']=$row['user_first'];
						$_SESSION['u_last']=$row['user_last'];
						$_SESSION['u_email']=$row['user_email'];
						$_SESSION['u_uid']=$row['user_uid'];

						echo "Here";

						// redirect("/index.php");
					}
				}

			}

		}

	}
	else
	{ 
		// else render form
	    // render("index.php",["title" => "Signup"]);
	    redirect("/index.php");
	}
?>
