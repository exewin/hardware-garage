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
<h1><a href="mobo.php">Motherboards</a></h1>
<br/>
<table border=2px>


<thead><tr><form action="mobo_show.php" method="GET">
<td>Image</td>
<td><button type="submit" name="order" value="producent">Producer</button></td>
<td><button type="submit" name="order" value="model">Model</button></td>
<td><button type="submit" name="order" value="gniazdo">Socket</button></td>
<td><button type="submit" name="order" value="pci">PCI</button></td>
<td><button type="submit" name="order" value="agp">AGP</button></td>
<td><button type="submit" name="order" value="pcie">PCIE</button></td>
<td><button type="submit" name="order" value="ata">ATA</button></td>
<td><button type="submit" name="order" value="sata">SATA</button></td>
<td><button type="submit" name="order" value="ramtyp">RAM memory type</button></td>
<td><button type="submit" name="order" value="ramilosc">RAM slots</button></td>
</form></tr></thead>
<?php
$con=mysqli_connect('localhost','root','','hardware');
if($con)
{
	
	if(isset($_GET['order']))
	{
		$ord = $_GET['order'];
		$query=mysqli_query($con,"SELECT * FROM mobo ORDER BY $ord DESC");
	}
	else
	{
		$query = mysqli_query($con,"SELECT * FROM mobo");
	}

	while($row = mysqli_fetch_row($query))
	{
		echo "<tr style='background-color:#440; color:#ff3';> ";
		echo "<td><img src='$row[11]' alt='No Image' style='max-width:100px; max-height:100px;'/></td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td>";
		for($i=0;$i<5;$i++)
		{
			if($row[4+$i]==0)
				echo "<td>NO</td>";
			else
				echo "<td>YES</td>";
		}
		echo "<td>$row[9]</td><td>$row[10]</td></tr>";
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