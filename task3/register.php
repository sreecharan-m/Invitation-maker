<?php

$status='';
$errors='';
if(isset($_POST['submit']))
{
      $conn=mysqli_connect('localhost','shaun','test1234','task3');
      $usr=$_POST['username'];
      $pwd=$_POST['password'];
      $name=$_POST['name'];
      $email=$_POST['eml'];

      $sql="INSERT INTO users(name,username,password,email) VALUES('$name','$usr','$pwd','$email')";
      
      //$sqla="CREATE TABLE '$usr'(no INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,type VARCHAR(255) NOT NULL,dt DATE,venue VARCHAR,ti TIME,addnote VARCHAR(255))";
      if(mysqli_query($conn,$sql))
      {
            //echo "success";
            $status="Account Successfully Created";
      }
      else
      {
            $errors=mysqli_error($conn);
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
      		<div id="tm1">
      		REGISTER
      	    </div>
      	</div>
      	<div id="logincontent1">
      		
            <!--<div id="heading" style="text-align: center; font-color: #000000;">REGISTER</div>-->
      		<div id="formfield">
      		<form action="register.php" method="POST">
      			<table>
      				<tr >
      					<td class="tdl"><label for="name" class="lbl">NAME :</label></td>
      					<td class="tdl"><input type="text" name="name" id="name"></td>
      				</tr>
      				<tr>
      					<td class="tdl"><label for="uname" class="lbl"></label>USERNAME :</td>
      					<td class="tdl"><input type="text" name="username" id="uname"></td>
      				</tr>
                              <tr>
                                    <td class="tdl"><label for="pwd" class="lbl"></label>PASSWORD :</td>
                                    <td class="tdl"><input type="password" name="password" id="pwd"></td>
                              </tr>
                               <tr>
                                    <td class="tdl"><label for="eml" class="lbl"></label>EMAIL :</td>
                                    <td class="tdl"><input type="email" name="eml" id="eml"></td>
                              </tr>
      			</table>
      			<div id="logindiv">
      			<div style="text-align: center;"></div>
                        <button id="login" name="submit">SUBMIT</button>
      		    </div>
                     <div id="statusdiv" style="font-size: 20px; text-align: center; margin-top: 4vh; color: #ffa500; font-weight: 600; background-color: #000; border-radius: 8px;">
                           <?php echo "$status"; ?>
                     </div> 
                     <div id="statusdiv" style="font-size: 20px; text-align: center; margin-top: 4vh; color: #ff0000; font-weight: 600; border-radius: 8px;">
                           <?php echo "$errors"; ?>
                     </div>
      		</form>
      	  </div>
      	</div>
      </div>
</body>

</html>

