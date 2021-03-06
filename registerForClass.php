<!DOCTYPE HTML>
<html>
    <head>
        <title>ClassRegistration</title>
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
    <div class="a">
            <h1>Register for a Class</h1>
        </div>
<?php
// get passed parameter value, in this case, the record ID
// isset() is a PHP function used to verify if a value is there or not.  $_GET pulls the parameter from the last page
$classID=isset($_GET['classID']) ? $_GET['classID'] : die('ERROR: Class ID not found.');

//include database connection
include 'config/database.php';

try {
	// prepare select query
	$query = "SELECT classID, className, classDescription, timeOfClass FROM registration.classes WHERE classID = ? LIMIT 0,1";
	$stmt = $con->prepare( $query );
	
	// this is the first question mark
	$stmt->bindParam(1, $classID);
	
	// execute our query
    $stmt->execute();
}
// show errors
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}

if($_POST){
try{
    //prepare insert query
    $query = "SELECT studentID FROM students WHERE studentID = :studentID LIMIT 0,1"; 
    $stmt = $con->prepare( $query );

    $studentID=htmlspecialchars(strip_tags($_POST['studentID']));

    // bind the parameters
    $stmt->bindParam(':studentID', $studentID);
     

    // execute our query
    $stmt->execute();
    //check if student ID exists, and create registration entry if it does
    $exists = $stmt->fetch();
    if($exists){
        try{
            // insert query
        $query = "INSERT INTO class_student SET studentID=:studentID, classID=:classID";
 
        // prepare query for execution
        $stmt = $con->prepare($query);

        // bind the parameters
        $stmt->bindParam(':studentID', $studentID);
        $stmt->bindParam(':classID', $classID);
        //imported classID
        // Execute the query
		if($stmt->execute()){
			echo "<div class='alert alert-success'>Registration Successful.</div>";
		}else{
			echo "<div class='alert alert-danger'>Unable to register as student is already registered..</div>";
        }
        $stmt->execute();
        }
    // show errors
	catch(PDOException $exception){
	die('ERROR: ' . $exception->getMessage());
	}
    }

    //if doesn't exist, throws error
    else{
        echo "<div class='alert alert-danger'>Student ID does not exist</div>";
    }
}
    // show errors
	catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
        }
}

?>
 
<!-- html form here where the student enters their ID to verify registration -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?classID={$classID}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr >
            <td colspan="1">Please Enter Your Student ID</td>
            <td colspan="2"><input type='text' name='studentID' class='form-control' /></td>
        </tr>
        <td colspan="2">
                <input type='submit' value='Save' class='btn btn-primary' /> &nbsp &nbsp
                <a href='getClasses.php' class='btn btn-default'>Return to Class List</a> &nbsp &nbsp
                <a href='viewRegistered.php' class='btn btn-default'>View Currently Registered Classes</a> &nbsp &nbsp
                <a href='index.html' class='btn btn-danger'>Return to Main Menu</a>
            </td>
        </tr>
    </table>
</form>
</div>
</body>
</html>