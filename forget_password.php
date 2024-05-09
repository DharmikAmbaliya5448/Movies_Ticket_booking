<?php
 include("Database.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

 function sendMail($email,$reset_token)
 {
     require('phpmailer/src/PHPMailer.php');
	 require('phpmailer/src/Exception.php');
	 require('phpmailer/src/SMTP.php');

	 $mail = new PHPMailer(true);

	 try {
		//Server settings
		// $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
		$mail->isSMTP();                                            //Send using SMTP
		$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		$mail->Username   = 'dharmikambaliya153@gmail.com';                     //SMTP username
		$mail->Password   = 'oeqmmexmwmhemyfu';                               //SMTP password
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
		$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS
	
		//Recipients00000000000000000000
		$mail->setFrom('dharmikambaliya153@gmail.com', 'Wow Cine Pulse');
		$mail->addAddress($email);     //Add a recipient
		// $mail->addAddress('ellen@example.com');               //Name is optional
		// $mail->addReplyTo('info@example.com', 'Information');
		// $mail->addCC('cc@example.com');
		// $mail->addBCC('bcc@example.com');
	
		//Attachments
		// $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
		// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
	
		//Content
		$mail->isHTML(true);                                  //Set email format to HTML
		$mail->Subject = 'Password Reset Link from WOW Cine Pulse';
		$mail->Body    = "We got a request from you to reset password!<br>
		Click the link below: <br>
		<a href='http://localhost/php_movies/online-movie-booking-main/updatepassword.php?email=$email&reset_token=$reset_token'>Reset Password</a>";
		// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	
		$mail->send();
		return true;
	} catch (Exception $e) {
		return false;
	}
 }

 if(isset($_POST['send-reset-link'])){
	$query="SELECT * FROM user WHERE email='$_POST[email]'";
	$result=mysqli_query($conn,$query);
	if($result){
	   if(mysqli_num_rows($result)==1){
		$reset_token=bin2hex(random_bytes(16));
		date_default_timezone_set('Asia/kolkata');
		$date=date('y-m-d');
		$query= "UPDATE `user` SET `resettoken`='$reset_token',`resettokenexpire`='$date' WHERE `email`='$_POST[email]'";
		if(mysqli_query($conn,$query) && sendMail($_POST['email'],$reset_token)){
			echo "
			<script>
			alert('Password Reset Link Sent To E-mail');
			window.location.href='index.php';
			</script>";
		}
		else{
			echo "
		<script>
		alert('Server Down! Try Again Later');
		window.location.href='index.php';
		</script>";
		}
	   }
		else{
		echo "
		<script>
		alert('Email Not Found');
		window.location.href='index.php';
		</script>";
	   }
	}else{
		echo "
		<script>
		alert('Cannot Run Query');
		window.location.href='index.php';
		</script>";
	}
 }


?>