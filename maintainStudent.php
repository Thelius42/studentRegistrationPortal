<!DOCTYPE HTML>
<html>
    <head>
        <title>Maintain Students</title>
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
            <h1>Update Student Records</h1>
        </div>
	
        <?php
// include database connection
include 'config/database.php';

$action = isset($_GET['action']) ? $_GET['action'] : "";

// if it was redirected from delete.php
if($action=='deleted'){
	echo "<div class='alert alert-success'>Record was deleted.</div>";
}

// select all data
$query = "SELECT studentID, lastName, firstName FROM registration.students ORDER BY lastName";
$stmt = $con->prepare($query);
$stmt->execute();

// this is how to get number of rows returned
$num = $stmt->rowCount();

// link to return to main menu
echo "<a href='index.html' class='btn btn-danger m-b-1em'>Return to main menu</a>";
echo '<br/> <br/> <br/>';

//check if more than 0 record found 
if($num>0){

    // data from database 
    echo "<table class='table table-hover table-responsive table-bordered'>";//start table

	//creating  table heading
	echo "<tr>";
		echo "<th>Student ID</th>";
		echo "<th>Last Name</th>";
		echo "<th>First Name</th>";
        echo "<th>Action</th>";
	echo "</tr>";	

    // retrieve  table contents

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	// extract row

	extract($row);
	
	// creating new table row per record
	echo "<tr>";
		echo "<td>{$studentID}</td>";
		echo "<td>{$lastName}</td>";
		echo "<td>{$firstName}</td>";
        echo "<td>";
			// Button to update the student record
            echo "<a href='updateStudent.php?studentID={$studentID}' class='btn btn-primary m-r-1em'>Update</a> &nbsp &nbsp" ;
            // Button to delete the student record
            echo "<a href='#' onclick='delete_user({$studentID});'  class='btn btn-danger'>Delete</a>";  
		echo "</td>";
		echo "</tr>";
}

// end table
echo "</table>";	
}

// if no records found
else{
	echo "<div class='alert alert-danger'>No records found.</div>";
}
?>

<script type='text/javascript'>
// confirm record deletion
function delete_user( studentID ){
	
	var answer = confirm('Are you sure?');
	if (answer){
		// if user clicked ok, 
		// pass the Student id to delete.php and execute the delete query
		window.location = 'deleteStudent.php?studentID=' + studentID;
	} 
}
</script>
		
    </div> <!-- end .container -->
    <p class = "text-center"><br/><br/>    
        <a href='createStudent.php' class ="btn btn-primary"> Add a New Student</a>        
        </p><br/><br/>
</body>
</html>