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




<?php
$img=null;
if($_POST)
{
	$pro = $_POST['producent'];
	$mod = $_POST['model'];
	$int = $_POST['interfejs'];
	$poj = $_POST['pojemnosc'];
	$img = $_POST['img'];
}
?>

<form method='POST'>

<div class="dane">
<center><h1><a href="hdd.php">Add new HDD</a></h1></center>
<br/>
<table>

<tr><td>Producer:</td><td><input type='text' name="producent" placeholder="ex. Seagate" value="<?php if(isset($_POST['producent'])){ echo $pro; }?>"/></td></tr>

<tr><td>Model:</td><td><input type='text' name="model" placeholder="ex. Barracuda" value="<?php if(isset($_POST['model'])){ echo $mod; }?>"/></td></tr>

<tr>
<td>Interface:</td>
<td><select name='interfejs'>
<option value='ATA'>ATA</option>
<option value='SATA' <?php if (isset($_POST['interfejs'])) { echo ($_POST['interfejs'] == 'SATA' ? ' selected' : ''); } ?>>SATA</option>
</select></td>
</tr>

<tr><td>Space(GB):</td><td><input type='text' name="pojemnosc" placeholder="ex. 1000(1TB)" value="<?php if(isset($_POST['pojemnosc'])){ echo $poj; }?>"/></td></tr>

<tr><td>Image*:</td><td><input type='text' name="img" placeholder="link" value="<?php if(isset($_POST['img'])){ echo $img; }?>"/></td></tr>



<tr><td></td><td><input type="submit" name="submit" value="Dodaj"/></td></tr>

</table>



</form>


<!-- helpful cmd -->
<div class="cmd" id="cmd">
<table>
<tr>
<td>
<div class="cmd_title">
HardwareCMD
<div class="cmd_title_button">
<button type='button' class='exit' onClick="disable()">×</button>
</div>
</div>
<br/>
<div class="cmd_content">
<?php
echo "C:\>";
if($_POST)
{
	$allow=true;
	echo "hdd add ";

	echo "'$pro' "; 
	echo "'$mod' "; 
	echo "'$int' "; 
	echo "'$poj' "; 	
	echo "'$img' "; 	
	echo "<br/>";
	echo "<br/>";
	
	//producent null
	if($pro==null)
	{
		echo "'producent' argument cannot be null."; 
		$allow=false;
	}
	//model null
	if($mod==null)
	{
		echo "'model' argument cannot be null."; 
		$allow=false;
	}
	//pojemnosc null
	else if($poj==null)
	{
		echo "'pojemnosc' argument cannot be null."; 
		$allow=false;
	}
	//pojemnosc not numeric
	else if(is_numeric($poj)==false)
	{
		echo "'pojemnosc' argument must be numeric."; 
		$allow=false;
	}
	
	echo "<br/>";
	echo "<br/>";
	
		
	if($allow==false)
		echo "Syntax Error.";
	else
	{
		$con = mysqli_connect('localhost', 'root', '', 'hardware');
		if($con)
		{
			//INSERT INTO...
			$query="INSERT INTO `hdd` (`id`, `producent`, `model`, `interfejs`, `pojemnosc`, `img`)
			VALUES (NULL, '$pro', '$mod', '$int', '$poj', '$img')";
			
			mysqli_query($con, $query);
			echo "$pro $mod added to database.";

			$myfile = fopen("logs/".date("Y-m-d")."_".date("h-i-sa").".html", "w") or die("Unable to open file!");
			
			$txt = date("Y-m-d")." ".date("h:i:sa").":\n"; //date
			fwrite($myfile, $txt);
			$txt = "Added $pro $mod to Database"; //action
			fwrite($myfile, $txt);
			
			fclose($myfile);

			
			mysqli_close($con);
		}
		else
			echo "Database error.";
	}
	
}
?>
</div>
</td>
</tr>
</table>
</div></div>
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