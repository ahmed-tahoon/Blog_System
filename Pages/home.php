<?php
include('../includes/header.php');
session_start();

if(!isset($_SESSION['user_id']))
{
        header('Location: login.php');
        exit;
}





?>
<div class="container">
    <h1>Welcome</h1>
    <h2>
        <?=$_SESSION['username'] ?>
    </h2>
    <br>
    <h3>
        <?=$_SESSION['email'] ?>
    </h3>


</div>
<?php
include('../includes/footer.php')
?>