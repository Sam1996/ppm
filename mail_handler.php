<?php
	// if(isset($_POST['submit'])){
	// 	$name=$_POST['name'];
	// 	$email=$_POST['email'];
	// 	$phone=$_POST['phone'];
	// 	$msg=$_POST['msg'];

	// 	$to='dreamworkproject7@gmail.com'; // Receiver Email ID, Replace with your email ID
	// 	$subject='Form Submission';
	// 	$message="Name :".$name."\n"."Phone :".$phone."\n"."Wrote the following :"."\n\n".$msg;
	// 	$headers="From: ".$email;

	// 	if(mail($to, $subject, $message, $headers)){
	// 		echo "<h1>Sent Successfully! Thank you"." ".$name.", We will contact you shortly!</h1>";
	// 	}
	// 	else{
	// 		echo "Something went wrong!";
	// 	}
	// }
?>
<?php
	if(isset($_POST) && !empty($_POST['data'])){
		$data = $_POST['data'];
		echo $data;
	// 	$to='samcladson08@gmail.com'; // Receiver Email ID, Replace with your email ID
	// 	$subject='Form Submission';
	// 	$message=$data;
	// 	$headers="From: ".$email;
	// 	if(mail($to, $subject, $message, $headers)){
	// 				echo "<h1>Sent Successfully! Thank you , We will contact you shortly!</h1>";
	// 			}
	// 			else{
	// 				echo "Something went wrong!";
	// 			}
	// }
?>