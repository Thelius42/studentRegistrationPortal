<?php
// include database connection
include 'config/database.php';

try {
	
	// get record ID
	// isset() is a PHP function used to verify if a value is there or not
	$studentID=isset($_GET['studentID']) ? $_GET['studentID'] : die('ERROR: Record ID not found.');

	// delete query
	$query = "DELETE FROM registration.students WHERE studentID = ?";
	$stmt = $con->prepare($query);
	$stmt->bindParam(1, $studentID);
	
	if($stmt->execute()){
		// redirect to read records page and 
		// tell the user record was deleted
		header('Location: maintainStudent.php?action=deleted');
	}else{
		die('Unable to delete record.');
	}
}

// show error
catch(PDOException $exception){
	die('ERROR: ' . $exception->getMessage());
}
?>