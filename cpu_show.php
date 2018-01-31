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
<center><h1><a href="cpu.php">CPUs</a></h1>
<br/>
<table border=2px>


<thead><tr><form action="cpu_show.php" method="GET">
<td>Image</td>
<td><button type="submit" name="order" value="producent">Producer</button></td>
<td><button type="submit" name="order" value="model">Model</button></td>
<td><button type="submit" name="order" value="rdzenie">Cores</button></td>
<td><button type="submit" name="order" value="watki">Threads</button></td>
<td><button type="submit" name="order" value="taktowanie">Clock rate</button></td>
<td><button type="submit" name="order" value="gniazdo">Socket</button></td>
<td><button type="submit" name="order" value="architektura">Architecture</button></td>
</form></tr></thead>
<?php
$con=mysqli_connect('localhost','root','','hardware');
if($con)
{
	
	if(isset($_GET['order']))
	{
		$ord = $_GET['order'];
		$query=mysqli_query($con,"SELECT * FROM cpu ORDER BY $ord DESC");
	}
	else
	{
		$query = mysqli_query($con,"SELECT * FROM cpu");
	}

	while($row = mysqli_fetch_row($query))
	{
		if($row[1]=="Intel"){echo "<tr style='background-color:#004; color:#33f';> ";} else {echo "<tr style='background-color:#400; color:#f33';>";}
		echo "<td><img src='$row[8]' alt='No Image' style='max-width:100px; max-height:100px;'/></td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5] MHz</td><td>$row[6]</td><td>$row[7] bit</td></tr>";
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