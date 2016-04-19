<?php
include ("DB/pdoDBManager.php");
include ("DB/DAO/UsersDAO.php");
include ("DB/DAO/BooksDAO.php");
include ("authenticationSuite.php");
class Model {
	private $DBManager = null;
	private $dbLink = null;
	private $usersDAO = null;
	private $booksDAO = null;
	private $authenSuite = null;
	
	public $bookList;//entire book list
	public $bookListb;//searched book list
	
	public $bookInfo;//used to pre populate update form
	public $book_id;//used for update or delete book
	
	//hide or show forms
	public $loginFormVisible = true;
	public $updateBookFormVisible = False;
	public $searchListVisible = False;
	
	//used to display error messages
	public $showLoginError = False;
	public $errorLoginMsg;
	public $showInsertBookError = False;
	public $showInsertBookError2 = False;
	public $errorInsertBookMsg;
	public $showUpdateBookError = False;
	public $showUpdateBookError2 = False;
	public $errorUpdateBookMsg;
	public $showInsertUserError = False;
	public $showInsertUserEmailError = False;
	public $showInsertUserPassError = False;
	public $errorInsertUserMsg;
	
	
	public function __construct() {
		$this->DBManager = new pdoDBManager ();
		$this->DBManager->openConnection ();
		$this->usersDAO = new UsersDAO ( $this->DBManager );
		$this->booksDAO = new BooksDAO ( $this->DBManager );
		$this->authenSuite = new authenticationSuite ();
	}
	
	//register new user
	public function insertNewUser($name, $surname, $email, $password) {
		$hashedPass = $this->authenSuite->userHashPass($password);
		$this->usersDAO->insertNewUser ( $name, $surname, $email, $hashedPass );
	}
	
	//insert new book using passed variables
	public function insertNewBook($book_name, $book_auth, $book_categ, $book_date) {
		$this->booksDAO->insertNewBook ($book_name, $book_auth, $book_categ, $book_date);
	}
	
	//display the entire book list
	public function prepareBookList() {
		$this->bookList = $this->booksDAO->getBook ();
	}
	
	//displays the searched book list
	public function prepareBookList2($search_key) {
		$this->bookListb = $this->booksDAO->getBook2 ($search_key);
	}
	
	//delete book using book ID
	public function deleteBook($book_id) {
		$this->booksDAO->deleteBook ( $book_id );
	}
	
	//retrieve row using book ID to pre populate update form
	public function prepareUpdateBookForm($book_id) {
		$this->updateBookFormVisible = true;
		$this->bookInfo = $this->booksDAO->getBook ( $book_id );
		$this->book_id = $book_id;
		$this->updateBookFormVisible = true;
	}
	
	//update book using passed variables
	public function updateBook($book_id, $book_name, $book_auth, $book_categ, $book_date) {
		$this->booksDAO->updateBook ($book_id, $book_name, $book_auth, $book_categ, $book_date);
		$this->updateBookFormVisible = false;
	}
	
	//encrypt password
	public function checkUserPass($password) {
		$hashedPass = $this->authenSuite->userHashPass($password);
		return $hashedPass;
	}
	
	//check if password already exist
	public function checkUserPass2($hashedPass) {
		$result = $this->authenSuite->userPass($hashedPass);
		return $result;
	}
	
	//check if email already exist
	public function checkUserEmail($emailChecker) {
		$result = $this->authenSuite->userEmail($emailChecker);
		return $result;
	}
	
	//check if user name is a match
	public function checkUserName($user_name, $hashedPass) {
		$result = $this->authenSuite->userName($user_name, $hashedPass);
		return $result;
	}
	
	//check if book already exist
	public function checkBook($bookName, $authorName, $categoryName, $pubDate) {
		$result = $this->authenSuite->checkBook($bookName, $authorName, $categoryName, $pubDate);
		return $result;
	}
	
	//login user, start session
	public function loginUser($username){
		$this->authenSuite->loginUser ($username );
	}
	
	//checked if user logged in, used to update navbar
	public function isUserLoggedIn() {
		return ($this->authenSuite->isUserLoggedIn ());
	}
	
	//hide log in form
	public function updateLoginStatus() {
		$this->loginFormVisible = false;
	}
	
	//logout user, unset sessions and show login form
	public function logoutUser(){
		$this->authenSuite->logoutUser ();		
		$this->loginFormVisible = true;
	}
	
	//show searched list view
	public function searchView($search_key) {
		$this->searchListVisible = true;
		$this->authenSuite->searchView($search_key);
	}
	
	//close update book form or searched book list
	public function viewAll() {
		$this->searchListVisible = false;
		$this->updateBookFormVisible = False;
	}
	
	//Functions for particular error messages
	
	public function loginErrorMsg(){
		$this ->showLoginError = True;
		$this ->errorLoginMsg = ERROR_LOGIN_MSG;
	}
	public function InsertBookErrorMsg(){
		$this ->showInsertBookError = True;
		$this ->errorInsertBookMsg = ERROR_INSERTBOOK_MSG;
	}
	public function InsertBookErrorMsg2(){
		$this ->showInsertBookError2 = True;
		$this ->errorInsertBookMsg = ERROR_INSERTBOOK_MSG2;
	}
	public function UpdateBookErrorMsg(){
		$this ->showUpdateBookError = True;
		$this ->errorUpdateBookMsg = ERROR_UPDATEBOOK_MSG;
		$this->updateBookFormVisible = True;
	}
	public function UpdateBookErrorMsg2(){
		$this ->showUpdateBookError2 = True;
		$this ->errorUpdateBookMsg = ERROR_UPDATEBOOK_MSG2;
		$this->updateBookFormVisible = True;
	}
	public function InsertUserErrorMsg(){
		$this ->showInsertUserError = True;
		$this ->errorInsertUserMsg = ERROR_INSERTUSER_MSG;
	}
	public function InsertUserEmailErrorMsg(){
		$this ->showInsertUserEmailError = True;
		$this ->errorInsertUserMsg = ERROR_EMAILDUP_MSG;
	}
	public function InsertUserPassErrorMsg(){
		$this ->showInsertUserPassError = True;
		$this ->errorInsertUserMsg = ERROR_PASSDUP_MSG;
	}
	
	//close DB connection
	public function __destruct() {
		$this->DBManager->closeConnection ();
	}
}
?>