<?php
session_start();
ini_set('display_errors','Off');
if(empty($_SESSION)){
  header("Location: index.php");
}

require 'database.php';
if ( !empty($_POST)) {
    // keep track validation errors
    $subjectError = null;
    $priorityError = null;
    $ownerError = null;
    $categoryError = null;
    
    // keep track post values
    $subject = $_POST['subject'];
    $priority = $_POST['priority'];
    $owner = $_POST['owner'];
    $category = $_POST['category'];
    
    // validate input
    $valid = true;    
    if (empty($subject)) {
      $subjectError = 'Please enter Subject';
      $valid = false;
    }

    if (empty($priority)) {
      $priorityError = 'Please enter Priority';
      $valid = false;
    }

    if (empty($owner)) {
      $ownerError = 'Please enter Owner';
      $valid = false;
    }

    if (empty($category)) {
      $categoryError = 'Please enter Category';
      $valid = false;
    }
    
    // insert data
    if ($valid) {
      $pdo = Database::connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "INSERT INTO tickets_data (subject,priority,owner,category) values(?, ?, ?, ?)";
      $q = $pdo->prepare($sql);
      $q->execute(array($subject,$priority,$owner,$category));
      Database::disconnect();
      header("Location: user.php");
    }
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
            <li><a href="user.php"><span class="glyphicon glyphicon-chevron-left"></span> Back</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="container">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h1>Create Your Tickets</h1>
      </div>
      <div class="panel-body-create">
          <form action="create.php" method="POST">
            <div class="form-group <?php echo !empty($subjectError)?'error':'';?>">
              <label>Subject</label>
              <input name="subject" type="text" class="form-control" placeholder="Nama Lengkap" value="<?php echo !empty($subject)?$subject:'';?>">
              <?php if (!empty($subjectError)): ?>
                    <span class="help-inline"><?php echo $subjectError;?></span>
              <?php endif; ?>
            </div>
            <div class="form-group <?php echo !empty($priorityError)?'error':'';?>">
              <label>Priority</label>
              <select name="priority" class="form-control" value="<?php echo !empty($priority)?$priority:'';?>">
                <option value=Critical>Critical</option>
                <option value=Normal>Normal</option>
                <option value=Low>Low</option>
              </select>
              <?php if (!empty($priorityError)): ?>
                    <span class="help-inline"><?php echo $priorityError;?></span>
              <?php endif; ?>
            </div>
            <div class="form-group <?php echo !empty($ownerError)?'error':'';?>">
              <label>Owner</label>
              <input name="owner" type="text" class="form-control" placeholder="Owner" value="<?php echo !empty($owner)?$owner:'';?>">
              <?php if (!empty($ownerError)): ?>
                    <span class="help-inline"><?php echo $ownerError;?></span>
              <?php endif; ?>
            </div>
            <div class="form-group <?php echo !empty($categoryError)?'error':'';?>">
              <label>Category</label>
              <select name="category" class="form-control" value="<?php echo !empty($category)?$category:'';?>">
                <option value=Technical>Technical</option>
                <option value=Billing>Billing</option>
                <option value=CustomerService>Customer Service</option>
              </select>
              <?php if (!empty($categoryError)): ?>
                    <span class="help-inline"><?php echo $categoryError;?></span>
              <?php endif; ?>
            </div>
            <center>
            <button class="btn btn-default" type="reset">Cancle</button>
            <button class="btn btn-success" type="submit">Create</button>
            </center>
        </form>
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