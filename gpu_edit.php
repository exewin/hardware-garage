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
	$query3 = mysqli_query($con,"DELETE FROM gpu WHERE id=$delete");
}
?>


<div class="edit">
<center>
<h1><a href="gpu.php">Edit graphics card</a></h1>
<br/>
<table border=2px>

<thead><tr><td>Producer</td><td>Model</td><td>Delete element</td></tr></thead>
<?php
if($con)
{
	$query = mysqli_query($con,"SELECT * FROM gpu");
	
	while($row = mysqli_fetch_row($query))
	{
		
		if($row[8]=="Nvidia"){echo "<tr style='background-color:#040; color:#3f3';> ";} else if($row[8]=="AMD" || $row[8]=="ATI") {echo "<tr style='background-color:#400; color:#f33';>";} else { echo "<tr style='background-color:#404; color:#f3f';>";}
		echo "<td>$row[1]</td><td>$row[2]</td>";
		//<td><select name='polozenie' onchange='this.form.submit()'>";
		
		//echo "<option value=0>free</option>";
		
		$query2 = mysqli_query($con,"SELECT id,producent,model FROM mobo WHERE gniazdo='$row[6]'");
		while($row2 = mysqli_fetch_row($query2))
		{
			echo "<option value='$row2[0]'";
			
			
			if ($row[8] == $row2[0])
			{
					echo " selected ";
			}
			
			
			echo ">$row2[1] $row2[2]</option>";
		}
		
		echo "</select></form></td>";
		
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