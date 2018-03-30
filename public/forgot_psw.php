<?php
	
	 // configuration
    require("../includes/config.php");
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require '../includes/PHPMailer/src/Exception.php';
	require '../includes/PHPMailer/src/PHPMailer.php';
	require '../includes/PHPMailer/src/SMTP.php';
	
// 	echo $_SERVER["SERVER_NAME"];
// 	echo $_SERVER["REQUEST_URI"];

    //$id = $_SESSION['u_id'];
    // echo __DIR__;
    // echo $_SERVER['DOCUMENT_ROOT'];
    // echo $_SERVER['SERVER_NAME'];
    // echo "\n";
    // echo $_SERVER['REQUEST_URI']
    // echo "works";
    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        // echo "Hi0";
        redirect("index.php");
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        // echo $_POST["email"];
        $email = $_POST["email"];
        $sql = "SELECT * FROM user WHERE user_email = '$email';";

        // echo $sql;


        $result = mysqli_query($conn,$sql);

        // print_r($result);

        if($result)
        {
        	if(mysqli_num_rows($result)>0)
        	{
                $rows = mysqli_fetch_assoc($result);
                $user_id = $rows['user_id'];

        		$pwd_result = mysqli_query($conn,"SELECT user_pwd FROM user_local WHERE user_id = '$user_id';");

        		$pwd = mysqli_fetch_assoc($pwd_result);

        		$reset_link = "http://".$_SERVER["SERVER_NAME"]."/reset_psw.php?q=".$pwd['user_pwd']."&q1=".$email;

        		$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
				try 
				{
				    //Server settings
				    $mail->SMTPDebug = 1;                                 // Enable verbose debug output
				    $mail->isSMTP();                                      // Set mailer to use SMTP
				    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
				    $mail->SMTPAuth = true;                               // Enable SMTP authentication
				    $mail->Username = 'inflow.exec@gmail.com';                 // SMTP username
				    $mail->Password = 'inflow@vit';                           // SMTP password
				    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
				    $mail->Port = 587;                                    // TCP port to connect to

				    $mail->SMTPOptions = array(
					    'ssl' => array(
					        'verify_peer' => false,
					        'verify_peer_name' => false,
					        'allow_self_signed' => true
					    )
					);

				    //Recipients
				    $mail->setFrom('from@example.com', 'Mailer');
				    $mail->addAddress($email,'John');     // Add a recipient
				    // $mail->addAddress('ellen@example.com');               // Name is optional
				    // $mail->addReplyTo('info@example.com', 'Information');
				    // $mail->addCC('cc@example.com');
				    // $mail->addBCC('bcc@example.com');

				    // //Attachments
				    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
				    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

				    //Content
				    $mail->isHTML(true);                                  // Set email format to HTML
				    $mail->Subject = 'Password reset link';
				    $mail->Body    = $reset_link;
				    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

				    $mail->send();
				    redirect("/index.php");
				    // echo 'Message has been sent';
				} 
				catch (Exception $e) 
				{
				    echo 'Message could not be sent.';
				    echo 'Mailer Error: ' . $mail->ErrorInfo;;
				}

        		// echo $reset_link;
					
        		// $send = mail($email,"Password reset link", $reset_link);
        		// if(!$send)
        		// 	echo "Mail not sent";
        		//send email
        	}
        	else
        	{
        		;//email not found
        	}
        }
        else
        {
        	echo "Not successful";
        }


        // else apologize
        // apologize("Invalid username and/or password.");
    }	
?>