<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

if(isset($_POST["name"])) {
    $name = $_POST["name"];
	$phonenumber = $_POST["phonenumber"];
    $email = $_POST["email"];
    $help = $_POST["help"];
    $budget = $_POST["budget"];
    $website = $_POST["website"];
	$body = $_POST["body"];

    $mail = new PHPMailer();

    //smtp setting
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'mukhtarapril8@gmail.com';
    $mail->Password = 'mukhtar2944';
    $mail->Port = 465;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Subject = 'Contact Form';
    $mail->setFrom('mukhtarapril8@gmail.com', 'Remark');
    $mail->addAddress('mukhtarapril8@gmail.com'); 


    //email settings
    $mail->IsHTML(true);
    
    $mail->Body = "You are getting this mail because someone submitted a contact form.<br>
    Name:$name
    <br>Email:$email
    <br>phonenumber:$phonenumber
    <br>help:$help
    <br>budget:$budget
    <br>website:$website
    <br>Message:$body<br>";

    if($mail->send()){
        // echo 'success';
    }else{
        $code = 400;
        $status = 'failed';
        $response = 'Something is wrong: <br>'. $mail->ErrorInfo;
        exit(json_encode(array('status' => $status, 'response' => $response, 'code' => $code)));
    }

    $mail2 = new PHPMailer();

    //smtp setting
    // $mail2->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail2->isSMTP();
    $mail2->Host = 'smtp.gmail.com';
    $mail2->SMTPAuth = true;
    $mail2->Username = 'mukhtarapril8@gmail.com';
    $mail2->Password = 'mukhtar2944';
    $mail2->Port = 465;
    $mail2->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail2->setFrom('mukhtarapril8@gmail.com', 'Remark');
    $mail2->Subject = 'Hello from Remark';
    $mail2->addAddress($email); 
    //email settings
    $mail2->IsHTML(true);
    
    $mail2->Body = 'Your contact information is received successfully.';
	if($mail2->send()) {
        $code = 200;
        $status = 'success';
        $response = 'Mail was sent successfully';
	    exit(json_encode(array('status' => $status, 'response' => $response, 'code' => $code)));
	}
}
?>