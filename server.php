<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 
$name = "";
$numbers = "";
$user_id ="";
$id = 0;
$update = false;
// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'myphonebook');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (username, email, password) 
  			  VALUES('$username', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: login.php');
  }
}

// ... 
// ... 

// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: index.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}

//insert data into database 
  if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $numbers = $_POST['numbers'];
    $user_id = $_POST['user_id'];

    mysqli_query($db, "INSERT INTO contacts (name, numbers, users_id) VALUES ('$name', '$numbers','$user_id')"); 
    $_SESSION['message'] = "saved"; 
    header('location: index.php');
  }

// update data into database
  if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $numbers = $_POST['numbers'];

    mysqli_query($db, "UPDATE contacts SET name='$name', numbers='$numbers' WHERE id=$id");
    $_SESSION['message'] = "updated!"; 
    header('location: view.php');
  }
//delete data into database
if (isset($_GET['del'])) {
  $id = $_GET['del'];
  mysqli_query($db, "DELETE FROM contacts WHERE id=$id"); 
  header('location: view.php');
}



    $results = mysqli_query($db, "SELECT * FROM contacts");

?>