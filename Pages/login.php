<?php
session_start();
include('../includes/header.php');
// Include the User class and database configuration
require_once('../classes/User.php');
require_once('../config/database.php');


// Check if the user is already logged in

if(isset($_SESSION['user_id']))
{
        // Redirect the user to the dashboard page
            header('Location: home.php');
            exit;
}


// Check if the login form has been submitted

if($_POST && isset($_POST['login']) &&  isset($_POST['email']) &&  isset($_POST['password']))
{
       // Get the email and password from the form

    $email = ($_POST['email']);
    $password = ($_POST['password']);

        // Create a new User object
    $user = new User($pdo);

    // Try to log the user in
    $resuilt = $user->login($email ,$password );

    if($resuilt===true)
    {
        header('Location: home.php');
        exit;
    }
    else
    {
                // If login fails, display an error message
        $error = $resuilt;
    }


    
}






?>
<div class="container">
    <h1>Login</h1>
    <?php if (isset($error)): ?>
    <div class="alert alert-danger">
        <ul>
            <li><?= $error ?></li>
        </ul>
    </div>
    <?php endif ?>

    <form method="post">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <button type="submit" name="login" class="btn btn-primary mt-2">Login</button>
    </form>
</div>
<?php
include('../includes/footer.php')
?>