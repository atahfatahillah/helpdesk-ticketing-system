<?php 
	require 'database.php';
	$id = 0;
	
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( !empty($_POST)) {
		// keep track post values
		$id = $_POST['id'];
		
		// delete data
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM tickets_data  WHERE nim = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		Database::disconnect();
		header("Location: index.php");
		
	} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <style type="text/css">
    	body {
    		margin: auto;
    		padding: 5%;
    	}
    	.panel {
    		width: 40%;
    		margin: auto;
    	}
    </style>
</head>

<body>
    <div class="container">
    <div class="panel panel-danger">
    <div class="panel-heading">
    			<h2>Delete a Tickets</h2>
  			</div>
		    		<div class="panel-body">
	    			<form class="form-horizontal" action="delete.php" method="post">
	    			  <input type="hidden" name="id" value="<?php echo $id;?>"/>
					  <p class="alert alert-error">Are you sure to delete ?</p>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-danger">Yes</button>
						  <a class="btn btn-default" href="index.php">No</a>
						</div>
					</form>
					</div>
				</div>
    </div> <!-- /container -->
  </body>
</html>