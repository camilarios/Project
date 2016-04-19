<?php
include "validationSuite.php";
class Controller {
	private $model;
	private $action;
	private $validSuite;
	
	public function __construct($model, $action) {
		$this->model = $model;
		$this->action = $action;
		$this->validSuite = new validationSuite();
		
		switch ($action) {
			case "insertUser" :
				$this->insertNewUser ();
				break;
			case "insertBook" :
				$this->insertNewBook ();
				break;
			case "deleteBook" :
				$this->deleteBook ();
				break;
			case "prepareUpdateBook":
				$this->prepareUpdateBookForm();
				break;
			case "updateBook" :
				$this->updateBook ();
				break;
			case "loginUser" :
				$this->loginUser();
				break;
			case "logoutUser" :
				$this->logoutUser();
				break;
			case "searchBook" :
				$this->searchBook();
				break;
			case "viewAll" :
				$this->viewAll();
				break;
		}
		
		$this->defaultActions ();
	}
	//register/insert new user
	public function insertNewUser() {
		if (! empty ( $_REQUEST ["name"] ) && ! empty ( $_REQUEST ["surname"] ) && ! empty ( $_REQUEST ["email"] ) && ! empty ( $_REQUEST ["password"] )) {
			//validates user inputs then show error message if inputs are invalid
			if($this->validSuite->isNameValid($_REQUEST ["name"]))
				if($this->validSuite->isSnameValid($_REQUEST ["surname"]))
					//validates and check if inputed email is already in use
					if($this->validSuite->isEmailValid($_REQUEST ["email"]) && $this->model->checkUserEmail ($_REQUEST ["email"]) == False)
						//validates user inputed password
						if($this->validSuite->isPassValid($_REQUEST ["password"])){
							//authenticate/encrypt inputed password
							$passResult = $this->model->checkUserPass( $_REQUEST ["password"]);
							//check if encrypted password is already in use
							if($this->model->checkUserPass2 ($passResult) == false)
								//if inputs are valid, register user
								$this->model->insertNewUser ( $_REQUEST ["name"], $_REQUEST ["surname"], $_REQUEST ["email"], $_REQUEST ["password"] );
							else
								$this->model->InsertUserPassErrorMsg();
						}
						else 
							$this->model->InsertUserPassErrorMsg();
					else
						$this->model->InsertUserEmailErrorMsg();
				else 
					$this->model->InsertUserErrorMsg();
			else
				$this->model->InsertUserErrorMsg();
		}
	}
	
	//insert new book
	public function insertNewBook() {
		if (! empty ( $_REQUEST ["book_name"] ) && ! empty ( $_REQUEST ["book_auth"] ) && ! empty ( $_REQUEST ["book_categ"] ) && ! empty ( $_REQUEST ["book_date"] )) {
			//check if the book being inserted already exist
			if($this->model->checkBook ($_REQUEST ["book_name"], $_REQUEST ["book_auth"], $_REQUEST ["book_categ"], $_REQUEST ["book_date"]) == False)
				//validates user inputs
				if($this->validSuite->isSnameValid($_REQUEST ["book_name"]))
					if($this->validSuite->isSnameValid($_REQUEST ["book_auth"]))
						if($this->validSuite->isNameValid($_REQUEST ["book_categ"]))
							//insert new book if inputs are valid, else show error message
							$this->model->insertNewBook ( $_REQUEST ["book_name"], $_REQUEST ["book_auth"], $_REQUEST ["book_categ"], $_REQUEST ["book_date"] );
						else
							$this->model->InsertBookErrorMsg2();
					else
						$this->model->InsertBookErrorMsg2();
				else
					$this->model->InsertBookErrorMsg2();
			else
				$this->model->InsertBookErrorMsg();
		}
	}
	
	//loginUser
	public function loginUser() {
		if (! empty ( $_REQUEST ["name"] ) && ! empty ( $_REQUEST ["password"] )) {
			//authenticate/encrypt inputed password
			$passResult = $this->model->checkUserPass ( $_REQUEST ["password"]);
			//check if pasword is a match
			if($this->model->checkUserPass2 ($passResult) == true){
				//check if user name is also a match
				if($this->model->checkUserName ( $_REQUEST ["name"], $passResult) == true)
					//if inputs are valid, log in user and start session
					$this->model->loginUser($_REQUEST ["name"]);
				else
					$this->model->loginErrorMsg();
			}
			else
				$this->model->loginErrorMsg();
		}
	}
	//logout user
	public function logoutUser() {
		//unset all session
		$this->model->logoutUser();
	}
	
	//delete book
	public function deleteBook() {
		if (! empty ( $_REQUEST ["book_id"] ))
			if (is_numeric ( $_REQUEST ["book_id"] ))
				if ($_REQUEST ["book_id"] >= 0)
					//pass the book ID which will be used to delete the chosen book
					$this->model->deleteBook ( $_REQUEST ["book_id"] );
	}
	
	//prepopulating the update form
	public function prepareUpdateBookForm() {
		if (! empty ( $_REQUEST ["book_id"] ))
			if (is_numeric ( $_REQUEST ["book_id"] ))
				if ($_REQUEST ["book_id"] >= 0)
					//pass the book ID which will be used to return columns or the row of this ID
					$this->model->prepareUpdateBookForm ( $_REQUEST ["book_id"] );
	}
	
	//update book 
	public function updateBook() {
		if (! empty ( $_REQUEST ["book_id"] ) && ! empty ( $_REQUEST ["book_name"] ) && ! empty ( $_REQUEST ["book_auth"] ) && ! empty ( $_REQUEST ["book_categ"] ) && ! empty ( $_REQUEST ["book_date"] )) {
			//check if inputed book details already exist
			if($this->model->checkBook ($_REQUEST ["book_name"], $_REQUEST ["book_auth"], $_REQUEST ["book_categ"], $_REQUEST ["book_date"]) == False)
				//validates user inputs
				if($this->validSuite->isSnameValid($_REQUEST ["book_name"]))
					if($this->validSuite->isSnameValid($_REQUEST ["book_auth"]))
						if($this->validSuite->isNameValid($_REQUEST ["book_categ"]))
							//update book if inputs are valid, else show error message
							$this->model->updateBook ( $_REQUEST ["book_id"], $_REQUEST ["book_name"], $_REQUEST ["book_auth"], $_REQUEST ["book_categ"], $_REQUEST ["book_date"] );
						else{
							$this->model->UpdateBookErrorMsg2();
							$this->prepareUpdateBookForm();
						}
					else{
						$this->model->UpdateBookErrorMsg2();
						$this->prepareUpdateBookForm();
					}
				else{
					$this->model->UpdateBookErrorMsg2();
					$this->prepareUpdateBookForm();
				}
			else{
				$this->model->UpdateBookErrorMsg();
				$this->prepareUpdateBookForm();
			}
		}
	}
	
	//searching mechanism
	public function searchBook() {
		//pass the search key that will be used to retrieve rows if there is any match
		$this->model->prepareBookList2 ($_REQUEST ["search_key"]);
		//display searched list
		$this->model->searchView($_REQUEST ["search_key"]);
	}
	//show entire list of book
	public function viewAll() {
		$this->model->viewAll();
	}
	
	public function defaultActions() {
		//show all list of book
		$this->model->prepareBookList ();
		//update navbar whether user logged in or not
		if ($this->model->isUserLoggedIn ())
			$this->model->updateLoginStatus ();
	}
}
?>