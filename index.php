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

<div class="home">
<h2>NEWS:</h2>
<?php 

foreach (glob("logs/*.html") as $filename)
{
		echo "<div style='border: 1px solid #eee; background-color: #222;'>";
		include $filename;
		echo "</div>";
}
?>
</div>

<?php 
include 'footer.php';
?>

</body>

</html>