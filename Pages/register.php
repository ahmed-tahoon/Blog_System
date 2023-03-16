<?php
include('../includes/header.php');

// Include the User class and database configuration
require_once('../classes/User.php');
require_once('../config/database.php');




if($_POST && isset($_POST['register']))
{
   
// Create a new instance of the User class
$user = new User($pdo);


    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = ($_POST['password']);

    
 // Call the register() method to add the user to the database
    $resuilt = $user->register($username ,$email ,$password );

    if($resuilt===true)
    {
                // If the registration was successful, redirect to the login page
        header('Location: login.php');
        exit;
    }
    else
    {
                // If there were errors, display them to the user
        $errors= $resuilt;
    }


    
}






?>
<div class="container">
    <h1>Register</h1>
    <?php if (isset($errors)): ?>
    <div class=" alert alert-danger">
        <ul>
            <?php foreach ($errors as $error): ?>
            <li><?= $error ?></li>
            <?php endforeach ?>
        </ul>
    </div>
    <?php endif ?>

    <form method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <button type="submit" name="register" class="btn btn-primary mt-2">Register</button>
    </form>
</div>
<?php
include('../includes/footer.php')
?>