<?php
require_once 'connection.php';
if (empty($_GET['id'])) {
    header("location: ./index.php");
}

if (isset($_GET['id'])) {
    $id = base64_decode($_GET['id']);

    $active = 1;
    $inactive = 0;

    $sql = "SELECT activity FROM list WHERE id = $id LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $activity;

        while ($row = $result->fetch_row()) {
            $activity = $row[0];
        }
        if ($activity == $inactive) {

            $sql = "UPDATE list SET activity = 1 WHERE id = $id";

            $msg = "
					 <div>
				<strong>Succesfully verified!</strong>
				 </div>
				 ";
        } else {
            $msg = "
					 <div>
				<strong>This email has been verified already</strong>
				 </div>
				 ";
        }
    } else {
        $msg = "
			 <div>
		 <strong>Can't find this email.
			<a href='index.php'>Add yourself to the list here</a></strong>
		 </div>
		 ";
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<html>
<head>
		<meta charset="UTF-8">
    <title>Verify Subscription</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <?php if (isset($msg)) {
    echo $msg;
}?>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>