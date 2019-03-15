<html>

<head>
<title>Expense Calculation Result</title>

</head>

<body style="font-family:Times;color:#000000" bgcolor="#C0C0C0">

<?php 
// This is a program to divide expenses equally and find out who owes how much to whom
// Author: Siddharth Mallya
// Date: January 29, 2011
	
	$n = $_POST['n'];
	for($i=1;$i<=$n;$i++) {
		$name_i = 'name'.$i;
		$name[$i] = preg_replace('/[^a-zA-Z0-9_ -]/s', '', $_POST["$name_i"]);
		$amount_spent_i = 'amount_spent'.$i;
		if(is_numeric($_POST["$amount_spent_i"])) 
			$amount_spent[$i] = $_POST["$amount_spent_i"];
		else {
			echo "Non numeric value(s) found for expense.<br/>";
			echo "Click <a href=index.php>here</a> to try again.";
			exit();
		}
	}

	$total_expense = 0;
	for($i=1;$i<=$n;$i++) {
		$total_expense = $total_expense + $amount_spent[$i];
	}

	$average_amount_spent = $total_expense / $n;

	for($i=1;$i<=$n;$i++) {
		$pay_to_reach_average[$i] = $amount_spent[$i] - $average_amount_spent;
	}

	for($i=1;$i<=$n;$i++) {
		$cumulative_balance[$i] = $pay_to_reach_average[$i];
		for($j=1;$j<=$n;$j++) {
			$pay[$i][$j] = 0;
	   }
	}
	
	for($i=1;$i<=$n;$i++) {
		if($pay_to_reach_average[$i] < 0 )
			for($j=1;$j<=$n;$j++)
				if($cumulative_balance[$j] > 0 ) {
					$sum = $cumulative_balance[$i] + $cumulative_balance[$j];
					if($sum > 0) {
						$pay[$i][$j] = $cumulative_balance[$i] * (-1);
						$cumulative_balance[$i] = 0;
						$cumulative_balance[$j] = $sum;
					}
					else {
						if($sum < 0) {
							$pay[$i][$j] = $cumulative_balance[$j];
							$cumulative_balance[$i] = $sum;
							$cumulative_balance[$j] = 0;
						}
						else {
							$pay[$i][$j] = $cumulative_balance[$i] * (-1);
							$cumulative_balance[$i] = 0;
							$cumulative_balance[$j] = 0;
						}
					}
				} 
	}

	for($i=1;$i<=$n;$i++) 
		for($j=1;$j<=$n;$j++) {
			if($pay[$i][$j] > 0  && $pay_to_reach_average[$i] < 0)
				echo 'Member '.$i.' ('.$name[$i].') has to pay member '.$j.' ('.$name[$j].') an amount of '.$pay[$i][$j].'</br>';
	   }
	
	echo '<br/>';
	echo '<b>Calculation details:</b><br/>';
	echo 'Total Members = '.$n.'<br/>';
	echo 'Average Amount Spent = '.$average_amount_spent.'<br/>';
	echo '<br/>';
	for($i=1;$i<=$n;$i++) {
		echo 'Member '.$i.' ('.$name[$i].'):<br/>';
		echo 'Amount spent: '.$amount_spent[$i].'<br/>';
		if($pay_to_reach_average[$i] > 0)
			echo 'Amount spent is above average by '.$pay_to_reach_average[$i].'<br/>';
		else 
			if($pay_to_reach_average[$i] < 0)
				echo 'Amount spent is below average by '.($pay_to_reach_average[$i] * -1).'<br/>';
			else
			    echo 'Amount spent matches average<br/>';	
		echo '<br/>';
	}
	
	echo "<a href=index.php>Home</a><br/>";
?>

</body>

</html>

