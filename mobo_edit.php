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
	$query3 = mysqli_query($con,"DELETE FROM mobo WHERE id=$delete");
}
?>


<div class="edit">
<center>
<h1><a href="mobo.php">Edit motherboards</a></h1>
<br/>
<table border=2px>

<thead><tr><td>Producer</td><td>Model</td><td>Delete element</td></tr></thead>
<?php
if($con)
{
	$query = mysqli_query($con,"SELECT * FROM mobo");
	
	while($row = mysqli_fetch_row($query))
	{
		
		echo "<tr style='background-color:#440; color:#ff3';> ";
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