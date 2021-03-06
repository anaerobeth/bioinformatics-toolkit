<!-- This program maps the Illumina sequencing reads to the bacterial genome of P. gingivalis

Copyright 2012 Elizabeth Tenorio

Steps:
Upload W83 and 33277 sql tables to phpMyAdmin database pn_tnseq2013:  
33277genes and w83genes
fields include name, function, orientation, start, end

Import excel files from galaxyupload: tnreads527 etc
add id as index, not null autoincrement

Use php script to match insertion to gene name

Open web browser and run this script:
http://old.beth:8888/scripts/mapToGene.php

Copy the result, replace extra text with tabs then transfer to Excel
-->



<?php
// program to loop through sample positions and match to gene name and function based on dansearch2.php
$databasename = "pn_tnseq2013";
$databaseusername ="root";
$databasepassword = "root";
$con = @mysql_connect($databasehost,$databaseusername,$databasepassword) or die(mysql_error());
@mysql_select_db($databasename) or die(mysql_error());

// pull data from gene and sample tables        
$query = "SELECT * from w83genes";
$result1 = @mysql_query($query);

$query2 = "SELECT * from tnreads527";
$result2 = @mysql_query($query2);
         
@mysql_close($con);

// build arrays from gene and position tables
while($r1[]=mysql_fetch_assoc($result1));
while($r2[]=mysql_fetch_assoc($result2));

$new = array();

// get sample position and find the corresponding gene name and function 
// by comparing the start and end positions of the gene
foreach ($r2 as $k => $v) {
		$id 	= $r2[$k]['id'];
		$read   = $r2[$k]['reads'];
		$pos 	= $r2[$k]['insertion'];
		$new[$id] = array('position' => '', 'name' => '', 'function' => $func );
	foreach ($r1 as $kk => $vv) {
		$start 	= $r1[$kk]['start'];
		$end 	= $r1[$kk]['end'];
		$gname 	= $r1[$kk]['name'];
		$func	= $r1[$kk]['function'];

		// build an array if a match is found then exit
		if ($pos >= $start && $pos <= $end) {
					//		echo "found $id $gname $pos // $kk <br>";	
			$new[$id] = array('position' => $pos, 'name' => $gname, 'function' => $func);

			break;
		}  

	}		
}

 echo "<pre>";
 print_r($new);
 echo "</pre>";
?>
