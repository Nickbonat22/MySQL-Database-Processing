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

$query = "SELECT ts.team as team, ts.wins as wins, ts.loss as loss, ts.total_games as total_games, ts.field_goal_percentage as field_goal_percentage, 
ts.total_rebounds as total_rebounds, ts.total_assists as total_assists, ts.total_steals as total_steals, ts.total_blocks as total_blocks, ts.total_turnovers as total_turnovers, ts.total_points as total_points from team_stats ts JOIN team t ON ts.team = t.team WHERE ts.team LIKE ";
$query = $query."'".$state."'";
$query = $query. " UNION SELECT ts.team as team, ts.wins as wins, ts.loss as loss, ts.total_games as total_games, ts.field_goal_percentage as field_goal_percentage, 
ts.total_rebounds as total_rebounds, ts.total_assists as total_assits, ts.total_steals as total_steal, ts.total_blocks as total_blocks, ts.total_turnovers as total_turnovers, ts.total_points as total_points from team_stats ts JOIN team t ON ts.team = t.team WHERE ts.team LIKE ";
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
print "name   wins   loss   total_games   field_goal_percentage   total_rebounds   total_assists   total_steals   total_blocks   total_turnovers   total_points";
print "<pre>";
while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
  {
    print "\n";
    print "$row[team]  $row[wins]  $row[loss]  $row[total_games]  $row[field_goal_percentage]  $row[total_rebounds]  $row[total_assists]  $row[total_steals]  $row[total_blocks]  $row[total_turnovers]  $row[total_points]";
  }
print "</pre>";

mysqli_free_result($result);

mysqli_close($conn);

?>
</div>


<p class="pp">
<hr>

<p>
<a class="pp" href="teamcomp.txt" >Contents</a>

of the PHP program that created this page.   
</div>
</body>
</html>
    
