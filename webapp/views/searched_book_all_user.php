<?php
	//button to display entire book list
	$viewAll = " <form class='pull-right'  action='index.php' method='post'>";
	$viewAll .= " <input type='submit' class='btn btn-primary btn-xs' value='View All'>";
	$viewAll .= " <input type='hidden' name='action' value='viewAll'>";
	$viewAll .= "</form> ";
	
	echo "<h1>Searching for ....  $search_key $viewAll</h1><br>";
	echo "<table class='table table-condensed>'";
	echo "<tr> <th></th> <th>$b_name</th> <th>$b_auth</th> <th>$b_categ</th> <th>$d_pub</th>  <th></th> </tr>";
	//display each row
	foreach ( $bookListb as $recordNumber => $row ){
		echo "<tr>";
		//display each content in column
		echo "<td>  </td>";
		echo "<td> $row[book_name] </td>";
		echo "<td> $row[book_author] </td>";
		echo "<td> $row[book_category] </td>";
		echo "<td> $row[publish_date] </td>";
		echo "<td>  </td>";
		
		echo "</tr>";
	}
	echo "</table>";			
?>