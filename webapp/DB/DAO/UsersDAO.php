<?php
class UsersDAO {
	private $dbManager;
	
	function UsersDAO($DBMngr) {
		$this->dbManager = $DBMngr;
	}
	
	//insert/ register new user
	public function insertNewUser($name, $surname, $email, $hashedPass) {
		$sql = "INSERT INTO users";
		$sql .= "(user_name, user_lname, user_mail, user_pass) ";
		$sql .= "VALUES (?,?,?,?)";
		
		$stmt = $this->dbManager->prepareQuery ( $sql );
		$this->dbManager->bindValue ( $stmt, 1, $name, $this->dbManager->STRING_TYPE );
		$this->dbManager->bindValue ( $stmt, 2, $surname, $this->dbManager->STRING_TYPE );
		$this->dbManager->bindValue ( $stmt, 3, $email, $this->dbManager->STRING_TYPE );
		$this->dbManager->bindValue ( $stmt, 4, $hashedPass, $this->dbManager->STRING_TYPE );
		$this->dbManager->executeQuery ( $stmt );
		
		if ($this->dbManager->getNumberOfAffectedRows ( $stmt ) == 1) {
			return (true);
		} else
			return (false);
	}
	
	//chcek if email alerdy exist
	public function isEmailExist($emailChecker){
		$sql = "SELECT count(*) as emailExist ";
		$sql .= "FROM users ";
		$sql .= "WHERE user_mail= '$emailChecker' ";
	
		$stmt = $this->dbManager->prepareQuery ( $sql );
		$this->dbManager->executeQuery ( $stmt );
		$result = $this->dbManager->fetchResults ( $stmt );
	
		if ($result[0]["emailExist"] == 1) {
			return (true);
		} else
			return (false);
	}
	
	//check if password already exist
	public function isPassExist($hashedPass){
		$sql = "SELECT count(*) as passExist ";
		$sql .= "FROM users ";
		$sql .= "WHERE user_pass= '$hashedPass' ";
		
		$stmt = $this->dbManager->prepareQuery ( $sql );
		$this->dbManager->executeQuery ( $stmt );
		$result = $this->dbManager->fetchResults ( $stmt );
		
		if ($result[0]["passExist"] == 1) {
			return (true);
		} else
			return (false);
	}
	
	//checking if name is a match when logging in
	public function isNameExist($user_name, $hashedPass){
		$sql = "SELECT count(*) as nameExist ";
		$sql .= "FROM users ";
		$sql .= "WHERE user_name='$user_name' and user_pass= '$hashedPass' ";
	
		$stmt = $this->dbManager->prepareQuery ( $sql );
		$this->dbManager->executeQuery ( $stmt );
		$result = $this->dbManager->fetchResults ( $stmt );
	
		if ($result[0]["nameExist"] == 1) {
			return (true);
		} else
			return (false);
	}
}
?>
