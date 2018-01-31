<?php
$i=0;
foreach (glob("logs/*.html") as $filename)
{
		unlink($filename);
		$i++;
}
echo "Deleted posts: ".$i.".<br/>";
echo "<a href='index.php'>Back to main page</a>"

?>