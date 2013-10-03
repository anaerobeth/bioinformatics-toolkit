<!-- This program looks for CXXC motif in a bacterial protein sequence (implemented using PHP and MySQL)

Copyright 2012 Elizabeth Tenorio

Steps:
Loop through each line to grab sequence data and explode the line
Analyze for CXXC and count if 3 per word , ex: CSK since next word starts with C
Tally count and insert into `count` column of same table
-->

<?php 

$con = mysql_connect("localhost","root","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("hulab", $con);
//$result = mysql_query("SELECT * FROM `taloci`");

$result = mysql_query("SELECT * FROM `testw83aa`");
while($r[]=mysql_fetch_assoc($result));

$new = array();

//loop through each to grab sequence data 
foreach ($k as $v){
	$str = $row[`sequence`];
	}

//explode it 
$words = explode('C',$str);

//analyze for CXXC -- count if 3 per word , ex: CSK since next word starts with C
//tally count and insert into `count` column of same table
foreach ($words as $word) {
    mysql_query("INSERT INTO `cxxcloci` (word) VALUES ('C$word')");
	}
	

?>
