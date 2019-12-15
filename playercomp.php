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
$state2 = $_POST['state2'];

$state = mysqli_real_escape_string($conn, $state);
$state2 = mysqli_real_escape_string($conn, $state2);
// this is a small attempt to avoid SQL injection
// better to use prepared statements

$query = "SELECT ps.name as player, ps.field_goal_percentage as field_goal_percentage, ps.three_point_percentage as three_point_percentage, ps.free_throw_percentage as free_throw_percentage,ps.rebounds as rebounds, ps.assists as assists, ps.steals as steals, ps.blocks as blocks, ps.turnovers as turnovers, ps.points as points from player_stats ps WHERE ps.name LIKE ";
$query = $query."'".$state."'";
$query = $query. " UNION SELECT ps.name as player, ps.field_goal_percentage as field_goal_percentage, ps.three_point_percentage as three_point_percentage, ps.free_throw_percentage as free_throw_percentage,ps.rebounds as rebounds, ps.assists as assists, ps.steals as steals, ps.blocks as blocks, ps.turnovers as turnovers, ps.points as points from player_stats ps WHERE ps.name LIKE ";
$query = $query."'".$state2."';";


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
print "player   field_goal_percentage   three_point_percentage   free_throw_percentage   rebounds   total_rebounds   assists   steals   blocks   turnovers   points";
print "<pre>";
while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
  {
    print "\n";
    print "$row[player]  $row[field_goal_percentage]  $row[three_point_percentage]  $row[free_throw_percentage]  $row[rebounds]  $row[assists]  $row[steals]  $row[blocks]  $row[turnovers]  $row[points]";
  }
print "</pre>";

mysqli_free_result($result);

mysqli_close($conn);

?>
</div>


<p class="pp">
<hr>

<p>
<a class="pp" href="playercomp.txt" >Contents</a>

of the PHP program that created this page.   
</div>
</body>
</html>
    
