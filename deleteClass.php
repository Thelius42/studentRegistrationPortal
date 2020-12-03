<?php
// include database connection
include 'config/database.php';

try {
	
	// get record ID
	// isset() is a PHP function used to verify if a value is there or not
	$classID=isset($_GET['classID']) ? $_GET['classID'] : die('ERROR: Record ID not found.');

	// delete query
	$query = "DELETE FROM registration.classes WHERE classID = ?";
	$stmt = $con->prepare($query);
	$stmt->bindParam(1, $classID);
	
	if($stmt->execute()){
		// redirect to read records page and 
		// tell the user record was deleted
		header('Location: maintainClasses.php?action=deleted');
	}else{
		die('Unable to delete record.');
	}
}

// show error
catch(PDOException $exception){
	die('ERROR: ' . $exception->getMessage());
}
?>