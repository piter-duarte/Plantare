<?php
include ("../config/config.php");
$objEvents= new \Classes\ClassEvents();
$username=filter_input(INPUT_POST,'username', FILTER_DEFAULT);
$password=filter_input(INPUT_POST,'password', FILTER_DEFAULT);

$objEvents->searchUser(
    $username,
    $password
);
?>
<script>window.location.replace("<?php echo DIRPAGE.'/views/user'?>");</script>