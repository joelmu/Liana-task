<?php
require_once 'connection.php';

$username = $password = "";
$usernameErr = $passwordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["username"]))) {
        $usernameErr = 'Please enter username.';
    } else {
        $username = trim($_POST["username"]);
    }

    if (empty(trim($_POST['password']))) {
        $passwordErr = 'Please enter your password.';
    } else {
        $password = trim($_POST['password']);
    }

    if (empty($usernameErr) && empty($passwordErr)) {
        $sql = "SELECT username, code FROM admins WHERE username = '$username'";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $hashed_password = $row["code"];
            if (password_verify($password, $hashed_password)) {
                session_start();
                $_SESSION['username'] = $username;
                header("location: list.php");
            } else {
                $passwordErr = 'The password you entered was not valid.';
            }
        } else {
            $usernameErr = 'No account found with that username.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
        <div class="container" >
				<h2>Login as admin</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input class="form-control" type="text" name="username" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $usernameErr; ?></span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input class="form-control" type="password" name="password">
                <span class="help-block"><?php echo $passwordErr; ?></span>
            </div>
						<div class="form-group">
								<a href="./index.php" class="btn btn-danger" >Go home</a>
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
        </form>
    </div>
				</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>