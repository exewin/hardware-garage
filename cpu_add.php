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
	$rdz = $_POST['rdzenie'];
	$wat = $_POST['watki'];
	$tak = $_POST['taktowanie'];
	$gni = $_POST['gniazdo'];
	$arc = $_POST['architektura'];
	$img = $_POST['img'];
}
?>

<form method='POST'>

<div class="dane">
<center><h1><a href="cpu.php">Add new CPU</a></h1></center>
<br/>
<table>

<tr>
<td>Producer:</td>
<td><select name='producent'>
<option value='Intel'>Intel</option>
<option value='AMD' <?php if (isset($_POST['producent'])) { echo ($_POST['producent'] == 'AMD' ? ' selected' : ''); } ?>>AMD</option>
</select></td>
</tr>

<tr><td>Model:</td><td><input type='text' name="model" placeholder="ex. i5-8400" value="<?php if(isset($_POST['model'])){ echo $mod; }?>"/></td></tr>

<tr>
<td>Cores:</td>
<td><select name='rdzenie'>
<option value='1'>1</option>
<option value='2' <?php if (isset($_POST['rdzenie'])) { echo ($_POST['rdzenie'] == '2' ? ' selected' : ''); } ?>>2</option>
<option value='4' <?php if (isset($_POST['rdzenie'])) { echo ($_POST['rdzenie'] == '4' ? ' selected' : ''); } ?>>4</option>
<option value='8' <?php if (isset($_POST['rdzenie'])) { echo ($_POST['rdzenie'] == '8' ? ' selected' : ''); } ?>>8</option>
</select></td>
</tr>

<tr>
<td>Threads:</td>
<td><select name='watki'>
<option value='1'>1</option>
<option value='2' <?php if (isset($_POST['watki'])) { echo ($_POST['watki'] == '2' ? ' selected' : ''); } ?>>2</option>
<option value='4' <?php if (isset($_POST['watki'])) { echo ($_POST['watki'] == '4' ? ' selected' : ''); } ?>>4</option>
<option value='8' <?php if (isset($_POST['watki'])) { echo ($_POST['watki'] == '8' ? ' selected' : ''); } ?>>8</option>
</select></td>
</tr>

<tr><td>Clock rate(MHz):</td><td><input type='text' name="taktowanie" placeholder="ex. 3200" value="<?php if(isset($_POST['taktowanie'])){ echo $tak; }?>"/></td></tr>

<tr><td>Socket:</td><td><input type='text' name="gniazdo" placeholder="ex. LGA 1151" value="<?php if(isset($_POST['gniazdo'])){ echo $gni; }?>"/></td></tr>

<tr>
<td>Architecture:</td>
<td><select name='architektura'>
<option value='32'>32 bit</option>
<option value='64'  <?php if (isset($_POST['architektura'])) { echo ($_POST['architektura'] == '64' ? ' selected' : ''); } ?>>64 bit</option>
</select></td>
</tr>

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
	echo "cpu add ";

	echo "'$pro' "; 
	echo "'$mod' "; 
	echo "'$rdz' "; 
	echo "'$wat' "; 	
	echo "'$tak' "; 
	echo "'$gni' ";
	echo "'$arc' ";
	echo "'$img' "; 	
	echo "<br/>";
	echo "<br/>";
	
	//model null
	if($mod==null)
	{
		echo "'model' argument cannot be null."; 
		$allow=false;
	}
	//taktowanie null
	else if($tak==null)
	{
		echo "'taktowanie' argument cannot be null."; 
		$allow=false;
	}
	//taktowanie not numeric
	else if(is_numeric($tak)==false)
	{
		echo "'taktowanie' argument must be numeric."; 
		$allow=false;
	}
	//gniazdo null
	else if($gni==null)
	{
		echo "'gniazdo' argument cannot be null."; 
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
			$query="INSERT INTO `cpu` (`id`, `producent`, `model`, `rdzenie`, `watki`, `taktowanie`, `gniazdo`, `architektura`, `img`)
			VALUES (NULL, '$pro', '$mod', '$rdz', '$wat', '$tak', '$gni', '$arc', '$img')";
			
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