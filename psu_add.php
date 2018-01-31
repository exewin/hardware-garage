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
	$moc = $_POST['moc'];
	$img = $_POST['img'];
}
?>

<form method='POST'>

<div class="dane">
<center><h1><a href="psu.php">Add new PSU</a></h1></center>
<br/>
<table>

<tr><td>Producer:</td><td><input type='text' name="producent" placeholder="ex. be quiet!" value="<?php if(isset($_POST['producent'])){ echo $pro; }?>"/></td></tr>

<tr><td>Model*:</td><td><input type='text' name="model" placeholder="ex. Pure Power 10" value="<?php if(isset($_POST['model'])){ echo $mod; }?>"/></td></tr>

<tr><td>Power(W):</td><td><input type='text' name="moc" placeholder="ex. 500" value="<?php if(isset($_POST['moc'])){ echo $moc; }?>"/></td></tr>

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
	echo "psu add ";

	echo "'$pro' "; 
	echo "'$mod' "; 
	echo "'$moc' "; 	
	echo "'$img' "; 	
	echo "<br/>";
	echo "<br/>";
	
	//producent null
	if($pro==null)
	{
		echo "'producent' argument cannot be null."; 
		$allow=false;
	}
	//moc null
	else if($moc==null)
	{
		echo "'moc' argument cannot be null."; 
		$allow=false;
	}
	//moc not numeric
	else if(is_numeric($moc)==false)
	{
		echo "'moc' argument must be numeric."; 
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
			$query="INSERT INTO `psu` (`id`, `producent`, `model`, `moc`, `img`)
			VALUES (NULL, '$pro', '$mod', '$moc', '$img')";
			
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