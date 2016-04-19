<?php
class validationSuite{
	
	//allowing only letters, white spaces, dot and dash
	//minimum of 2 characters
	public function isNameValid ( $nameChecker ) {
		$regex = "/^[a-zA-Z\s.-]{2,}$/i";
	
		if (! preg_match ( $regex , $nameChecker ) )
			return ( false ) ;
			else
				return ( true ) ;
	}
	
	//allowing only letters, white spaces, apostrope, dot and dash
	//minimum of 2 characters
	public function isSnameValid ( $snameChecker ) {
		$regex = "/^[a-zA-Z\s'.-]{2,}$/i";
	
		if (! preg_match ( $regex , $snameChecker ) )
			return ( false ) ;
			else
				return ( true ) ;
	}

	//check if email address is a valid email address format
	public function isEmailValid ( $emailChecker ) {
		$regex = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/i";
		
		if (! preg_match ( $regex , $emailChecker ) )
			return ( false ) ;
		else
			return ( true ) ;
	}
	
	//allowing only letters, numbers and underscore
	//minimum of 5 characters and maximum of 15
	public function isPassValid ( $passChecker ) {
		$regex = "/^[a-zA-Z0-9_]{5,15}$/i";
	
		if (! preg_match ( $regex , $passChecker ) )
			return ( false ) ;
			else
				return ( true ) ;
	}
}
?>