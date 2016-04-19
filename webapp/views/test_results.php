<?php
/*CAMILA:just coppied the appointments list because Im not sure how to do this table D:*/
echo "<table class='table table-condensed>'";
	echo "<tr>  <th>$b_name</th> <th>$b_auth</th> <th>$b_categ</th> <th>$d_pub</th> <th></th> <th></th> </tr>";
	//display each row
	foreach ( $bookList as $recordNumber => $row ){
		//update button
		$up_form = " <form class='pull-right'  action='index.php' method='post'>";
		$up_form .= " <input type='submit' class='btn btn-primary btn-xs' value='View'>";
		$up_form .= " <input type='hidden' name='action' value='prepareUpdateBook'>";
		$up_form .= " <input type='hidden' name='book_id' value='$row[book_id]'>";
		$up_form .= "</form> ";
				
		//display each content in column
		echo "<tr>";
		echo "<td> $row[book_name] </td>";
		echo "<td> $row[book_author] </td>";
		echo "<td> $row[book_category] </td>";
		echo "<td> $row[publish_date] </td>";
		echo "<td> $up_form </td>";
		echo "</tr>";
	}
	echo "</table>";
	?>