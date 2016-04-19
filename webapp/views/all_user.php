<?php
	echo "<table class='table table-condensed>'";
	echo "<tr>  <th></th> <th></th> <th>$b_name</th> <th>$b_auth</th> <th>$b_categ</th> <th>$d_pub</th>  <th></th> </tr>";
	//display each row
	foreach ( $bookList as $recordNumber => $row ){	
		echo "<tr>";
		echo "<td>  </td>";
		echo "<td>  </td>";
		//display each content in column
		echo "<td> $row[book_name] </td>";
		echo "<td> $row[book_author] </td>";
		echo "<td> $row[book_category] </td>";
		echo "<td> $row[publish_date] </td>";
		echo "<td>  </td>";
		echo "</tr>";
	}
	echo "</table>";			
?>