<?php 
include('server.php');
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM contacts WHERE id=$id");

		$n = mysqli_fetch_array($record);
		$name = $n[1];
		$numbers = $n[2];
		
		
	}
?>
<!DOCTYPE html>
<html>
<head>
 <title>phonebook</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}
</style>
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">My Phonebook</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
  </div>
</nav>
<?php $results = mysqli_query($db, "SELECT * FROM contacts"); ?>
<div style="overflow-x:auto;">
<table>
	<thead>
		<tr>
			<th>Name</th>
			<th>Number</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>
	
	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
			<td><?php echo $row['name']; ?></td>
			<td><?php echo $row['numbers']; ?></td>
			<td>
				<a href="index.php?edit=<?php echo $row['id']; ?>" class="glyphicon glyphicon-edit" >Edit</a>
			</td>
			<td>
				<a href="server.php?del=<?php echo $row['id']; ?>" class="glyphicon  glyphicon-trash">Delete</a>
			</td>
		</tr>
	<?php } ?>
	<a href="index.php" class="btn btn-info" role="button">Back</a>


</table>
</div>
</body>
</html>