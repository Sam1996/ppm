<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

if(isset($_POST)){
    $data = json_decode($_POST['data'],true); 
    $message=file_get_contents('email_template.html');

    $fromToDetails = $data['data_one'];
    $PropertyDetails = $data['data_two'];
    $DateDetails = $data['data_three'];
    $personalDetails = $data['data_four'];    

    if(array_key_exists('city',$fromToDetails)){
        $area = 'Within '.$fromToDetails['city'];
    }else{
        $area = 'Between Cities';
    }

    $replaceFrom = array('[=NAME]','[=EMAIL]','[=PHONE]','[=AREA]','[=TYPE]','[=PROPERTY]','[=FROM]','[=TO]','[=DATE]');
    $replaceTo = array($personalDetails['name'],$personalDetails['email'],$personalDetails['phone'],$area,$PropertyDetails['type'],$PropertyDetails['roomType'],$fromToDetails['from'],$fromToDetails['to'],$DateDetails['movingDate']);
    $message = str_replace($replaceFrom,$replaceTo,$message);
    
    $mail = new PHPMailer(true); 

    try {
        //Server settings
        $mail->SMTPDebug = 4;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'samnsimson@gmail.com';                 // SMTP username
        $mail->Password = 'samnishanth01';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to
    
        //Recipients
        $mail->setFrom('from@example.com', 'Mailer');
        $mail->addAddress('samnsimson@gmail.com', 'Sam N Simson');     // Add a recipient
        $mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('samcladson08@gmail.com');
    
        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Here is the subject';
        $mail->Body    = $message;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        if($mail->send()){
            return '200';
        };
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}