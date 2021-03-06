<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/home/ec2-user/vendor/phpmailer/phpmailer/vendor/autoload.php';

if (isset($_POST["resetrequestsubmit"])){
	$selector = bin2hex(random_bytes(8));
	$token = random_bytes(32);

	$url = "rottenpotatoes.games/reset_pw.php?selector=" . $selector . "&validator=" . bin2hex($token);

	$expires = date("U") + 1800;

//	echo "expire var set"; /*error check*/

/*connect to db*/
	include 'connect.php';

//	echo "connect.php working"; /*error check*/

/*set users email*/
	$userEmail = $_POST["mail"];

//	echo "user email var set"; /*error check*/

/*invalidate previous reset requests*/
	$sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?;";

//	echo "sql var set"; /*error check*/

	$stmt = mysqli_stmt_init($con);

//	echo "stmt var set"; /*error check*/

	if (!mysqli_stmt_prepare($stmt, $sql)){
		echo "Error accessing database, try again.";
		exit();}
	else {
	mysqli_stmt_bind_param($stmt, "s", $userEmail);
	mysqli_stmt_execute($stmt);}

//	echo "previous requests deleted"; /*error check*/

/*create new request entry with valid validation tokens in pwdReset table*/
	$sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?);";
	$stmt = mysqli_stmt_init($con);
	if (!mysqli_stmt_prepare($stmt, $sql)){
                echo "Error preparing reset. Try again.";
                exit();}
        else {
	$hashedToken = password_hash($token, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
        mysqli_stmt_execute($stmt);}

//	echo "tokens added to table"; /*error check*/

/*close stmt and connection*/
	mysqli_stmt_close($stmt);
	mysqli_close($con);

/* Beginning of email settings*/
	$to =  $userEmail;
	$subject = 'Reset your password for Rotten Potatoes';
	$message = '<div style="color: black; font-size: 15px;"><p>Click the link below to reset your password.';
	$message .= '<br>If you did not request a password reset, you can ignore this email.</p>';
	$message .= '<p><b>Password reset links remain valid for 30 minutes.</b></p></div>';
	$message .= '<p><a href="' . $url . '">' . $url . '</a></p>';

//	require_once "/usr/share/php/libphp-phpmailer/src/PHPMailer.php";
//      require_once "/usr/share/php/libphp-phpmailer/src/SMTP.php";
//      require_once "/usr/share/php/libphp-phpmailer/src/Exception.php";

// For use with Composer
//	require '/home/mario/vendor/autoload.php';

        $mail = new PHPMailer();

/*SMTP settings for external mail server*/
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'rottenpotatoes.cit480@gmail.com';
        $mail->Password = 'C!t--480';
        $mail->Port = 587;
        $mail->SMTPSecure = "tls";

// allows less secure certs
	$mail->SMTPOptions = array(
        'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
                )
        );


	$mail->isHTML(true);
        $mail->setFrom('RottenPotatoes.cit480@gmail.com', 'Rotten Potatoes Password Reset');
        $mail->addAddress($to);
        $mail->addReplyTo('RottenPotatoes.cit480@gmail.com');
        $mail->Subject = $subject;
        $mail->Body = $message;

	if(!$mail->Send()){
	//echo "reset email not sent";
	header("Location:Passwrd_recovery.php?msg=err");
	}
	else {
	header("Location:Passwrd_recovery.php?msg=suc");
	//echo "email sent";
	}
}
else {
//echo "email isnt sending";
header("Location:Passwrd_recovery.php?msg=err");
}
?>
