<?php require_once("includes/init.php"); ?>

<?php
if($session->is_signed_in()) {
    redirect("index.php");
}

if(isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['passoword']);

//method to check if the user in found in the DB

$user_found = User::verify_user($username, $password);


if($user_found) {

    $session->login($user_found);
    redirect("index.php");
} else {
    $the_message = "Your password/Username is incorrect";
}
} else {
    $username = "";
    $password = "";

}
?>
