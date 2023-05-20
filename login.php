<?php
    $host = "localhost";
    $username = "your_username";
    $password = "your_password";
    $dbname = "your_database_name";

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $username = $_POST['username'];
        $password = $_POST['password'];

        
        $stmt = $conn->prepare("SELECT * FROM users WHERE username=:username AND password=:password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', md5($password));
        $stmt->execute();

        
        if($stmt->rowCount() > 0) {
            echo "<script>alert('Login successful!')</script>";

            header("Location: dashboard.php");
            exit();
        } else {
            echo "<script>alert('Invalid username or password. Please try again.')</script>";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
 <title>Login Form</title>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <style type="text/css">
  body {
   font-family: Arial, sans-serif;
   background-color: #f4f4f4;
  }
  form {
   background-color: #fff;
   padding: 20px;
   border-radius: 5px;
   box-shadow: 0px 0px 10px rgba(0,0,0,0.2);
   max-width: 500px;
   margin: auto;
   margin-top: 50px;
  }
  input[type=text], input[type=password] {
   width: 100%;
   padding: 12px 20px;
   margin: 8px 0;
   display: inline-block;
   border-radius: 4px;
   box-sizing: border-box;
   border: none;
  }
  button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin-top:10px; 
    border-radius :5px; 
    cursor:pointer; 
  }
  
    </style>
</head>
<body>

<form onsubmit="return validateForm()">
    <h2>Login Form</h2>

    <label for="username"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" id="username" required>

    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" id="password" required>

    <button type="submit">Login</button>
</form>

<script type="text/javascript">
 function validateForm() {
  var username = document.getElementById("username").value;
  var password = document.getElementById("password").value;

  if (username == "" || password == "") {
   alert("Please fill in all fields.");
   return false;
  } else {
   alert("Login successful!");
   return true;
  }
 }
</script>

</body>
</html>
