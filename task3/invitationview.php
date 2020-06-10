<?php 


session_start();
if(!isset($_SESSION['username']))
{
	//$t='1';

//http_response_code(404);
//include('my_404.php'); // provide your own HTML for the error page
//echo "access denied";
//die();
	header('location: logint3.php');

}




if(isset($_GET['id'])){

	$conn=mysqli_connect('localhost','shaun','test1234','task3');

	$id = mysqli_real_escape_string($conn, $_GET['id']);

	$sql= "SELECT * FROM events WHERE id='$id'";

	$result = mysqli_query($conn, $sql);
    $data= mysqli_fetch_all($result, MYSQLI_ASSOC);
    //print_r($data);
    //$data[0]['venue']='salem';
    //echo $data[0]['venue'];
    //session_start(); 
    if(!($data[0]['private'] == ''))
    {
    	
    	$usrr=$_SESSION['username'];
    	if((!strpos($data[0]['private'], $usrr)) && ($usrr !== $data[0]['username']))
    	{
             //http_response_code(404);
             //include('my_404.php'); // provide your own HTML for the error page
             echo "access denied";
             die();

    	}
    }
}



//print_r($data[0]);
$ref=$_GET['id'];
$t='1';

if(isset($_POST['accept']))
{
   if(date("Y-m-d") <= $data[0]['deadline'])
   {
    $usr=$_SESSION['username'];
    $res='accept';
    $ref=$_GET['id'];
    $_SESSION['id']=$ref;
	$sqla="SELECT count(*) as total FROM response WHERE id='$ref' AND username='$usr'";
    $resulta=mysqli_query($conn, $sqla);
    $dataa=mysqli_fetch_all($resulta, MYSQLI_ASSOC);
    //print_r($dataa);
    if($dataa[0]['total'] == 0)
	{
	//$sqlb="INSERT INTO response(id,username,response) VALUES('$ref','$usr','$res')";
	//if(mysqli_query($conn,$sqlb))
	//{
		//echo "success";
		header('location: requirements.php');
	//}
    }
   }
}

if(isset($_POST['reject']))
{

    $usr=$_SESSION['username'];
    $res='reject';
    $ref=$_GET['id'];

	$sqla="SELECT count(*) as total FROM response WHERE id='$ref' AND username='$usr'";
    $resulta=mysqli_query($conn, $sqla);
    $dataa=mysqli_fetch_all($resulta, MYSQLI_ASSOC);
    //print_r($dataa);
    if($dataa[0]['total'] == 0)
	{
	$sqlb="INSERT INTO response(id,username,response) VALUES('$ref','$usr','$res')";
	if(mysqli_query($conn,$sqlb))
	{
		//echo "success";
	}
    }
}

?>


<!DOCTYPE html>

<html>

<head>
	<title>INVITATION MAKER</title>

	<style type="text/css">
		
    body {

    	margin: 15vh 25vw 25vh 25vw;
    }

    #fullcontent {
    	display: flex;
    	justify-content: center;
    	flex-direction: column;
    }

    #heading {

           border-radius: 8px;
           border-color: #ffa500;
           padding: 5px 15px 5px 15px;
           font-weight: 550;
           background-color: #000;
           color: #ffa500;
           border:0px;
    }

    .tde {

    	margin: 20px;
        border-radius: 8px;
        border-color: #ffa500;
        padding: 5px 15px 5px 15px;
        font-weight: 550;
        background-color: #000;
        color: #ffa500;
        border:0px;
        font-size: 20px;
    }
    img {

    	max-width: 25vw;max-height: 10.8vw;
    }

	</style>
</head>
<body id="kkk">

<div id="fullcontent" class="fc">
	
 <div id="aaa" style="display: flex; justify-content: center;">
 <h1 id="heading"><i></i></h1>
 </div>
 
 <div id="xxx">
 <div id="header" style="margin-top: 5vh; font-size: 30px; text-align: center; display: flex; justify-content: center; flex-direction: column;">
 <div style="display: flex; justify-content: center;">
 <div id="himage" style="max-width: 25vw;max-height: 10.8vw;max-width: 25vw;max-height: 10.8vw; display: flex; justify-content: center;">
 <?php 

   if(isset($data[0]['imageid']))
   {
   	if($data[0]['position'] == 'inheader')
   	{
   		
        //header("content-type: image/png");
   		//echo '<img scr="data:image/png;base64,'.base64_encode($data[0]['image']).'"/>';
   		//echo $data[0]['image'];
   		echo "<img src='uploads/".$data[0]['imageid']."' >";
   	}
   }

 ?>
 </div>
