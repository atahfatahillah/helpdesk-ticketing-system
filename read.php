<?php 
  require 'database.php';
  $id = null;
  if ( !empty($_GET['id'])) {
    $id = $_REQUEST['id'];
  }
  
  if ( null==$id ) {
    header("Location: index.php");
  } else {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM tickets_data where nim = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Tickets Details</title>
    <link   href="css/bootstrap.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <style type="text/css">
      body {
        margin: auto;
        margin-top: 15%;
      }
    </style>
</head>

<body>
    <div class="container">
<div class="panel panel-primary">
  <!-- Default panel contents -->
  <div class="panel-heading">Tickets Details</div>

  <!-- Table -->
  <table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>NIM</th>
      <th>Nama</th>
      <th>Tempat Lahir</th>
      <th>Tanggal Lahir</th>
      <th>Alamat</th>
      <th>No.Telepon</th>
    </tr>
  </thead>
  <tbody>
    <td><?php echo $data['nim'] ?></td>
    <td><?php echo $data['nama'] ?></td>
    <td><?php echo $data['tempat_lahir'] ?></td>
    <td><?php echo $data['tanggal_lahir'] ?></td>
    <td><?php echo $data['alamat'] ?></td>
    <td><?php echo $data['notelp'] ?></td>
  </tbody>
  </table>
</div>
<center>
<a href="user.php"><button class="btn btn-primary">Back</button></a>
</center>        
    </div> <!-- /container -->
  </body>
</html>