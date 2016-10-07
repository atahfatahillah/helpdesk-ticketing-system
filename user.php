<?php
session_start();
ini_set('display_errors','Off');
if(empty($_SESSION)){
	header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Helpdesk Ticketing Support - Dashboard</title>

	<!-- Bootstrap -->
	<link href="css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" href="css/jquery.dataTables.css">
	<style>
	</style>
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand">Helpdesk Ticketing System</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['username']; ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="container">
<div class="bg">
<ul  class="nav nav-pills">
	<li class="active">
		<a href="#1a" data-toggle="tab">Active Tickets<span class="badge">0</span></a>
	</li>
	<li>
		<a href="#2a" data-toggle="tab">Completed Tickets<span class="badge">0</span></a>
	</li>
</ul>
</div>
	<div class="tab-content clearfix">
		<div class="tab-pane active" id="1a">
			<div class="panel panel-default">
  			<div class="panel-heading">
    			<h1>My Tickets
    			<a href="create.php"><button type="button" class="btn btn-primary pull-right">Create New Tickets</button></a></h1>
  			</div>
  			<div class="panel-body">
    			<table class="table table-striped table-bordered">
		              <thead>
		                <tr>
		                  <th>#</th>
		                  <th>Subject</th>
		                  <th>Status</th>
		                  <th>Last Update</th>
		                  <th>Owner</th>
		                  <th>Category</th>
		                  <th>Action</th>
		                </tr>
		              </thead>
		              <tbody>
		              	<?php
                   include 'database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM tiket ORDER BY id ASC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['id'] . '</td>';
                            echo '<td>'. $row['subject'] . '</td>';
                            echo '<td>'. $row['status'] . '</td>';
                            echo '<td>'. $row['last_update'] . '</td>';
                            echo '<td>'. $row['owner'] . '</td>';
                            echo '<td>'. $row['category'] . '</td>';
                            echo '<td>
                            	<a href="read.php?id='.$row['nim'].'"><button class="btn btn-default"><span class="glyphicon glyphicon-eye-open"></span></button></a>
                            	<a href="read.php?id='.$row['nim'].'"><button class="btn btn-default"><span class="glyphicon glyphicon-ok"></span></button></a>
                            	<a href="delete.php?id='.$row['nim'].'"><button class="btn btn-default"><span class="glyphicon glyphicon-remove"></span></button></a></td>';
                            echo '</tr>';
                   }
                   Database::disconnect();
                  ?>
				      </tbody>
	            </table>
  			</div>
			</div>
		</div>
		<div class="tab-pane" id="2a">
			<div class="panel panel-default">
  			<div class="panel-heading">
    			<h1>My Tickets
    			<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal">Create New Tickets</button></h1>
  			</div>
  			<div class="panel-body">
    			<table class="table">
    			
    			</table>
  			</div>
			</div>
		</div>
	</div>
	<footer>
		<div class="container">
		<center>
			<h5>&copy; 2016 | Fatahillah - Helpdesk Ticketing System</h5>
		</center>
		</div>
	</footer>
</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>