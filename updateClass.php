<!DOCTYPE HTML>
<html>
<html>
    <head>
        <title>Update Class Record</title>
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<script type="text/javascript">
        	if (typeof jQuery == 'undefined') {
		        document.write(unescape("%3Cscript src='../../Shared/jquery.js' type='text/javascript'%3E%3C/script%3E")); }
        </script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <style>
        .jumbotron {
            /* Permalink - use to edit and share this gradient: https://colorzilla.com/gradient-editor/#87e0fd+0,53cbf1+40,05abe0+100;Blue+3D+%23+16 */
            background: #87e0fd; /* Old browsers */
            background: -moz-linear-gradient(top, #87e0fd 0%, #53cbf1 40%, #05abe0 100%); /* FF3.6-15 */
            background: -webkit-linear-gradient(top, #87e0fd 0%,#53cbf1 40%,#05abe0 100%); /* Chrome10-25,Safari5.1-6 */
            background: linear-gradient(to bottom, #87e0fd 0%,#53cbf1 40%,#05abe0 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#87e0fd', endColorstr='#05abe0',GradientType=0 ); /* IE6-9 */
            h4 {
                text-indent: 156px;
            }
        }
        div.a{
            margin-left: 100px;
            background-color: 'gray';            
        }
        .table td {
            text-align: center;
        } 
        </style>
<body>

    <div class="page-header">
          <div class="jumbotron text-center">
              <h1 >Loney University Student Registration Portal</h1></div>
          </div>
      </div>
<!-- container -->
<div class="container">
 
 <div class="page-header">
     <h1>Update Class Record</h1>
 </div>

 <?php
// get passed parameter value, in this case, the record ID
// isset() is a PHP function used to verify if a value is there or not.  $_GET pulls the parameter from the last page
$classID=isset($_GET['classID']) ? $_GET['classID'] : die('ERROR: Class ID not found.');

//include database connection
include 'config/database.php';

// read current record's data
try {
	// prepare select query
	$query = "SELECT classID, className, classDescription, timeOfClass FROM classes WHERE classID = ? LIMIT 0,1";
	$stmt = $con->prepare( $query );
	
	// this is the first question mark
	$stmt->bindParam(1, $classID);
	
	// execute our query
	$stmt->execute();
	
	// store retrieved row to a variable
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	// values to fill up our form
	$className = $row['className'];
    $classDescription = $row['classDescription'];
    $timeOfClass = $row['timeOfClass'];
}

// show error
catch(PDOException $exception){
	die('ERROR: ' . $exception->getMessage());
}
?>


<?php

// check if form was submitted
if($_POST){
	
	try{
	
		// write update query

		$query = "UPDATE registration.classes 
					SET className=:className, classDescription=:classDescription, timeOfClass=:timeOfClass
					WHERE classID = :classID";

		// prepare query for excecution
		$stmt = $con->prepare($query);

		// posted values
		$lastName=htmlspecialchars(strip_tags($_POST['className']));
        $classDescription=htmlspecialchars(strip_tags($_POST['classDescription']));
        $timeOfClass=htmlspecialchars(strip_tags($_POST['timeOfClass']));

		// bind the parameters
		$stmt->bindParam(':className', $className);
        $stmt->bindParam(':classDescription', $classDescription);
        $stmt->bindParam(':timeOfClass', $timeOfClass);
		$stmt->bindParam(':classID', $classID);
		
		// Execute the query
		if($stmt->execute()){
			echo "<div class='alert alert-success'>Record was updated.</div>";
		}else{
			echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
		}
		
	}
	
	// show errors
	catch(PDOException $exception){
		die('ERROR: ' . $exception->getMessage());
	}
}
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?classID={$classID}");?>" method="post">
	<table class='table table-hover table-responsive table-bordered'>
		<tr>
			<td>Class Name</td>
			<td><input type='text' name='className' value="<?php echo htmlspecialchars($className, ENT_QUOTES);  ?>" class='form-control' /></td>
		</tr>
		<tr>
			<td>Class Description</td>
			<td><textarea name='classDescription' class='form-control'><?php echo htmlspecialchars($classDescription, ENT_QUOTES);  ?></textarea></td>
		</tr>
        <tr>
			<td>Time Of Class</td>
			<td><textarea name='timeOfClass' class='form-control'><?php echo htmlspecialchars($timeOfClass, ENT_QUOTES);  ?></textarea></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input type='submit' value='Save Changes' class='btn btn-primary'/>&nbsp &nbsp
				<a href='maintainClasses.php' class='btn btn-default'>Return to Maintain Classes  </a>&nbsp &nbsp
				<a href='index.html' class='btn btn-danger'>Back to Main Menu</a>
			</td>
		</tr>
	</table>
</form>
 
</div> <!-- end .container -->


</body>
</html>