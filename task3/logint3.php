<?php 

$incorrect='';
if(isset($_POST['submit']))
{
      $conn=mysqli_connect('localhost','shaun','test1234','task3');

      //check conn
      if(!$conn)
      {
            echo "connection error";
      }

      $pwd=mysqli_real_escape_string($conn,$_POST['password']);
      $usr=mysqli_real_escape_string($conn,$_POST['username']);
      $sql= "SELECT id,name,username,password,email FROM users WHERE username = '$usr'";
      //$sql='SELECT * FROM credentials';
      $result = mysqli_query($conn, $sql); //result set of rows
      $data= mysqli_fetch_all($result, MYSQLI_ASSOC);
      
      //print_r($data);

      $name=($data[0]['name']);
      if($data[0]['password'] == $pwd)
      {
            session_start();
            $_SESSION['username']=$_POST['username'];
            header('location: info3.php');
      }
}
?>


<!DOCTYPE html>

<html>

<head>
	<title>INVITATION MAKER</title>
    <link rel="stylesheet" type="text/css" href="index.css">
    <meta charset="utf-8">
</head>

<body>
      <div id="content">
      	<div id="h">
      		<div id="tm">
      		<img id="img1" src="images/welcomelogo.jpg">
      	    </div>
      	</div>
      	<div id="logincontent">
      		
            <div id="heading" style="text-align: center;">LOGIN</div>
      		<div id="formfield">
      		<form action="logint3.php" method="POST">
      			<table>
      				<tr >
      					<td class="tdl"><label for="uname" class="lbl">USERNAME :</label></td>
      					<td class="tdl"><input type="text" name="username" id="uname"></td>
      				</tr>
      				<tr>
      					<td class="tdl"><label for="pwd" class="lbl"></label>PASSWORD :</td>
      					<td class="tdl"><input type="password" name="password" id="pwd"></td>
      				</tr>
      			</table>
      			<div id="logindiv">
      			<div style="text-align: center;"></div>
                        <button id="login" name="submit">ENTER</button>
      		    </div>
      		</form>
      	  </div>
      	</div>
      </div>
</body>

</html>

