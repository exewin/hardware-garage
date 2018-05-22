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
if($_POST)
{
	//checkbox error corection
	$dsu = 0;
	$dvi = 0;
	$hdm = 0;
	//
	
	$gpu = $_POST['gpuproducent'];
	$img = $_POST['img'];
	$pro = $_POST['producent'];
	$mod = $_POST['model'];
	$pam = $_POST['pamiec'];
	$zla = $_POST['zlacze'];
	if(isset($_POST['dsub'])){$dsu = $_POST['dsub'];}
	if(isset($_POST['dvi'])){$dvi = $_POST['dvi'];}
	if(isset($_POST['hdmi'])){$hdm = $_POST['hdmi'];}
}
?>

<form method='POST'>

<div class="dane">
<center><h1><a href="gpu.php">Add new graphics cards</a></h1></center>
<br/>
<table>

<tr>
<td>GPU producer:</td>
<td><select name='gpuproducent'>
<option value='Nvidia'>Nvidia</option>
<option value='AMD' <?php if (isset($_POST['gpuproducent'])) { echo ($_POST['gpuproducent'] == 'AMD' ? ' selected' : ''); } ?>>AMD</option>
<option value='ATI' <?php if (isset($_POST['gpuproducent'])) { echo ($_POST['gpuproducent'] == 'ATI' ? ' selected' : ''); } ?>>ATI</option>
<option value='inny' <?php if (isset($_POST['gpuproducent'])) { echo ($_POST['gpuproducent'] == 'inny' ? ' selected' : ''); } ?>>Other</option>
</select></td>
</tr>

<tr><td>Model producer:</td><td><input type='text' name="producent" placeholder="ex. Gigabyte" value="<?php if(isset($_POST['producent'])){ echo $pro; }?>"/></td></tr>

<tr><td>Model:</td><td><input type='text' name="model" placeholder="ex. GeForce 550Ti" value="<?php if(isset($_POST['model'])){ echo $mod; }?>"/></td></tr>

<tr><td>Memory(MB):</td><td><input type='text' name="pamiec" placeholder="ex. 1024" value="<?php if(isset($_POST['pamiec'])){ echo $pam; }?>"/></td></tr>

<tr>
<td>Interface:</td>
<td><select name='zlacze'>
<option value='PCI'>PCI</option>
<option value='AGP'  <?php if (isset($_POST['zlacze'])) { echo ($_POST['zlacze'] == 'AGP' ? ' selected' : ''); } ?>>AGP</option>
<option value='PCIE'  <?php if (isset($_POST['zlacze'])) { echo ($_POST['zlacze'] == 'PCIE' ? ' selected' : ''); } ?>>PCIE</option>
</select></td>
</tr>

<tr>
<td>D-SUB:</td>
<td><input type="checkbox" value='1' name='dsub'  <?php if (isset($_POST['dsub'])) { echo ($_POST['dsub'] == '1' ? ' checked' : ''); } ?>/></td>
</tr>

<tr>
<td>DVI:</td>
<td><input type="checkbox" value='1' name='dvi'  <?php if (isset($_POST['dvi'])) { echo ($_POST['dvi'] == '1' ? ' checked' : ''); } ?>/></td>
</tr>

<tr>
<td>HDMI:</td>
<td><input type="checkbox" value='1' name='hdmi'  <?php if (isset($_POST['hdmi'])) { echo ($_POST['hdmi'] == '1' ? ' checked' : ''); } ?>/></td>
</tr>

<tr><td>Image*:</td><td><input type='text' name="img" placeholder="link" value="<?php if(isset($_POST['img'])){ echo $img; }?>"/></td></tr>


<tr><td></td><td><input type="submit" name="submit" value="Add"/></td></tr>

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
	echo "gpu add ";

	echo "'$gpu' "; 
	echo "'$pro' "; 
	echo "'$mod' "; 
	echo "'$pam' "; 
	echo "'$zla' "; 	
	echo "'$dsu' "; 
	echo "'$dvi' ";
	echo "'$hdm' "; 
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
	else if($mod==null)
	{
		echo "'model' argument cannot be null."; 
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
	//not chosen any output interface
	else if($dsu==0&&$dvi==0&&$hdm==0)
	{
		echo "at least one interface must be marked."; 
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
			$query="INSERT INTO `gpu` (`id`, `producent`, `model`, `pamiec`, `zlacze`, `dsub`, `dvi`, `hdmi`, `producentgpu`, `img`)
			VALUES (NULL, '$pro', '$mod', '$pam', '$zla', '$dsu', '$dvi', '$hdm', '$gpu', '$img')";
			
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