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
	$typ = $_POST['typ'];
	$pam = $_POST['pamiec'];
	$img = $_POST['img'];
}
?>

<form method='POST'>

<div class="dane">
<center><h1><a href="ram.php">Add new RAM module</a></h1></center>
<br/>
<table>

<tr><td>Producer:</td><td><input type='text' name="producent" placeholder="ex. Kingston" value="<?php if(isset($_POST['producent'])){ echo $pro; }?>"/></td></tr>

<tr><td>Model*:</td><td><input type='text' name="model" placeholder="ex. HyperX" value="<?php if(isset($_POST['model'])){ echo $mod; }?>"/></td></tr>

<tr>
<td>Type:</td>
<td><select name='typ'>
<option value='SDR'>SDR</option>
<option value='DDR' <?php if (isset($_POST['typ'])) { echo ($_POST['typ'] == 'DDR' ? ' selected' : ''); } ?>>DDR</option>
<option value='DDR2' <?php if (isset($_POST['typ'])) { echo ($_POST['typ'] == 'DDR2' ? ' selected' : ''); } ?>>DDR2</option>
<option value='DDR3' <?php if (isset($_POST['typ'])) { echo ($_POST['typ'] == 'DDR3' ? ' selected' : ''); } ?>>DDR3</option>
<option value='DDR4' <?php if (isset($_POST['typ'])) { echo ($_POST['typ'] == 'DDR4' ? ' selected' : ''); } ?>>DDR4</option>
</select></td>
</tr>

<tr><td>Memory(MB):</td><td><input type='text' name="pamiec" placeholder="ex. 4096" value="<?php if(isset($_POST['pamiec'])){ echo $pam; }?>"/></td></tr>

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
	echo "ram add ";

	echo "'$pro' "; 
	echo "'$mod' "; 
	echo "'$typ' "; 
	echo "'$pam' "; 	
	echo "'$img' "; 	
	echo "<br/>";
	echo "<br/>";
	
	//model null
	if($pro==null)
	{
		echo "'producent' argument cannot be null."; 
		$allow=false;
	}
	//pamiec null
	else if($pam==null)
	{
		echo "'pamiec' argument cannot be null."; 
		$allow=false;
	}
	//pamiec not numeric
	else if(is_numeric($pam)==false)
	{
		echo "'pamiec' argument must be numeric."; 
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
			$query="INSERT INTO `ram` (`id`, `producent`, `model`, `typ`, `pamiec`, `img`)
			VALUES (NULL, '$pro', '$mod', '$typ', '$pam', '$img')";
			
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