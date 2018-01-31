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
	$naz = $_POST['nazwa'];
	$img = $_POST['obrazek'];
}
?>

<form method='POST'>

<div class="dane">
<center><h1><a href="komp.php">Add new Computer</a></h1></center>
<br/>
<table>

<tr><td>Name:</td><td><input type='text' name="nazwa" placeholder="ex. main PC" value="<?php if(isset($_POST['nazwa'])){ echo $naz; }?>"/></td></tr>
<tr><td>Image*:</td><td><input type='text' name="obrazek"placeholder="link" value="<?php if(isset($_POST['obrazek'])){ echo $img; }?>"/></td></tr>
<tr><td colspan=2>Go to edit mode to assembly parts.</td></tr>


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
	echo "komp add ";

	echo "'$naz' "; 
	echo "'$img' "; 
	
	echo "<br/>";
	echo "<br/>";
	
	//nazwa null
	if($naz==null)
	{
		echo "'nazwa' argument cannot be null."; 
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
			$query="INSERT INTO `komputer` VALUES (NULL,'$naz', '0', '0', '0', '0', '0', '0', '0', '0', '0','$img')";
			
			mysqli_query($con, $query);
			echo "Computer '$naz' added to database.";

			$myfile = fopen("logs/".date("Y-m-d")."_".date("h-i-sa").".html", "w") or die("Unable to open file!");
			
			$txt = date("Y-m-d")." ".date("h:i:sa").":\n"; //date
			fwrite($myfile, $txt);
			$txt = "Computer '$naz' to Database"; //action
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