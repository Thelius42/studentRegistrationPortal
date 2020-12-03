<!DOCTYPE HTML>
<html>
    <head>
        <title>Add New Class</title>
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
            <h1>Add a New Class</h1>
        </div>
      
          <!-- PHP insert code will be here -->
<?php
if($_POST){
 
    // include database connection
    include 'config/database.php';
 
    try{
     
        // insert query
        $query = "INSERT INTO registration.classes SET classID=:classID, className=:className, classDescription=:classDescription, timeOfClass=:timeOfClass";
 
        // prepare query for execution
        $stmt = $con->prepare($query);
 
        // posted values
        $classID=htmlspecialchars(strip_tags($_POST['classID']));
        $className=htmlspecialchars(strip_tags($_POST['className']));
        $classDescription=htmlspecialchars(strip_tags($_POST['classDescription']));
        $timeOfClass=htmlspecialchars(strip_tags($_POST['timeOfClass']));
 
        // bind the parameters
        $stmt->bindParam(':classID', $classID);
        $stmt->bindParam(':className', $className);
        $stmt->bindParam(':classDescription', $classDescription);
        $stmt->bindParam(':timeOfClass', $timeOfClass);
         
         
        // Execute the query
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Record was saved.</div>";
        }else{
            echo "<div class='alert alert-danger'>Unable to save record.</div>";
        }
         
    }
     
    // show error
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>
 
<!-- html form here where the product information will be entered -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr >
            <td colspan="1">Class ID</td>
            <td colspan="2"><input type='text' name='classID' class='form-control' /></td>
        </tr>
        <tr>
            <td colspan="1">Class Name</td>
            <td colspan="2"><input type='text' name='className' class='form-control' /></td>
        </tr>
        <tr>
            <td colspan="1">Class Description</td>
            <td colspan="2"><input type='text' name='classDescription' class='form-control' /></td>
        </tr>
        <tr>
            <td colspan="1">Time Of Class (time and days)</td>
            <td colspan="2"><input type='text' name='timeOfClass' class='form-control' /></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2">
                <input type='submit' value='Save' class='btn btn-primary' /> &nbsp &nbsp
                <a href='maintainClasses.php' class='btn btn-default'>Return to Maintain Classes</a> &nbsp &nbsp
                <a href='index.html' class='btn btn-danger'>Return to Main Menu</a>
            </td>
        </tr>
    </table>
</form>
    </div> <!-- end .container -->
      

  
</body>
</html>