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
<h1><a href="hdd.php">HDDs</a></h1>
<br/>
<table border=2px>


<thead><tr><form action="hdd_show.php" method="GET">
<td>Image</td>
<td><button type="submit" name="order" value="producent">Producer</button></td>
<td><button type="submit" name="order" value="model">Model</button></td>
<td><button type="submit" name="order" value="interfejs">Interface</button></td>
<td><button type="submit" name="order" value="pojemnosc">Space</button></td>
</form></tr></thead>
<?php
$con=mysqli_connect('localhost','root','','hardware');
if($con)
{
	
	if(isset($_GET['order']))
	{
		$ord = $_GET['order'];
		$query=mysqli_query($con,"SELECT * FROM hdd ORDER BY $ord DESC");
	}
	else
	{
		$query = mysqli_query($con,"SELECT * FROM hdd");
	}

	while($row = mysqli_fetch_row($query))
	{
		echo "<tr style='background-color:#044; color:#3ff';> ";
		echo "<td><img src='$row[5]' alt='No image' style='max-width:100px; max-height:100px;'/></td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4] GB</td>";
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