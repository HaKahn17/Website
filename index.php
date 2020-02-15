

<!DOCTYPE html>
<head>
<title>Haakon Larsen - Contact Me</title>
<style>
.error {color: #FF0000;}

    .button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  transition-duration: 0.6s;
  cursor: pointer;
}

.home {
  border-radius:12px;
  background-color: #008CBA; 
  color: white; 
  border: 2px solid #008CBA;
}

.home:hover {
  background-color: white;
  border: 2px solid #008CBA;
  color: #008CBA;;

}
</style>
</head>
<body style="height:1500px;background-image: url('background.jpg');background-size: cover;color:white;">
    
    <?php
// define variables and set to empty values
$nameErr = $emailErr = $commentErr = "";
$name = $email = $comment = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $canPost = true;
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
    $canPost=false;
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
      $canPost=false;
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
    $canPost=false;
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
      $canPost=false;
    }
  }

  if (empty($_POST["message"])) {
    $comment = "";
    $commentErr = "Message cannot be empty";
    $canPost=false;
  } else {
    $comment = test_input($_POST["message"]);
  }
  if($canPost)
  {
      
if(isset($_POST['submit'])){
    $to = "larsenha@grinnell.edu"; 
    $from = "haakon@haakon-larsen.com"; 
    $name = $_POST['name'];
    $subject = "Website Contact Form Submission";

    $message = $name . ", using the email address " . $_POST['email'] . " wrote the following:" . "\n\n" . $_POST['message'];

    $headers = "From:" . $from;

    mail($to,$subject,$message,$headers);


    header('Location: thank_you.php');
    // You can also use header('Location: thank_you.php'); to redirect to another page.
    }

  }

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
    
    <div style="height:20px;"></div>
<div>
    <center>
        <span style="font-size:48px;"><code>Contact Me</code></span>
        <div>
    <center><button onClick="window.location.href = 'https://haakon-larsen.com/home/';" class="button home">Home</button></center>
</div>
<div style="width:1000px;background-color:black;opacity:0.9">
<p><span class="error">* indicates required field.</span></p>
<form style="color:white;font-size:20px;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
Name<span class="error">* <?php echo $nameErr;?></span><br><input style="background-color:white;" type="text" name="name" value="<?php echo $name;?>">
  <br><br>
Email<span class="error">* <?php echo $emailErr;?></span><br><input style="background-color:white;" type="text" name="email" value="<?php echo $email;?>"><br><br>
Message<span class="error">* <?php echo $commentErr;?></span><br><textarea style="background-color:white;" rows="10" name="message" cols="100"><?php echo $comment;?></textarea><br><br>
<input class="button home" type="submit" name="submit" value="Submit">
</form>

<div style="background-color:black;padding: 5px 10px; display: block; text-align: center; margin-left: auto;"><span style="color:#FFFFFF;"><span style="font-size:14px;"><font face="monospace"><code><span style="background-color:#000000;">&copy;2020 Haakon Larsen</span></code></font></span></span></div>
</center>
</div>
</div>
</body>
</html>