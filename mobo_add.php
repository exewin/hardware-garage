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
	$pci = 0;
	$agp = 0;
	$pcie = 0;
	$ata = 0;
	$sat = 0;
	//
	$pro = $_POST['producent'];
	$mod = $_POST['model'];
	$gni = $_POST['gniazdo'];
	if(isset($_POST['pci'])){$pci = $_POST['pci'];}
	if(isset($_POST['agp'])){$agp = $_POST['agp'];}
	if(isset($_POST['pcie'])){$pcie = $_POST['pcie'];}
	if(isset($_POST['ata'])){$ata = $_POST['ata'];}
	if(isset($_POST['sata'])){$sat = $_POST['sata'];}
	$typ = $_POST['ramtyp'];
	$ilo = $_POST['ramilosc'];
	$img = $_POST['img'];
}
?>

<form method='POST'>

<div class="dane">
<center><h1><a href="mobo.php">Add new motherboard</a></h1></center>
<br/>
<table>

<tr><td>Producer:</td><td><input type='text' name="producent" placeholder="ex. Gigabyte" value="<?php if(isset($_POST['producent'])){ echo $pro; }?>"/></td></tr>

<tr><td>Model:</td><td><input type='text' name="model" placeholder="ex. ga-g31m-es2l" value="<?php if(isset($_POST['model'])){ echo $mod; }?>"/></td></tr>

<tr><td>Socket:</td><td><input type='text' name="gniazdo" placeholder="ex. LGA 1150" value="<?php if(isset($_POST['gniazdo'])){ echo $gni; }?>"/></td></tr>

<tr>
<td>PCI:</td>
<td><input type="checkbox" value='1' name='pci'  <?php if (isset($_POST['pci'])) { echo ($_POST['pci'] == '1' ? ' checked' : ''); } ?>/></td>
</tr>

<tr>
<td>AGP:</td>
<td><input type="checkbox" value='1' name='agp'  <?php if (isset($_POST['agp'])) { echo ($_POST['agp'] == '1' ? ' checked' : ''); } ?>/></td>
</tr>

<tr>
<td>PCIE:</td>
<td><input type="checkbox" value='1' name='pcie'  <?php if (isset($_POST['pcie'])) { echo ($_POST['pcie'] == '1' ? ' checked' : ''); } ?>/></td>
</tr>

<tr>
<td>ATA:</td>
<td><input type="checkbox" value='1' name='ata'  <?php if (isset($_POST['ata'])) { echo ($_POST['ata'] == '1' ? ' checked' : ''); } ?>/></td>
</tr>

<tr>
<td>SATA:</td>
<td><input type="checkbox" value='1' name='sata'  <?php if (isset($_POST['sata'])) { echo ($_POST['sata'] == '1' ? ' checked' : ''); } ?>/></td>
</tr>



<tr>
<td>RAM memory type:</td>
<td><select name='ramtyp'>
<option value='SDR'>SDR</option>
<option value='DDR'  <?php if (isset($_POST['ramtyp'])) { echo ($_POST['ramtyp'] == 'DDR' ? ' selected' : ''); } ?>>DDR</option>
<option value='DDR2'  <?php if (isset($_POST['ramtyp'])) { echo ($_POST['ramtyp'] == 'DDR2' ? ' selected' : ''); } ?>>DDR2</option>
<option value='DDR3'  <?php if (isset($_POST['ramtyp'])) { echo ($_POST['ramtyp'] == 'DDR3' ? ' selected' : ''); } ?>>DDR3</option>
<option value='DDR4'  <?php if (isset($_POST['ramtyp'])) { echo ($_POST['ramtyp'] == 'DDR4' ? ' selected' : ''); } ?>>DDR4</option>
</select></td>
</tr>

<tr>
<td>RAM slots:</td>
<td><select name='ramilosc'>
<option value='2'>2</option>
<option value='3'  <?php if (isset($_POST['ramilosc'])) { echo ($_POST['ramilosc'] == '3' ? ' selected' : ''); } ?>>3</option>
<option value='4'  <?php if (isset($_POST['ramilosc'])) { echo ($_POST['ramilosc'] == '4' ? ' selected' : ''); } ?>>4</option>
</select></td>
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
	echo "mobo add ";

	echo "'$pro' "; 
	echo "'$mod' "; 
	echo "'$gni' "; 
	echo "'$pci' "; 	
	echo "'$agp' "; 
	echo "'$pcie' ";
	echo "'$ata' ";
	echo "'$sat' "; 
	echo "'$typ' "; 
	echo "'$ilo' "; 
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
	//gniazdo null
	else if($gni==null)
	{
		echo "'gniazdo' argument cannot be null."; 
		$allow=false;
	}
	//not chosen pci/agp or pcie
	else if($pci==0&&$agp==0&&$pcie==0)
	{
		echo "'PCI', 'AGP', 'PCIE' - at least one of these must be selected"; 
		$allow=false;
	}
	//not chosen sata or ata
	else if($ata==0&&$sat==0)
	{
		echo "'ATA', 'SATA' - at least one of these must be selected"; 
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
			$query="INSERT INTO `mobo` (`id`, `producent`,`model`,`gniazdo`, `pci`, `agp`, `pcie`, `ata`, `sata`, `ramtyp`, `ramilosc`, `img`)
			VALUES (NULL, '$pro', '$mod', '$gni', '$pci', '$agp', '$pcie', '$ata', '$sat', '$typ', '$ilo', '$img')";
			
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