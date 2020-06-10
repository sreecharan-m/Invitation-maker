<?php 

session_start();
$usr=$_SESSION['username'];
$conn=mysqli_connect('localhost','shaun','test1234','task3');

$sql="SELECT * FROM events WHERE username='$usr'";

$result = mysqli_query($conn, $sql);
$data= mysqli_fetch_all($result, MYSQLI_ASSOC);

$i=1;

?>


<!DOCTYPE html>
<html>

<head>
	<title>INVITATION VIEWER</title>

    <style type="text/css">
    	
    body {

    	background-image: url("images/infobackground2.jpg");
    	background-size: cover;

    }

    #fullcontent {

    	margin: 10vh;
    	display: flex;
    	justify-content: center;
    	color: #ffa500;

    }

    .intro {

    	font-size: 24px;
    	font-weight: 900;
    	margin: 2vh;
    }

    .abc
        {
        	background-color: #000;
        	border-radius: 5px;
        }

    tr {
        	margin: 20px;
        	padding: 10px;
        	color: #ffa500;
        }

        td {
        	margin: 20px;
        	padding: 10px;
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
        a
        {
        	text-decoration: none;
        	color: #ffa500;
        }

    </style>

    <body>

    	<div style="text-align: left; margin: 2vw; padding: 10px;">
        <button id="create"><a href="info3.php">Dashboard</a></button>
      </div>


    <div id="fullcontent">
    	
    	<div id="resps">
    		
            <?php foreach ($data as $key){ ?>

             <div class="intro" style="margin-top: 8vh;">
             	<?php echo "$i"; $i=$i+1;?> . <?php echo $key['invitation_name']; ?> on <?php echo $key['dt']; ?>
             </div>

             <hr>

             <?php

              $id=$key['id'];

              $sqla="SELECT * FROM response WHERE id='$id'";
              $resulta=mysqli_query($conn, $sqla);
              $dataa=mysqli_fetch_all($resulta, MYSQLI_ASSOC);

              //print_r($dataa);
              //print_r(count($dataa));
              if(count($dataa) == 0)
              {
              	$k=1;
              	//print_r($K);
              }

             ?>

             <table class="details" style="margin-top: 8vh;">
             	
             	<tr>
              	<td class="abc">USERNAME</td>
              	<td class="abc">RESPONSE</td>
              	<td class="abc">NUMBER OF PERSONS</td>
              	<td class="abc">FOOD</td>
                </tr>



                <?php foreach($dataa as $lock){ ?>
 
                <?php 

                  if(isset($lock['username']))
                  {
                  	$a=$lock['username'];
                  }
                  else
                  	$a='';

                  if(isset($lock['response']))
                  {
                  	$b=$lock['response'];
                  }
                  else
                  	$b='';

                  if(isset($lock['no']))
                  {
                  	$c=$lock['no'];
                  }
                  else
                  	$c='';

                  if(isset($lock['food']))
                  {
                  	$d=$lock['food'];
                  }
                  else
                  	$d='';

                ?>



                <?php 


                 /*if($k==1)
                 {
                 	
                 	$a="nil";
                 	$b="nil";
                 	$c="nil";
                 	$d="nil";
                
                 }*/

                ?>


                <tr>
                	<td><?php echo "$a"; ?></td>
                	<td><?php echo "$b"; ?></td>
                	<td><?php echo "$c"; ?></td>
                	<td><?php echo "$d"; ?></td>

                </tr>

                <?php } ?>	

             </table>

            <?php } ?>	

    	</div>

    </div>

</head>



</body>
</html>