<?php

if(isset($_GET['id']))
$id=$_GET['id'];

if(isset($_POST['sub']))
{
	date_default_timezone_set('Etc/UTC');

	require 'PHPMailer-master/src/PHPMailer.php';
	require 'PHPMailer-master/src/Exception.php';
	require 'PHPMailer-master/src/SMTP.php';
	//C:\xampp\htdocs\task3\PHPMailer-master\src
	$mail = new PHPMailer\PHPMailer\PHPMailer(true);
	$mail ->isSMTP();
	$mail ->SMTPAuth = true;
	$mail ->SMTPSecure = 'ssl';
	//$mail->SMTPSecure = 'tls';
	//$mail ->Host = 'smtp.gmail.com';
	$mail ->Host = gethostbyname('ssl://smtp.gmail.com');
	$mail ->Port='465';
	$mail ->isHTML();


	$mail ->Username = "msjh0512backup@gmail.com";
 	$mail ->Password= '511200112';
    $mail ->SetFrom("msjh0512backup@gmail.com");
 	$mail ->FromName = "SREE CHARAN M";
 
	$mail ->addAddress($_POST['mail']);

	//$mail ->isHTML(true);
	$mail ->Subject =$_POST['subject'];
	$mail ->Body = "Kindly Visit the link for viewing the invitation <br> http://localhost/task3/invitationview.php?id='$id'";

	if(! $mail ->Send())
	{
		echo "error--".$mail ->ErrorInfo;
	}
	else
	{
		//echo "success";
	}
}


?>


<!DOCTYPE html>
<html>
<head>
	<title>MAIL OPTION</title>

	<style type="text/css">
		
      body {
      	margin: 20vh;
      	display: flex;
      	justify-content: center;
      	background-image: url("images/infobackground2.jpg");
      }

      .abc
      {
      	margin: 2vh;
      	padding: 2vh;
      	text-align: center;
      	color: #ffa500;
      	background: #000;
      	border-radius: 3px;
      	font-size: 22px;

      }
      input {
      	font-size: 22px;
      	border: 2.5px solid #ffa500;
      	text-align: center;
      }

      #send {
      	font-size: 18px;
      	color: #ffa500;
      	background-color:#000;
      	padding: 10px; 
      	border-radius: 8px;
      	border:1px solid white;
      }

      tr {
      	margin: 3vh;
      }

	</style>
</head>
<body>

<div id="fullcontent">
	
  <div id="mailaddress" style="display: flex; justify-content: center;">
  	
   <form action="mail.php?id=<?php echo "$id" ?>" method="POST">
   	
   	<table>
   		
   		<tr>
   			<td class="abc">Enter The Mail Address</td>
   			<td class="abc"><input type="text" name="mail"></td>
   		</tr>

   		<tr>
   			<td class="abc">Subject</td>
   			<td class="abc"><input type="text" name="subject"></td>
   		</tr>
   	</table>

    <div id="submit" style="margin-top: 10vh; display: flex; justify-content: center;">
    	<button type="submit" name="sub" id="SEND">Send</button>
    </div>

   </form>

  </div>

</div>
</body>
</html>