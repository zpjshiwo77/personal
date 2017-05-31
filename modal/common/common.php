<?php
//转义sql语句
function escaped($s,$conn){
	if (get_magic_quotes_gpc()) 
	{
	  $s = stripslashes($s);
	}
	$s = mysqli_real_escape_string($conn, $s);
	return $s;
}//end func
?>