</div>
 <div id="headertext">
 	
 </div>

 </div>

 <div id="body" style="margin-top: 5vh; font-size: 30px; text-align: center; display: flex; justify-content: center;  flex-direction: column;">
 	

<div style="display: flex; justify-content: center; width: 10vw; height:  25vh">
 <?php 

   if(isset($data[0]['image']))
   {
   	if($data[0]['position'] == 'inbody')
   	{
   		//echo $data[0]['image'];
   		echo "<img src='uploads/".$data[0]['imageid']."' >";
   	}
   }

 ?>
 </div>

 <div id="bodytext">
 	
 </div>


 </div>

 <div id="footer" style="margin-top: 5vh; font-size: 30px; text-align: center; display: flex; justify-content: center;  flex-direction: column;">
 	


<div style="display: flex; justify-content: center; width: 10vw; height:  25vh">
 <?php 

   if(isset($data[0]['image']))
   {
   	if($data[0]['position'] == 'infooter')
   	{
   		
        //header("content-type: image/png");
   		//echo '<img scr="data:image/png;base64,'.base64_encode($data[0]['image']).'"/>';
   		echo "<img src='uploads/".$data[0]['imageid']."' >";
   	}
   }

 ?>
 </div>

 <div id="footertext">
 	
 </div>


 </div>
 </div>

 <form action="invitationview.php?id=<?php echo $ref ?>" method="POST" style="margin-top: 8vh;">
 <table style="display: flex; justify-content: center;">
 	<tr style="display: flex; justify-content: center;">
 		<div>
 		<td ><button name="accept" class="tde">Aceept</button></td>
 		<td ><button name="reject" class="tde">Reject</button></td>
 	    </div>
 	</tr>
 </table>
 </form>
</div>

<script type="text/javascript">
	
var i='<?php echo $data[0]['invitation_name']; ?>';
var hdr='<?php echo $data[0]['header']; ?>';
var bdy='<?php echo $data[0]['body']; ?>';
var ftr='<?php echo $data[0]['footer']; ?>';

var hfc='<?php echo $data[0]['hfc']; ?>';
var hbc='<?php echo $data[0]['hbc']; ?>';
var bfc='<?php echo $data[0]['bfc']; ?>';
var bbc='<?php echo $data[0]['bbc']; ?>';
var ffc='<?php echo $data[0]['ffc']; ?>';
var fbc='<?php echo $data[0]['fbc']; ?>';
var type='<?php echo $data[0]['event_name']; ?>';


console.log(i);
let heading=document.getElementById("heading");
let header=document.getElementById("headertext");
let body=document.getElementById("bodytext");
let footer=document.getElementById("footertext");
let fcont=document.getElementById('fullcontent');
let back=document.getElementById('xxx');
let backa=document.getElementById('kkk');

if(type == 'wedding')
{
	backa.style.backgroundImage='url("images/wedding.jpg")';
	//backa.style.backgroundSize='100% 100%';
	backa.style.backgroundRepeat='no-repeat';
	backa.style.backgroundSize='50% 100%';
	backa.style.backgroundPosition='center';
}
else if(type == 'funeral')
{
	backa.style.backgroundImage='url("images/funeral.jpg")';
	//back.style.backgroundSize='contain';
    //backa.style.backgroundSize='100% 100%';
	backa.style.backgroundRepeat='no-repeat';
	backa.style.backgroundSize='50% 100%';
	backa.style.backgroundPosition='center';

}
else if(type == 'birthday')
{
	backa.style.backgroundImage='url("images/birthday.jpg")';
	//back.style.backgroundSize='contain';
	backa.style.backgroundSize='50% 100%';
	backa.style.backgroundRepeat='no-repeat';
	backa.style.backgroundPosition='center';
}

heading.innerHTML = i;

header.innerHTML = hdr;
body.innerHTML =bdy ;
footer.innerHTML =ftr ;

header.style.color=hfc;
header.style.background=hbc;
body.style.color=bfc;
body.style.background=bbc;
footer.style.color=ffc;
footer.style.background=fbc;



//var t='<?php echo $t; ?>';
//console.log(t);
//if(t=='1')
//{
   //fcont.style.display='flex';
//}


</script>

</body>

</html>