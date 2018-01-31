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
$ramammount=0;
$delete=0;
if(isset($_POST['delete']))
{
	$delete = $_POST['delete'];
	$query3 = mysqli_query($con,"DELETE FROM komputer WHERE id=$delete");
}

if(isset($_POST['mobo']))
{
	$update = $_POST['mobo'];
	$id = $_POST['id'];
	$query5 = mysqli_query($con,"UPDATE komputer SET cpu_id=0,gpu_id=0,hdd_id=0,psu_id=0,ram0_id=0,ram1_id=0,ram2_id=0,ram3_id=0 WHERE id = '$id'");
	$query4 = mysqli_query($con,"UPDATE komputer SET plyta_id='$update' WHERE id = '$id'");

}
if(isset($_POST['cpu']))
{
	$update = $_POST['cpu'];
	$id = $_POST['id'];
	$query4 = mysqli_query($con,"UPDATE komputer SET cpu_id='$update' WHERE id = '$id'");
}
if(isset($_POST['gpu']))
{
	$update = $_POST['gpu'];
	$id = $_POST['id'];
	$query4 = mysqli_query($con,"UPDATE komputer SET gpu_id='$update' WHERE id = '$id'");
}
if(isset($_POST['hdd']))
{
	$update = $_POST['hdd'];
	$id = $_POST['id'];
	$query4 = mysqli_query($con,"UPDATE komputer SET hdd_id='$update' WHERE id = '$id'");
}
if(isset($_POST['psu']))
{
	$update = $_POST['psu'];
	$id = $_POST['id'];
	$query4 = mysqli_query($con,"UPDATE komputer SET psu_id='$update' WHERE id = '$id'");
}
for($i=0;$i<4;$i++)
{
	if(isset($_POST['ram'."$i"]))
	{
		$update = $_POST['ram'."$i"];
		$id = $_POST['id'];
		$query4 = mysqli_query($con,"UPDATE komputer SET ram".$i."_id='$update' WHERE id = '$id'");
	}
}
?>


<div class="edit">
<center>
<h1><a href="komp.php">Edit Computers</a></h1>
<br/>
<table border=2px>
<h3>WARNING! Changing motherboard will erase other information.</h3>
<thead><tr><td>Name</td><td>Motherboard</td><td>CPU</td><td>Graphics cards</td><td>HDD</td><td>RAM #0</td><td>RAM #1</td><td>RAM #2</td><td>RAM #3</td><td>PSU</td><td>Delete element</td></tr></thead>
<?php
if($con)
{
	$query = mysqli_query($con,"SELECT * FROM komputer");
	
	while($row = mysqli_fetch_row($query))
	{
		$curid=$row[0];
		echo "<tr style='background-color:#404; color:#f3f';> ";
		echo "<td>$row[1]</td>";
		
		$query6 = mysqli_query($con,"SELECT plyta_id FROM komputer WHERE id='$curid'");
		while($row2 = mysqli_fetch_row($query6))
		{
			if($row2!=0)
			{
				$query5 = mysqli_query($con,"SELECT ramilosc FROM mobo WHERE id = '$row[2]'");	
				while($row3 = mysqli_fetch_row($query5))	
				{						
					$ramammount=$row3[0];
				}

			}
			else 
			{
				$ramammount=0;
			}
		}
		
		for($i=0;$i<9;$i++)
		{

			//invisible $row[0] for update submit
			echo "<form method='POST'><input style='display:none' type='text' name='id' value='$row[0]'/>";
			
			if($i==0)
			{
				echo "<td><select name='mobo' onchange='this.form.submit()'>";
				$query2 = mysqli_query($con,"SELECT id,producent,model FROM mobo");
			}
			else if($i==1)
			{
				echo "<td><select name='cpu' onchange='this.form.submit()'>";
				$query2 = mysqli_query($con,
				"SELECT
					 t1.id, t1.producent, t1.model
				FROM
					 cpu AS t1, 
					 mobo AS t2, 
					 komputer AS t3
				WHERE 
					 t1.gniazdo = t2.gniazdo
				AND  t2.id = t3.plyta_id
				AND  t3.id = '$curid'
				");
			}
			else if($i==2)
			{
				echo "<td><select name='gpu' onchange='this.form.submit()'>";
				$query2 = mysqli_query($con,
				"SELECT
					 t1.id, t1.producent, t1.model
				FROM
					 gpu AS t1, 
					 mobo AS t2, 
					 komputer AS t3
				WHERE 
					 t1.zlacze = 'PCI' AND t2.pci = 1 AND t2.id = t3.plyta_id  AND  t3.id = '$curid'
                     OR
                     t1.zlacze = 'AGP' AND t2.agp = 1 AND t2.id = t3.plyta_id  AND  t3.id = '$curid'
                     OR
                     t1.zlacze = 'PCIE' AND t2.pcie = 1 AND t2.id = t3.plyta_id  AND  t3.id = '$curid'
				");
			}
			else if($i==3)
			{
				echo "<td><select name='hdd' onchange='this.form.submit()'>";
				$query2 = mysqli_query($con,
				"SELECT
					 t1.id, t1.producent, t1.model
				FROM
					 hdd AS t1, 
					 mobo AS t2, 
					 komputer AS t3
				WHERE 
					 t1.interfejs = 'ATA' AND t2.ata = 1 AND t2.id = t3.plyta_id  AND  t3.id = '$curid'
                     OR
                     t1.interfejs = 'SATA' AND t2.sata = 1 AND t2.id = t3.plyta_id  AND  t3.id = '$curid'

				");
			}
			else if($i==8)
			{
				echo "<td><select name='psu' onchange='this.form.submit()'>";
				$query2 = mysqli_query($con,"SELECT id,producent,model FROM psu");
			}
			else if($i<8&&$ramammount>($i-4))
			{
		
				$query2 = mysqli_query($con,
				"SELECT
					 t1.id, t1.producent, t1.model
				FROM
					 ram AS t1, 
					 mobo AS t2, 
					 komputer AS t3
				WHERE 
					 t1.typ = 'SDR' AND t2.ramtyp = 'SDR' AND t2.id = t3.plyta_id  AND  t3.id = '$curid'
                     OR
                     t1.typ = 'DDR' AND t2.ramtyp = 'DDR' AND t2.id = t3.plyta_id  AND  t3.id = '$curid'
                     OR
                     t1.typ = 'DDR2' AND t2.ramtyp = 'DDR2' AND t2.id = t3.plyta_id  AND  t3.id = '$curid'
                     OR					 
					 t1.typ = 'DDR3' AND t2.ramtyp = 'DDR3' AND t2.id = t3.plyta_id  AND  t3.id = '$curid'
                     OR
                     t1.typ = 'DDR4' AND t2.ramtyp = 'DDR4' AND t2.id = t3.plyta_id  AND  t3.id = '$curid'
				");
				echo "<td><select name='"."ram".($i-4)."' onchange='this.form.submit()'>";
			}
			else
				echo "<td>Slot nie istnieje</td>";
			if($i<8&&$ramammount<=($i-4))
			echo "";
			else
			echo "<option value=0>Brak</option>";

			while($row2 = mysqli_fetch_row($query2))
			{
				echo "<option value='$row2[0]'";
				
				
				if ($row[2+$i] == $row2[0])
				{
						echo " selected ";
				}
				
				
				echo ">$row2[1] $row2[2]</option>";
			}
			
			echo "</select></form></td>";
		}
		
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