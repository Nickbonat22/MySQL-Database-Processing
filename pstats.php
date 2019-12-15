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

$query = "SELECT name, field_goal_percentage, three_point_percentage, free_throw_percentage, rebounds, assists, steals, blocks, turnovers, points from player_stats where name like ";
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
print "name   fgp   tpg   ftg   rebounds   assists   blocks   turnovers   points";
print "<pre>";
while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
  {
    print "\n";
    print "$row[name]  $row[field_goal_percentage]  $row[three_point_percentage]  $row[free_throw_percentage]  $row[rebounds]  $row[assists]  $row[steals]  $row[blocks]  $row[turnovers]  $row[points]";
  }
print "</pre>";

mysqli_free_result($result);

mysqli_close($conn);

?>
</div>


<p class="pp">
<hr>

<p>
<a class="pp" href="pstats.txt" >Contents</a>

of the PHP program that created this page.   
</div>
</body>
</html>
    
