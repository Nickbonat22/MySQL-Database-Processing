<?php

include('connectionData.txt');

$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');

?>

<html>
<head>
  <title>Another Simple PHP-MySQL Program</title>
  <link rel="stylesheet" href="cssnba.css">
  </head>
  
  <body bgcolor="white">
  
  <div class="pimg1">  
  
<?php
  
$state = $_POST['state'];

$state = mysqli_real_escape_string($conn, $state);
// this is a small attempt to avoid SQL injection
// better to use prepared statements

$query = "select g.date as date, g.visitor_team as visitor_team, g.visitor_points as visitor_points, g.home_team as home_team, g.home_points as home_points, g.attendence as attendence from game g JOIN referee ref ON g.referee_id = ref.referee_id where ref.name LIKE ";
$query = $query."'".$state."';";

?>

<p class="pp">The query:</p>
<p class="pp">
<?php
print $query;
?></p>

<hr>
<p class="pp">Result of query:</p>

<div class="pp">
<?php
$result = mysqli_query($conn, $query)
or die(mysqli_error($conn));

print "<pre>";
while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
  {
    print "\n";
    print "$row[data]  $row[visitor_team]  $row[visitor_points]  $row[home_team]  $row[home_points]  $row[attendence]";
  }
print "</pre>";

mysqli_free_result($result);

mysqli_close($conn);

?>
</div>


<p class="pp">
<hr>

<p>
<a class="pp" href="ref.txt" >Contents</a>

of the PHP program that created this page.   
</div>
</body>
</html>
    
