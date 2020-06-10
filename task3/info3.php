<?php

session_start();
$usr=$_SESSION['username'];
$conn=mysqli_connect('localhost','shaun','test1234','task3');
$sql= "SELECT id,name,username,password,email FROM users WHERE username = '$usr'";

$result = mysqli_query($conn, $sql); //result set of rows
$data= mysqli_fetch_all($result, MYSQLI_ASSOC);

$name=$data[0]['name'];

?>

<!DOCTYPE html>
<html>
<head>
	<title>WEBSITE DESIGNER</title>
	<link rel="stylesheet" type="text/css" href="info3.css">
    <meta charset="utf-8">

    <style type="text/css">
      
      button {

        text-decoration: none;
        background: none;
        border: none;
      }

    </style>

</head>
<body>
   <div id="fullcontent">
	   
	   <div id="name">
	   	<h1><i>Welcome <?php echo "$name"; ?></i></h1>
	   </div>
	   
	   <div id="dashboardcontenttt">
          <div id="dashboard">
            <div class="items">
            	<a href="createinvitation.php"><h1><i>Create Invitation</i></h1></a>
            </div>
            <div class="items">
            	<a href="myinvitations.php"><h1><i>My Invitations</i></h1></a>
            </div>
            <div class="items">
            	<a href="response.php"><h1><i>Responses</i></h1></a>
            </div>
            <div class="items">
              <form method="POST" action="logout.php">
              <button><a href="logint3.php"><h1><i>logout</i></h1></a></button>  
              </form>
            </div>
          </div>
       </div>
   
   </div>
</body>
</html>