<?php
require_once './connection.php';

function sendMail($email, $message, $subject)
{
    require './PHPMailer/src/Exception.php';
    require './PHPMailer/src/PHPMailer.php';
    require './PHPMailer/src/SMTP.php';
    try {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->AddAddress($email);
        $mail->Username = "GMAIL USER";
        $mail->Password = "GMAIL PASS";
        $mail->SetFrom('EMAIL', 'Joel');
        $mail->AddReplyTo("EMAIL", "Joel");
        $mail->Subject = $subject;
        $mail->MsgHTML($message);
        $mail->Send();
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}

$email = "";
$emailErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    if (empty($email)) {
        $emailErr = "Email missing";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    } else {
        $sql = "SELECT email FROM list WHERE email = '$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $msg = "
		<div>
			<strong>This email has already added to our mailing list.</strong>
			</div>
		";
        } else {

            $sql = "INSERT INTO list (email) VALUES ('$email')";
            $result = $conn->query($sql);

            $sql = "SELECT id FROM list WHERE email = '$email'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $id = base64_encode($row["id"]);

            $message = "
                Hello!
                <br />
                You subscribed to our newsletter!<br/>
                You just need to click on the following link to verify your email<br/>
                <a href='http://localhost/task/verification.php?id=$id'>CLICK HERE!</a><br />
                Best Regards,";

            $subject = "Verify Subscription";

            // sendMail($email, $message, $subject);

            $msg = "
		<div>
			<strong>Great! You should receive verification email soon! We add you to the mailing list after you verify your email.</strong>
			</div>
		";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<html>
<head>
		<meta charset="UTF-8">
    <title>Home</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="container">
<h2>Subscribe to our newsletter</h2>
<?php if (isset($msg)) {
    echo $msg;
}
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
<div class="form-group">
<label for="email" >Email</label>
<input class="form-control" type="text" name="email" value="<?php echo htmlspecialchars($email); ?>"><br>
<span class="help-block"><?php echo $emailErr; ?></span>
</div>
<div class="form-group">
<a href="./login.php" class="btn btn-secondary" >Login as admin</a>
<input class="btn btn-success"type="submit">
</div>
</form>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>