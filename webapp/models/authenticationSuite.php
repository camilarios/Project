<?php
class authenticationSuite{
	private $usersDAO = null;
	private $booksDAO = null;
	
	public function __construct() {
		$this->DBManager = new pdoDBManager ();
		$this->DBManager->openConnection ();
		$this->usersDAO = new UsersDAO ( $this->DBManager );
		$this->booksDAO = new BooksDAO ( $this->DBManager );
	}
	
	//encrypt password
	public function userHashPass($password) {
		$hashedPass = hash ( "sha1", $password );
		return ($hashedPass);
	}
	
	//check if password exist
	public function userPass($hashedPass) {
		$result = $this->usersDAO->isPassExist($hashedPass);
		return $result;
	}
	
	//check if email exist
	public function userEmail($emailChecker) {
		$result = $this->usersDAO->isEmailExist($emailChecker);
		return $result;
	}
	
	//check if user name is a match
	public function userName($user_name, $hashedPass) {
		$result = $this->usersDAO->isNameExist($user_name, $hashedPass);
		return $result;
	}
	
	//log in user and start session
	public function loginUser($username) {
		$_SESSION ['username'] = $username;
	}
	
	//check if user is logged in
	public function isUserLoggedIn() {
		return (! empty ( $_SESSION ['username'] ));
	}
	
	//log out user and unset and destroy sessions
	public function logoutUser() {
		session_unset();
		session_destroy();
	}
	
	//check book if already exist
	public function checkBook($bookName, $authorName, $categoryName, $pubDate) {
		$result = $this->booksDAO->isBookExist($bookName, $authorName, $categoryName, $pubDate);
		return $result;
	}
	
	//used to display the search keyword
	public function searchView($search_key) {
		$_SESSION ['searchKey'] = $search_key;
	}
}
?>