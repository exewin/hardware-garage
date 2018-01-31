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
?>

<div class="show">
<center>
<h1><a href="ram.php">RAM modules</a></h1>
<br/>
<table border=2px>


<thead><tr><form action="ram_show.php" method="GET">
<td>Image</td>
<td><button type="submit" name="order" value="producent">Producer</button></td>
<td><button type="submit" name="order" value="model">Model</button></td>
<td><button type="submit" name="order" value="typ">Typ</button></td>
<td><button type="submit" name="order" value="pamiec">Memory</button></td>
</form></tr></thead>
<?php
$con=mysqli_connect('localhost','root','','hardware');
if($con)
{
	
	if(isset($_GET['order']))
	{
		$ord = $_GET['order'];
		$query=mysqli_query($con,"SELECT * FROM ram ORDER BY $ord DESC");
	}
	else
	{
		$query = mysqli_query($con,"SELECT * FROM ram");
	}

	while($row = mysqli_fetch_row($query))
	{
		echo "<tr style='background-color:#040; color:#3f3';> ";
		echo "<td><img src='$row[5]' alt='No Image' style='max-width:100px; max-height:100px;'/></td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4] MB</td>";
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