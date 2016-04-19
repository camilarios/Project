<?php
class View {
	private $model;
	private $controller;
	
	public function __construct($controller, $model) {
		$this->controller = $controller;
		$this->model = $model;
	}
	
	public function getHTMLOutput() {
		
		// from the config.inc.php
		$title = TITLE_WEB_APP;
		$footer = FOOTER;
		$b_name = B_NAME;
		$b_auth = B_AUTH;
		$b_categ =B_CATEG;
		$d_pub = D_PUB;
		
		//show or hide error mesages
		$showLoginError = $this->model->showLoginError;
		$errorLoginMsg = $this -> model->errorLoginMsg;
		$showInsertBookError = $this->model->showInsertBookError;
		$showInsertBookError2 = $this->model->showInsertBookError2;
		$errorInsertBookMsg = $this -> model->errorInsertBookMsg;
		$showUpdateBookError = $this->model->showUpdateBookError;
		$showUpdateBookError2 = $this->model->showUpdateBookError2;
		$errorUpdateBookMsg = $this -> model->errorUpdateBookMsg;
		$showInsertUserError = $this->model->showInsertUserError;
		$showInsertUserEmailError = $this->model->showInsertUserEmailError;
		$showInsertUserPassError = $this->model->showInsertUserPassError;
		$errorInsertUserMsg = $this -> model->errorInsertUserMsg;
		
		//list of books for logged in users or all user
		$bookList = $this->model->bookList;
		$bookListb = $this->model->bookListb;
		$searchListVisible = false;
		
		//show or hide register, login, update forms
		$loginFormVisible = true;
		$updateBookFormVisible = False;
		
		//variables for prepopulating update form
		$book_name = "";
		$book_auth = "";
		$book_categ = "";
		$book_date = "";
		$book_id = "";
		
		if ($this->model->updateBookFormVisible) {
			$updateBookFormVisible = true;
			//prepopulating the update form
			$book_name = $this->model->bookInfo ["book_name"];
			$book_auth = $this->model->bookInfo ["book_author"];
			$book_categ = $this->model->bookInfo ["book_category"];
			$book_date = $this->model->bookInfo ["publish_date"];
			$book_id = $this->model->book_id;
		}
		
		//if login is successfull
		if($this->model->loginFormVisible == false){
			$loginFormVisible = false;
			$user_name = $_SESSION ['username'];
		}
		
		//if user is trying to search book
		if($this->model->searchListVisible){
			$searchListVisible = true;
			$search_key = $_SESSION ['searchKey'];
		}
		else
			$searchListVisible = false;
		
		//include the basic HTML5 template
		include ("template_html.php");	
	}
}
?>