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
<center><h1><a href="komp.php">Computers</a></h1>
<br/>
<table border=2px>

<td>Image</td>
<td>Name</td>
<td><button onclick="location.href='mobo_show.php'">Motherboard</button></td>
<td><button onclick="location.href='cpu_show.php'">CPU</button></td>
<td><button onclick="location.href='gpu_show.php'">Graphics cards</button></td>
<td><button onclick="location.href='hdd_show.php'">HDD</button></td>
<td><button onclick="location.href='ram_show.php'">RAM module #1</button></td>
<td><button onclick="location.href='ram_show.php'">RAM module #2</button></td>
<td><button onclick="location.href='ram_show.php'">RAM module #3</button></td>
<td><button onclick="location.href='ram_show.php'">RAM module #4</button></td>
<td><button onclick="location.href='psu_show.php'">PSU</button></td>


<?php
$con=mysqli_connect('localhost','root','','hardware');
if($con)
{
	$query = mysqli_query($con,"SELECT * FROM komputer");
	while($row = mysqli_fetch_row($query))
	{
		echo "<tr><td><img src='$row[11]' alt='No Image' style='max-width:100px; max-height:100px;'/></td><td>$row[1]</td>";
		
		//MOBO
		if($row[2]==0)
		{
			echo "<td style='color:red'>no motherboard</td>";
		}
		else
		{
			$query1 = mysqli_query($con,"SELECT producent,model,ramilosc FROM mobo where id='$row[2]'");
			if(mysqli_num_rows($query1)!=0)
			{
				while($row1 = mysqli_fetch_row($query1))
				{
					echo "<td>$row1[0] $row1[1]</td>";
					$ramilosc[$row[0]]=$row1[2];
				}
			}
			else
				echo "<td style='color:red'>no motherboard</td>";
		}
		
		//CPU
		if($row[3]==0)
		{
			echo "<td style='color:red'>no CPU</td>";
		}
		else
		{
			$query1 = mysqli_query($con,"SELECT producent,model,taktowanie,rdzenie,watki FROM cpu where id='$row[3]'");
			if(mysqli_num_rows($query1)!=0)
			{
				while($row1 = mysqli_fetch_row($query1))
				{
					echo "<td>$row1[0] $row1[1] <span style='color:green'>$row1[2]MHZ $row1[3]/$row1[4]</span></td>";
				}
			}
			else
				echo "<td style='color:red'>no CPU</td>";
		}
		
		//GPU
		if($row[4]==0)
		{
			echo "<td style='color:red'>no graphics card</td>";
		}
		else
		{
			$query1 = mysqli_query($con,"SELECT producent,model,pamiec FROM gpu where id='$row[4]'");
			if(mysqli_num_rows($query1)!=0)
			{
				while($row1 = mysqli_fetch_row($query1))
				{
					echo "<td>$row1[0] $row1[1] <span style='color:green'>$row1[2]MB</span></td>";
				}
			}
			else 
				echo "<td style='color:red'>no graphics card</td>";
		}
		
		//HDD
		if($row[5]==0)
		{
			echo "<td style='color:red'>no HDD</td>";
		}
		else
		{
			$query1 = mysqli_query($con,"SELECT producent,model,pojemnosc FROM hdd where id='$row[5]'");
			if(mysqli_num_rows($query1)!=0)
			{
				while($row1 = mysqli_fetch_row($query1))
				{
					echo "<td>$row1[0] $row1[1] <span style='color:green'>$row1[2]GB</span></td>";
				}
			}
			else 
				echo "<td style='color:red'>no HDD</td>";
		}
		
		//RAM
		for($i=0;$i<4;$i++)
		{
			if($row[6+$i]==0)
			{
				if($ramilosc[$row[0]]>=$i+1)
					echo "<td style='color:red'>no module</td>";
				else
					echo "<td style='color:gray'>no Slot</td>";
				
			}
			else
			{
				$k=6+$i;
				$query1 = mysqli_query($con,"SELECT producent,pamiec FROM ram where id='$row[$k]'");
				if(mysqli_num_rows($query1)!=0)
				{
					while($row1 = mysqli_fetch_row($query1))
					{
						echo "<td>$row1[0] <span style='color:green'>$row1[1]MB</span></td>";
					}
				}
				else
					echo "<td style='color:red'>no module</td>";
			}	
		}
		
		//PSU
		if($row[10]==0)
		{
			echo "<td style='color:red'>no PSU</td>";
		}
		else
		{
			$query1 = mysqli_query($con,"SELECT producent,model,moc FROM psu where id='$row[10]'");
			if(mysqli_num_rows($query1)!=0)
			{
				while($row1 = mysqli_fetch_row($query1))
				{
					echo "<td>$row1[0] $row1[1] <span style='color:green'>$row1[2]W</span></td>";
				}
			}
			else 
				echo "<td style='color:red'>no PSU</td>";
		}
		
		//"<td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5] MHz</td><td>$row[6]</td><td>$row[7] bit</td></tr>";
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