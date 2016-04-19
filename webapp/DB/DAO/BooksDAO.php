<?php
class BooksDAO {
	private $dbManager;
	
	function BooksDAO($DBMngr) {
		$this->dbManager = $DBMngr;
	}
	
	//used for displaying all books and pre populating update form
	public function getBook($book_id = null) {
		$sql = "SELECT * ";
		$sql .= "FROM books ";
		if ($book_id != null)
			$sql .= "WHERE book_id=? ";
			$sql .= "ORDER BY book_name ";
		
		$stmt = $this->dbManager->prepareQuery ( $sql );
		$this->dbManager->bindValue ( $stmt, 1, $book_id, $this->dbManager->INT_TYPE );
		$this->dbManager->executeQuery ( $stmt );
		
		if (empty ( $book_id ))
			$result = $this->dbManager->fetchResults ( $stmt );
		else
			$result = $this->dbManager->getNextRow ( $stmt );
		return ($result);
	}
	
	//used to display list of searched books
	public function getBook2($search_key) {
		$sql = "SELECT * ";
		$sql .= "FROM books ";
		$sql .= "WHERE book_name like '%$search_key%' ";
		$sql .= "or book_author like '%$search_key%' ";
		$sql .= "or book_category like '%$search_key%' ";
		$sql .= "ORDER BY book_name ";
		
		$stmt = $this->dbManager->prepareQuery ( $sql );
		$this->dbManager->bindValue ( $stmt, 1, $search_key, $this->dbManager->STRING_TYPE );
		$this->dbManager->executeQuery ( $stmt );
			
		if (!empty ( $search_key ))
			$result = $this->dbManager->fetchResults ( $stmt );
			return ($result);
	}
	
	//delete book using passed ID
	public function deleteBook($book_id) {
		$sql = "DELETE FROM books ";
		$sql .= "WHERE book_id=? ";
	
		$stmt = $this->dbManager->prepareQuery ( $sql );
		$this->dbManager->bindValue ( $stmt, 1, $book_id, $this->dbManager->INT_TYPE );
		$result = $this->dbManager->executeQuery ( $stmt );
	
		return ($result);
	}
	
	//inserting new book
	public function insertNewBook($book_name, $book_auth, $book_categ, $book_date) {
		$sql = "INSERT INTO books";
		$sql .= "(book_name, book_author, book_category, publish_date) ";
		$sql .= "VALUES (?,?,?,?)";
		
		$stmt = $this->dbManager->prepareQuery ( $sql );
		$this->dbManager->bindValue ( $stmt, 1, $book_name, $this->dbManager->STRING_TYPE );
		$this->dbManager->bindValue ( $stmt, 2, $book_auth, $this->dbManager->STRING_TYPE );
		$this->dbManager->bindValue ( $stmt, 3, $book_categ, $this->dbManager->STRING_TYPE );
		$this->dbManager->bindValue ( $stmt, 4, $book_date, $this->dbManager->STRING_TYPE );
		
		$this->dbManager->executeQuery ( $stmt );
		
		if ($this->dbManager->getNumberOfAffectedRows ( $stmt ) == 1)
			return (true);
		else
			return (false);
	}
	
	//checking if book already exist
	public function isBookExist($bookName, $authorName, $categoryName, $pubDate){
		$sql = "SELECT count(*) as bookExist ";
		$sql .= "FROM books ";
		$sql .= "WHERE book_name= '$bookName' ";
		$sql .= "and book_author= '$authorName' ";
		$sql .= "and book_category= '$categoryName' ";
		$sql .= "and publish_date= '$pubDate' ";
	
		$stmt = $this->dbManager->prepareQuery ( $sql );
		$this->dbManager->executeQuery ( $stmt );
		$result = $this->dbManager->fetchResults ( $stmt );
	
		if ($result[0]["bookExist"] >= 1) {
			return (true);
		} else
			return (false);
	}
	
	//update row using passed variables
	public function updateBook($book_id, $book_name, $book_auth, $book_categ, $book_date) {
		$sql = "UPDATE books ";
		$sql .= "SET book_name=?, book_author=?, book_category=?, publish_date=? ";
		$sql .= "WHERE book_id=? ";
	
		$stmt = $this->dbManager->prepareQuery ( $sql );
		$this->dbManager->bindValue ( $stmt, 1, $book_name, $this->dbManager->STRING_TYPE );
		$this->dbManager->bindValue ( $stmt, 2, $book_auth, $this->dbManager->STRING_TYPE );
		$this->dbManager->bindValue ( $stmt, 3, $book_categ, $this->dbManager->STRING_TYPE );
		$this->dbManager->bindValue ( $stmt, 4, $book_date, $this->dbManager->STRING_TYPE );
		$this->dbManager->bindValue ( $stmt, 5, $book_id, $this->dbManager->INT_TYPE );
		$this->dbManager->executeQuery ( $stmt );
	
		if ($this->dbManager->getNumberOfAffectedRows ( $stmt ) == 1)
			return (true);
		else
			return (false);
	}
}
?>
