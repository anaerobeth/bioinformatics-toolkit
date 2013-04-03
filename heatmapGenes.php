<!-- This program generates a heatmap of esential genes in bacterial genome arranged according to gene number

Copyright 2012 Elizabeth Tenorio

Steps:
Upload sql tables to phpMyAdmin database pn_tnseq2013:  
Assign colors to essential anh non essential genes
Copy the result and add annotations

-->

<?php
//connect to database
$databasename ="pg_tnseq";
$databaseusername ="root";
$databasepassword = "root";
$con = @mysql_connect($databasehost,$databaseusername,$databasepassword) or die(mysql_error());
@mysql_select_db($databasename) or die(mysql_error());

//get heatcode etc
$query = "SELECT * FROM `essentialsmerged`";
$result = @mysql_query($query);
?>
<div style="width:1000px;">
<?php

$count = 0;
while ($row = mysql_fetch_assoc($result)) { 
	$count++;  
	$code = $row['code'];
	switch ($code) {
		case 1:
  			$color = "darkblue";
  			break;
		case 2:
  			$color = "red";
  			break;    			
		case 3:
  			$color = "gray50";
  			break;	  			  			
		default:
  			$color = "black"; 
  			$code = "null";      
  	}	 
//    $k[$locus] = $row['locus'];
    $kk[$color] = $color;
//    echo $code; 
?>

    <div style="float:left;width:20px;height:20px;background-image: url(<?php echo $color; ?>.gif)"></div>

    
<?php } ?> 
</div>

</body>

</html>