 <!-- <a href="logout.php"><font color="blue">Log Out</font></a><br>
  <a href="index.php"><font color="blue">Back To Home</font></a>
  <!DOCTYPE html>
  <html>
  <head>
  	<meta charset="utf-8">
  	<title>Your Ticket</title>
  </head>
  <body>
  <center><font color="red"><h1>Congratulation You Have to Successfull Payment And Your Seat Book</h1></font>
  	<a href="ticket_show.php" target="_blank"><font color="blue"><h3>Take Your Ticket</h3></center></font></a>
  </body>
  </html> -->

  <!DOCTYPE html>
  <html>
  <head>
  	<meta charset="utf-8">
  	<title>Your Ticket</title>
  </head>
  <body>
  <?php
   echo '<script>alert("Your Ticket Is Book,Take Your Ticket Information")</script>';
   include("ticket_show.php");
   ?>
  </body>
  </html>