<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
$a=3;
$b=$a;
for ($i=$a-1; $i >0 ; $i--) { 
	$a*=$i;
}
echo "<table border='1'><tr><td>el factorial de</td><td> $b</td><td> es</td><td> $a</td></tr></table> </br>";

?>
</body>
</html>