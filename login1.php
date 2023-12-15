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
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Retrieve user data from the database
    $query = "SELECT id, username, password FROM users WHERE username = '$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row["password"];

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Password is correct, set session variables
            $_SESSION["login_id"] = $row["id"];
            $_SESSION["login_name"] = $row["username"];

            // Redirect to the home page or any other page after successful login
            header("Location: index.php");
            exit();
        } else {
            // Display an error message for incorrect password
            $error = "Incorrect password.";
        }
    } else {
        // Display an error message for unknown username
        $error = "Username not found.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>

    <title>Login | Doctors Appointment</title>
    <link rel="icon" type="image/png" href="favicon.png">
    <link rel="stylesheet" href="sls.css">
    <style>
       /* Add this CSS for the preloader overlay */
.preloader-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    z-index: 9999;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}

.preloader-spinner {
    border: 4px solid rgba(0, 0, 0, 0.1);
    border-top: 4px solid #3498db;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    animation: spin 2s linear infinite;
    margin-bottom: 10px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

    </style>
</head>
<body>
<div id="preloader-overlay" class="preloader-overlay">
    <img src="favicon.png" alt="Loading" class="preloader-image">
    
</div>


    <div class="wrapper">
        <form method="POST" action="" id="login-form">
        

            <h2>Login</h2>
            <?php if (isset($error)) { ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php } ?>
            <div class="input-field">
            <label for="username">Username:</label>
        <input type="text" name="username" required><br>
            </div>
        
                <div class="input-field">
                <label for="password">Password:</label>
        <input type="password" name="password" required><br>
                </div>
        

        <button type="submit">Login</button>
            <div class="forget">
                <label for="remember">
                    <input type="checkbox" id="remember">
                    <p>Remember me</p>
                </label>
                <a href="#">Forgot password?</a>
            </div>
     
            <div class="register">
                <p>Don't have an account? <a href="register.php">Register</a></p>
            </div>
        </form>
        <div id="loading-banner" class="loading-banner">
            <div class="loading-spinner"></div>
            <p>Loading...</p>
        </div>
    </div>
   
</body>
</html>
