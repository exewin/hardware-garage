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
<h1><a href="gpu.php">Graphics cards</a></h1>
<br/>
<table border=2px>

<thead><tr><form action="gpu_show.php" method="GET">
<td>Image</td>
<td><button type="submit" name="order" value="producentgpu">GPU Producer</button></td>
<td><button type="submit" name="order" value="producent">Producer</button></td>
<td><button type="submit" name="order" value="model">Model</button></td>
<td><button type="submit" name="order" value="pamiec">Memory</button></td>
<td><button type="submit" name="order" value="zlacze">Interface</button></td>
<td><button type="submit" name="order" value="dsub">D-SUB</button></td>
<td><button type="submit" name="order" value="dvi">DVI</button></td>
<td><button type="submit" name="order" value="hdmi">HDMI</button></td>
</tr></thead>
<?php
$con=mysqli_connect('localhost','root','','hardware');
if($con)
{
	if(isset($_GET['order']))
	{
		$ord = $_GET['order'];
		$query=mysqli_query($con,"SELECT * FROM gpu ORDER BY $ord DESC");
	}
	else
	{
		$query = mysqli_query($con,"SELECT * FROM gpu");
	}
	
	while($row = mysqli_fetch_row($query))
	{
		if($row[8]=="Nvidia"){echo "<tr style='background-color:#040; color:#3f3';> ";} else if($row[8]=="AMD" || $row[8]=="ATI") {echo "<tr style='background-color:#400; color:#f33';>";} else { echo "<tr style='background-color:#404; color:#f3f';>";}
		echo "<td><img src='$row[9]' alt='No Image' style='max-width:100px; max-height:100px;'/></td><td>$row[8]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3] MB</td><td>$row[4]</td>";
		for($i=0;$i<3;$i++)
		{
			if($row[5+$i]==0)
				echo "<td>NO</td>";
			else
				echo "<td>YES</td>";
		}
		/* mobo
		$query2 = mysqli_query($con,"SELECT producent,model FROM mobo WHERE id='$row[8]'");
		echo "<td>";
		while($row2 = mysqli_fetch_row($query2))
		{
			echo "$row2[0] $row2[1]";
		}
		echo "</td></tr>";
		*/
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