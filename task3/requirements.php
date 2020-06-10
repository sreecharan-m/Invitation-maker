<?php 

if(isset($_POST['submit']))
{
	$conn=mysqli_connect('localhost','shaun','test1234','task3');
	$n=$_POST['nos'];
	$f=$_POST['food'];
	
    session_start();
	$ref=$_SESSION['id'];
	$usr=$_SESSION['username'];

	$sqlb="INSERT INTO response(id,username,response,no,food) VALUES('$ref','$usr','accept','$n','$f')";

	if(mysqli_query($conn,$sqlb))
	{
		//echo "success";
	}	
}


?>

<!DOCTYPE html>


<html>


<head>
	<title>INVITATION MAKER</title>

	<style type="text/css">

    body {

    	margin:14vh;
    	display: flex;
    	justify-content: center;
    }		

    #fullcontent {
    	display: flex;
    	justify-content: center;
    	flex-direction: column;
    	background: rgb(0,0,0,0.15);
	    box-shadow: 5px 5px 10px rgb(255,165,0,1);
    }

    #welcome {
    	
    	font-size: 24px;
        margin: 10vh;

    }
    #submitbutton {
    	text-align: center;
    	margin-top: 5vh;
    	margin-bottom: 5vh; 
    }

    #sub {
    	border: 1px solid #ffa500;
    	background-color: #000;
    	color: #ffa500;
    	font-size: 18px;
    	padding: 7px;
    	border-radius: 5px;
    }

	</style>

</head>


<body>

<div id="fullcontent" >
	<div id="welcome" style="font-weight: 900;">
		Please fill the following so that we would be able to serve you better.
	</div>

	<div id="preferences" style="display: flex; justify-content: center;">
		
		<form action="requirements.php" method="POST">
		<table>
        <tr class="rows">
                <td class="tdl" style="font-size: 25px; display: flex; align-items: center; margin: 10px; padding: 5px; background-color: #000; border-radius: 5px; justify-content: center; color: #ffa500;"><i>Members :</i>
                </td>
                <td class="tdl">
                <div style="display: flex; flex-direction: row; align-items: center;">
                        <input type="number" id="nos" name="nos" style="border-radius: 5px; border:2.5px solid #ffa500; font-size: 20px; text-align: center; ">
                </td>
        </tr>

        <tr class="rows">
                <td class="tdl" style="font-size: 25px; display: flex; align-items: center; margin: 10px; padding: 5px; background-color: #000; border-radius: 5px; justify-content: center; color: #ffa500;"><i>Food Preferences :</i>
                </td>
                <td class="tdl">
                <div style="display: flex; flex-direction: row; align-items: center;">
                        <input type="text" id="food" name="food" style="border-radius: 5px; border:2.5px solid #ffa500; font-size: 20px; text-align: center;">
                </td>
        </tr>
        </table>
	    <div id="submitbutton">
        <button id="sub" name="submit">SUBMIT</button>
	    </div>
	    </form>
	</div>
	
</div>

</body>
</html>