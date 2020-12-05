<!DOCTYPE HTML>
<html>
    <head>
        <title>ViewRegistered</title>
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
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr >
            <td colspan="1">Please Enter Your Student ID</td>
            <td colspan="2"><input type='text' name='studentID' class='form-control' /></td>
        </tr>
        <td colspan="2">
                <input type='submit' value='Submit' class='btn btn-primary' /> &nbsp &nbsp
                
            </td>
        </tr>
</table>
</form>
    <div class="a">
            <h1>Your Registered Classes</h1>
    </div>
    
    <?php
    include 'config/database.php';

    if($_POST){
        try{
        //prepare insert query
        $query = "SELECT studentID FROM Students WHERE studentID = :studentID LIMIT 0,1"; 
        $stmt = $con->prepare( $query );

        $studentID=htmlspecialchars(strip_tags($_POST['studentID']));

        // bind the parameters
        $stmt->bindParam(':studentID', $studentID);
     

        // execute our query
        $stmt->execute();
        //boolean to check if the ID exists
        $exists = $stmt->fetch();
        
        if($exists){
            // query to pull registered classes for the given student
            $query = "SELECT classes.classID, classes.className, classes.classDescription, classes.timeOfClass, class_student.studentID
            FROM classes
            INNER JOIN class_student ON class_student.classID = classes.classID            
            WHERE class_student.studentID = :studentID ";
            $stmt = $con->prepare($query);

            $studentID=htmlspecialchars(strip_tags($_POST['studentID']));
            $stmt->bindParam(':studentID', $studentID);
                 $stmt->execute();
    
            // get number of rows returned
            $num = $stmt->rowCount();
    
              
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
               echo "</tr>";
        }
    
        // end table
        echo "</table>";
        
        }
    
        // if no records found
        else{
            echo "<div class='alert alert-danger'>No records found.</div>";
        }
    }
    else {
        echo "<div class='alert alert-danger'>Student ID does not exist.</div>";
    }
    }
     // show errors
    catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
    }
} 
?>
<!-- html form here where the student enters their ID to verify registration -->
<a href='getClasses.php' class='btn btn-default'>Return to Class List</a> &nbsp &nbsp
<a href='index.html' class='btn btn-danger'>Return to Main Menu</a>
<br/> <br/> <br/>


</div>
</body>
</html>