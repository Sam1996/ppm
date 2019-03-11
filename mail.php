<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

if(isset($_POST)){
    $data = json_decode($_POST['data'],true); 
    $message=file_get_contents('email_template.php');
    $electronics = $appliances = $things = "<table border='1'><th>Item</th><th>Quantity</th>";
    foreach($data['electronics'] as $key=>$value){
        $electronics .= "<tr>";
        $electronics .= "<td>".$key."</td>";
        $electronics .= "<td>".$value."</td>";
        $electronics .= "</tr>";
    }
    $electronics .= "</table>";
    foreach($data['appliances'] as $key=>$value){
        $appliances .= "<tr>";
        $appliances .= "<td>".$key."</td>";
        $appliances .= "<td>".$value."</td>";
        $appliances .= "</tr>";
    }
    $appliances .= "</table>";
    foreach($data['things'] as $key=>$value){
        $things .= "<tr>";
        $things .= "<td>".$key."</td>";
        $things .= "<td>".$value."</td>";
        $things .= "</tr>";
    }
    $things .= "</table>";

    $replaceFrom = array('[=NAME]','[=EMAIL]','[=PHONE]','[=MODE]','[=SHIFT]','[=FROM]','[=TO]','[=ELECTRONICS]','[=APPLIANCES]','[=OTHERS]');
    $replaceTo = array($data['info']['name'],$data['info']['email'],$data['info']['phone'],$data['transport']['mode'],$data['transport']['shift'],$data['transport']['from'],$data['transport']['to'],$electronics,$appliances,$things);
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
        $mail->addCC('cc@example.com');
        $mail->addBCC('bcc@example.com');
    
        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Here is the subject';
        $mail->Body    = $message;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}