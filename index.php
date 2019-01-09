<?php 
include('server.php');

	  if (!isset($_SESSION['username'])) {
	  	$_SESSION['msg'] = "You must log in first";
	  	header('location: login.php');
	  }
	  if (isset($_GET['logout'])) {
	  	session_destroy();
	  	unset($_SESSION['username']);
	  	header("location: login.php");
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
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">My Phonebook</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <a href="index.php?logout='1'" class="btn" type="button" style="color: none;">logout</a>
    </ul>
  </div>
</nav>
	<?php if (isset($_SESSION['message'])): ?>
		<div class="msg">
			<?php 
				echo $_SESSION['message']; 
				unset($_SESSION['message']);
			?>
		</div>
	<?php endif ?>


	

<form method="post" action="" >

	<input type="hidden" name="id" value="<?php echo $id; ?>">

	<div class="input-group" style="width:107%;">
		<label>Name</label>
		<input type="text" required name="name"value="<?php echo $name; ?>">
	</div>
	<div class="input-group"style="width:107%;">
		<label>Number</label>
		<input type="number" required name="numbers" value="<?php echo $numbers; ?>">
	</div>

		<?php if ($update == true): ?>
			<button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
		<?php else: ?>
			<button class="btn" type="submit" name="save" >Save</button>
		 	<a href="view.php?username=<?php echo $_GET['username']; ?>" class="btn btn-info" role="button">View</a>
		<?php endif ?>

		<?php  if (isset($_SESSION['username'])) : ?>
    	
    <?php endif ?>
	</div>
</form>
</body>
</html>
