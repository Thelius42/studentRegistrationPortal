<!DOCTYPE HTML>
<html>
<html>
    <head>
        <title>Show Available Classes</title>
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
            <h1>Available Classes</h1>
        </div>
	
        <?php
// include database connection
include 'config/database.php';

// delete message prompt will be here

// select all data
$query = "SELECT classID, className, classDescription, timeOfClass FROM registration.classes ORDER BY classID DESC";
$stmt = $con->prepare($query);
$stmt->execute();

// this is how to get number of rows returned
$num = $stmt->rowCount();

// link to return to main menu
echo "<a href='index.html' class='btn btn-danger m-b-1em'>Return to main menu</a>";
echo '<br/> <br/> <br/>';

//check if more than 0 record foundadd 
if($num>0){

    // data from database will be here
    echo "<table class='table table-hover table-responsive table-bordered'>";//start table

	//creating our table heading
	echo "<tr>";
		echo "<th>Class ID</th>";
		echo "<th>Class Name</th>";
		echo "<th>Description</th>";
        echo "<th>Time of Class</th>";
        echo "<th>Action</th>";
	echo "</tr>";

    // retrieve our table contents

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	// extract row
	extract($row);
	
	// creating new table row per record
	echo "<tr>";
		echo "<td>{$classID}</td>";
		echo "<td>{$className}</td>";
		echo "<td>{$classDescription}</td>";
        echo "<td>{$timeOfClass}</td>";
        echo "<td>";
			// Button to register for this class
			echo "<a href='registerForClass.php?classID={$classID}' class='btn btn-primary m-r-1em'>Register</a>";

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
		
    </div> <!-- end .container -->

</body>
</html>