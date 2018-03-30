<?php
	require("../includes/config.php");
	// echo "Hi3";
	// print_r($_POST);
	if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        // redirect("index.php");
       	// echo "hi";
       	// echo $_SERVER['HTTP_REFERER'];

       			$config   = 'config.php';
				require '../vendor/autoload.php';
				// require_once( "library/Hybrid/Auth.php" );
		 
				// initialize Hybrid_Auth class with the config file
				$hybridauth = new Hybrid_Auth($config);
       			$url = $hybridauth->getCurrentUrl();
    //    			echo $url."<br>";
    //    			echo $_SERVER['PHP_SELF']."<br>";
    //    			echo $_SERVER['REQUEST_URI'];

       			if($url == "http://inflowapp.azurewebsites.net/login.php?provider=Google")
       			{
       				$provider_name = "Google";
       				goto getinfo;
       			}
       			else if($url == "http://inflowapp.azurewebsites.net/login.php?provider=Facebook")
       			{
       				$provider_name = "Facebook";
       				goto getinfo;
       			}
       			else
					redirect("/index.php");

// foreach (explode('#', $query) as $chunk) {
//     // $param = explode("=", $chunk);
//     $param = $chunk;

//     if ($param) {
//         printf("Value for parameter \"%s\" is %s <br/>\n", urldecode($param[0]), urldecode($param[1]));
//     }
// }

    }
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
    	if (isset($_POST['submit1'])) 
		{
			//include 'dbh.inc.php';

		   	$uid=mysqli_real_escape_string($conn,$_POST['uid']);
			$pwd=mysqli_real_escape_string($conn,$_POST['pwd']);
			//Error handlers
			//Check if inputs empty
			if(empty($uid) || empty($pwd))
			{
					header("Location: ../index.php?login=empty");
					exit();
			}
			else
			{
				$sql1="SELECT * FROM user WHERE user_uid='$uid' OR user_email='$uid'";

				$result1=mysqli_query($conn,$sql1);
				$resultCheck=mysqli_num_rows($result1);
				if ($resultCheck<1) 
				{

					header("Location: ../index.php?login=error");
					exit();
				}
				else
				{
					$row1 = mysqli_fetch_assoc($result1);
					$id = $row1["user_id"];
					$sql2="SELECT * FROM user_local WHERE user_id='$id';";
					$result2=mysqli_query($conn,$sql2);
					// if(!$result2)
					// 	echo "hmm";
					if ($row=mysqli_fetch_assoc($result2)) 
					{

						//De-hashing

						// print_r($row);

						$hashedpwdcheck=password_verify($pwd,$row['user_pwd']);
						if($hashedpwdcheck == false)
						{
							// echo "hihi";
							header("Location: ../index.php?login=error");
							exit();
						}
						elseif ($hashedpwdcheck==true) 
						{
							//Log in the user here
							$_SESSION['u_id']=$row1['user_id'];
							$_SESSION['u_first']=$row1['user_first'];
							$_SESSION['u_last']=$row1['user_last'];
							$_SESSION['u_email']=$row1['user_email'];
							$_SESSION['u_uid']=$row1['user_uid'];
							
							//header("Location:../index.php");
							// print_r($row);
							redirect("/index.php");
							exit();
						}
					}
				}
			}
		}
		else if(isset($_POST["provider"]))
		{
			// the selected provider
			// echo "Hi";
			$provider_name = $_POST["provider"];
			// echo $provider_name;
		 	getinfo:
			try
			{
				// inlcude HybridAuth library
				// change the following paths if necessary
				$config   = 'config.php';
				require '../vendor/autoload.php';
				// require_once( "library/Hybrid/Auth.php" );
		 
				// initialize Hybrid_Auth class with the config file
				$hybridauth = new Hybrid_Auth($config);

		 
				// try to authenticate with the selected provider
				$adapter = $hybridauth->authenticate( $provider_name );

				// exit();

				// echo $provider_name;
		 
				// then grab the user profile
				$user_profile = $adapter->getUserProfile();
			}
		 
			// something went wrong?
			catch(Exception $e)
			{
				header("Location: ../index.php?login=error_social");
				// header("Location: http://www.example.com/login-error.php");
			}
		 
			// check if the current user already have authenticated using this provider before
			// $user_exist = get_user_by_provider_and_id($provider_name, $user_profile->identifier );
			$sql= "SELECT * FROM user_social WHERE provider_name = '$provider_name' AND provider_uid = '$user_profile->identifier'";
			$user_exist = mysqli_query($conn, $sql);

			$num_rows = mysqli_num_rows($user_exist);
		 
			// if the used didn't authenticate using the selected provider before
			// we create a new entry on database.users for him
			if( !$num_rows )
			{
				// render("reset_psw_form.php", ["title" => "Reset Password"]);


				$_SESSION["provider_name"] = $provider_name;
				$_SESSION["identifier"] = $user_profile->identifier;

				$_SESSION["firstName"] = $user_profile->firstName;
				$_SESSION["lastName"] = $user_profile->lastName;
				$_SESSION["email"] = $user_profile->email;
			

				// echo "Hi";

				// echo $user_profile->email;
				// echo $user_profile->firstName;
				// echo $user_profile->lastName;

				render("userid_form.php",NULL, ["email" => $user_profile->email, "firstName" => $user_profile->firstName, "lastName" => $user_profile->lastName, "flag"=>1]);
				exit();




				// create_new_hybridauth_user(
				// 	$user_profile->email,
				// 	$user_profile->firstName,
				// 	$user_profile->lastName,
				// 	$provider_name,
				// 	$user_profile->identifier
				// );
			}

			$row1 = mysqli_fetch_assoc($user_exist);

			// print_r($row1);
			$id = $row1['user_id'];

			$sql1="SELECT * FROM user WHERE user_id='$id'";
			$result1=mysqli_query($conn,$sql1);

			$row1 = mysqli_fetch_assoc($result1);
		 
			// set the user as connected and redirect him
			//Log in the user here
			$_SESSION['u_id']=$row1['user_id'];
			$_SESSION['u_first']=$row1['user_first'];
			$_SESSION['u_last']=$row1['user_last'];
			$_SESSION['u_email']=$row1['user_email'];
			$_SESSION['u_uid']=$row1['user_uid'];

			// echo "Hee";
			// echo $_SESSION['u_id'];

			redirect("/index.php");
			exit();
		 
			// header("Location: http://www.example.com/user/home.php");
		}	
		else
		{

// echo $_GET["provider"];
			redirect("/index.php");
			// echo "Hi2";
		}
    }

	

?>
