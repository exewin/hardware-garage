<html>

<head>
<meta charset="UTF-8" name="Hardware Exewin" content="Hardware">
<title>HG</title>
<link rel="Stylesheet" href="style/style.css">
</head>

<body>

<?php 
include 'title.php';
include 'menu.php';
$con=mysqli_connect('localhost','root','','hardware');
$delete=0;
if(isset($_POST['delete']))
{
	$delete = $_POST['delete'];
	$query3 = mysqli_query($con,"DELETE FROM cpu WHERE id=$delete");
}

?>


<div class="edit">
<center><h1><a href="cpu.php">Edit CPU</a></h1>
<br/>
<table border=2px>

<thead><tr><td>Producer</td><td>Model</td><td>Delete element</td></tr></thead>
<?php
if($con)
{
	$query = mysqli_query($con,"SELECT * FROM cpu");
	
	while($row = mysqli_fetch_row($query))
	{
		//invisible $row[0] for update submit
		echo "<form method='POST'><input style='display:none' type='text' name='id' value='$row[0]'/>";
		
		if($row[1]=="Intel"){echo "<tr style='background-color:#004; color:#33f';> ";} else {echo "<tr style='background-color:#400; color:#f33';>";}
		echo "<td>$row[1]</td><td>$row[2]</td>";
		
		echo "<td><center><form method='POST'><button type='submit' name='delete' value='$row[0]'>Delete</button></form></center></td></tr>";
	}
	
	mysqli_close($con);
}
else
	echo 'Database error.';
?>
</table>

</center>
</div>


<?php 
include 'footer.php';
?>

</body>

</html>


<script>
function disable()
{
	document.getElementById("cmd").style.display = "none";
}
</script>