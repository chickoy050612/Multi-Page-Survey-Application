<?php
function displayErrors($errs){
	echo "<div>\n";
	echo "<h2> This form contains the following errors</h2>\n";
	echo "<ul>\n";
	foreach ($errs as $err){
		echo "<li style='color:red'>".$err."</li>\n";
	}
	echo "</ul>\n";
	echo "</div>\n";
}
?>
