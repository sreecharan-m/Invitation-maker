<?php

session_start();
$usr=$_SESSION['username'];
$conn=mysqli_connect('localhost','shaun','test1234','task3');
$i=1;
$sql="SELECT * FROM events WHERE username='$usr'";

$result = mysqli_query($conn, $sql);
$data= mysqli_fetch_all($result, MYSQLI_ASSOC);
//print_r($data);
  /*$event=$_POST['event'];
  $dt=$_POST['dt'];
  $ti=$_POST['ti'];
  $addnote=$_POST['addnote'];
  $header=$_POST['header'];
  $body=$_POST['body'];
  $footer=$_POST['footer'];
  $venue=$_POST['venue'];
  $hfc=$_POST['hfc'];
  $hbc=$_POST['hbc'];
  $bfc=$_POST['bfc'];
  $bbc=$_POST['bbc'];
  $ffc=$_POST['ffc'];
  $fbc=$_POST['fbc'];*/
?>



<!DOCTYPE html>

<html>


<head>
	<title>INVITATION MAKER</title>
	<style type="text/css">
		
		body {

			background-image: url("images/infobackground2.jpg");
		}


		table {
			border: 2px solid white;
			border-radius: 10px;
		}
	
        body {
        	margin: 5vh;
        }

        a {
        	text-decoration: none;
        	color: #ffa500;
        }

        #fullcontent {
        	
        	display: flex;
        	flex-direction: column;
        	justify-content: center;
        }

        #tablecontent {
        	display: flex;
        	justify-content: center;
        	margin-top: 8vh;
        }

        tr {
        	margin: 20px;
        	padding: 20px;
        	color: #ffa500;
        }

        td {
        	margin: 20px;
        	padding: 20px;
        	text-align: center;
        }

        #create {
           font-size: 19px;
           border-radius: 8px;
           border-color: #ffa500;
           padding: 5px 15px 5px 15px;
           font-weight: 550;
           background-color: #000;
           color: #ffa500;
           border:0px;
        }
        .abc
        {
        	background-color: #000;
        	border-radius: 5px;
        }

	</style>
</head>


<body>
 
<div id="fullcontent">

	<div style="text-align: left; margin: 1vw; padding: 5px;">
        <button id="create"><a href="info3.php">Dashboard</a></button>
    </div>
	
     <div id="tablecontent">
     	
        <table>
        	
              <tr>
              	<td class="abc">S.NO</td>
              	<td class="abc">INVITATION NAME</td>
              	<td class="abc">DATE</td>
              	<td class="abc">TIME</td>
              	<td class="abc">VENUE</td>
              	<td class="abc">LINK</td>
              	<td class="abc">ACCEPTED</td>
              	<td class="abc">REJECTED</td>
              	<td class="abc">ATTENDEES</td>
              	<td class="abc">MAIL TO OTHERS</td>
              </tr>

              <?php foreach ($data as $key){ ?>
              
               <tr>
               	  <td><?php echo "$i"; $i=$i+1; ?></td>
               	  <td><?php echo htmlspecialchars($key['invitation_name']) ?></td>
               	  <td><?php echo htmlspecialchars($key['dt']) ?></td>
               	  <td><?php echo htmlspecialchars($key['ti']) ?></td>
               	  <td><?php echo htmlspecialchars($key['venue']) ?></td>
               	  <td><a href="http://localhost/task3/invitationview.php?id=<?php echo htmlspecialchars($key['id'])?>">http://localhost/task3/invitationview.php?id=<?php echo $key['id']?></a></td>
               	  <?php 
                  
                  $ac="accept"; 
                  $sqla="SELECT count(*) as total FROM response WHERE id='{$key['id']}' AND response='$ac'";
                  $resulta=mysqli_query($conn, $sqla);
                  $dataa=mysqli_fetch_all($resulta, MYSQLI_ASSOC);
                  if(!isset($dataa[0]['total']))
                  {
                  	$acc=0;
                  }
                  else
                  	$acc=$dataa[0]['total'];

                  $rj='reject';
                  $sqlb="SELECT count(*) as total FROM response WHERE id='{$key['id']}' AND response='$rj'";
                  $resultb=mysqli_query($conn, $sqla);
                  $datab=mysqli_fetch_all($resulta, MYSQLI_ASSOC);


                  if(!isset($datab[0]['total']))
                  {
                  	$rjj=0;
                  }
                  else
                  	$rjj=$dataa[0]['total'];

                  //echo "hai";

                   $sqlc="SELECT sum(no) as total FROM response WHERE id='{$key['id']}' AND response='$ac'";
                  $resultc=mysqli_query($conn, $sqlc);
                  $datac=mysqli_fetch_all($resultc, MYSQLI_ASSOC);

                  $att=$datac[0]['total'];

               	  ?>

               	  <td><?php echo $acc ?></td>
               	  <td><?php echo $rjj ?></td>
               	  <td><?php echo $att ?></td>
               	  <td><a href="http://localhost/task3/mail.php?id=<?php echo $key['id']?>">Mail</a></td>
               </tr>

              <?php } ?>
        
        </table>

     </div>

</div>

</body>

</html>