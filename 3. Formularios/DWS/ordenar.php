<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
$a=30;
$b=27;
$c=10;
if ($a<$b) {
	if ($b<$c){ 
		echo "<table><tr><td>$a</td><td>$b</td><td> $c</td></tr></table>";
	}elseif ($c<$a){ 
		echo "<table><tr><td>$c</td><td>$a</td><td> $b</td></tr></table>";
		}else 
		echo "<table><tr><td>$a</td><td>$c</td><td> $b</td></tr></table>";
}elseif ($a<$c){ 
	echo "<table><tr><td>$b</td><td>$a</td><td> $c</td></tr></table>";
	}elseif ($b<$c){ 
		echo "<table><tr><td>$b</td><td>$c</td><td> $a</td></tr></table>";
		}else 
		echo "<table><tr><td>$c</td><td>$b</td><td> $a</td></tr></table>";

?>
</body>
</html>