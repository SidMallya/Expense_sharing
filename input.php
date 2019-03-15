<html>

<head>
<title>Enter amount spent</title>

</head>

<body style="font-family:Times;color:#000000" bgcolor="#C0C0C0">

<?php
	$n = $_POST['n'];
	if(is_numeric($n) && $n > 1) {
		echo '<b>Enter name and amount spent by each member:</b>';
		echo '<form action="calculate.php" method="post">'.'<br/>';
		echo '<table>';
		for($i=1;$i<=$n;$i++) { 
			echo '<tr>';
			echo '<td>';
			echo '<b>Member '.$i.'</b>';
			echo '<td>';
			echo '<td></td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td>Name:    </td>';
			echo '<td><input type="text" name="name'.$i.'" size="10"/></td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td>Amount spent: </td>';
			echo '<td><input type="text" name="amount_spent'.$i.'" size="5"/></td>';
			echo '</tr>';
			echo '<tr>';
			echo '<input type="hidden" name="memnum" value='.$i;
			echo '</tr>';
		}
		echo '</table>';
		echo '<input type="hidden" name="n" value="'.$n.'" />';
		echo '<input type="submit" value="Submit" />'.'<br/>';
		echo '</form>';
	}
	else {
		echo "The number of members should be a number and should be greater than 1<br/>";
		echo "<a href=index.php>Back</a><br/>";
	}

?>

</body>

</html>
