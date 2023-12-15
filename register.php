<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "doctors_appointment_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $address = $_POST["address"];
    $contact = $_POST["contact"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data into the database
    $insert_query = "INSERT INTO users (name, address, contact, username, password) VALUES ('$name', '$address', '$contact', '$username', '$hashed_password')";

    if ($conn->query($insert_query) === TRUE) {
        // Registration successful
        $success_message = "Registration successful!";
    } else {
        // Display an error message
        $error = "Error: " . $insert_query . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register | Web Mike</title>
    <link rel="icon" type="image/png" href="favicon.png">
    <link rel="stylesheet" href="create.css">
</head>
<body>
    <div class="wrapper">
        <form method="post" action="">
            <h2>Create Account</h2>
            <?php if (isset($error)) { ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php } ?>

    <?php if (isset($success_message)) { ?>
        <p style="color: green;"><?php echo $success_message; ?></p>
    <?php } ?>
    <div class="input-field">
    <label for="name">Name:</label>
        <input type="text" name="name" required><br>
    </div>
    <div class="input-field">
    <label for="address">Address:</label>
        <input type="text" name="address" required><br>
    </div>   
    <div class="input-field">
    <label for="address">Address:</label>
        <input type="text" name="address" required><br>
    </div> 
    <div class="input-field">
    <label for="contact">Contact:</label>
        <input type="text" name="contact" required><br>
    </div> 

    <div class="input-field">
    <label for="username">Username:</label>
        <input type="text" name="username" required><br>
    </div> 
    <div class="input-field">
    <label for="username">Username:</label>
        <input type="text" name="username" required><br>
    </div> 
    <div class="input-field">
    <label for="password">Password:</label>
        <input type="password" name="password" required><br>
        </div> 
        <div class="input-field">
        <label for="password">Password:</label>
        <input type="password" name="password" required><br>
        </div> 


       

        

        

        

        <button type="submit">Register</button>
        <p>Already have an account? <a href="login1.php">Login here! </a></p>
            </div>
            
        </form>
    </div>
</body>
</html>
