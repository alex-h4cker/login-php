<?php 
if($_SERVER['REOUEST_METHOD'] == 'POST'){
    if ($_POST['email'] == 'ali@gmail.com' && $_POST['password'] == 'ali') {
        //
    } else {
        header(location: login.php)
    }
}
?>
