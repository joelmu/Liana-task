<?php
require_once './connection.php';
session_start();
if (isset($_SESSION['username'])) {
    $sql = "SELECT email, activity FROM list";
    $result = $conn->query($sql);

    $emails = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $emails[] = array('email' => $row['email'], 'activity' => $row['activity']);
        }
    }
} else {
    header("location: ./index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Email list</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="container">
<h2>List of emails in the database</h2>
<p>1 = verified email and 0 = not verified.</p>
<table class="table">

<thead>
<tr>
<th>Email</th>
<th>Activity</th>
</tr>
</thead>
<?php foreach ($emails as $email) {
    echo '<tr>';
    echo '<td>' . $email['email'] . "</td>";
    echo '<td>' . $email['activity'] . '</td>';
    echo '<tr>';
}
?>


</table>
<a href="./logout.php" class="btn btn-info" >Logout</a>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>