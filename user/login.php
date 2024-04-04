<?php
        session_start(); // Start a new session or resume the existing one

        // Check if form was submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require_once '../database/db_connect.php';

            // Function to validate user input
            function validateInput($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            $username = validateInput($_POST['username']);
            $password = validateInput($_POST['password']);

            // SQL query to fetch the user by username
            $query = "SELECT * FROM users WHERE username = $1";
            $result = pg_prepare($dbHandle, "fetch_user", $query);
            $result = pg_execute($dbHandle, "fetch_user", array($username));

            if ($row = pg_fetch_assoc($result)) {
                // Verify the password
                if (password_verify($password, $row['password_hash'])) {
                    // Set session variables
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['username'] = $row['username'];
                    // Redirect to user profile or dashboard
                    header("Location: ../index.php");
                    exit();
                } else {
                    echo "<p>Invalid password.</p>";
                }
            } else {
                echo "<p>User not found.</p>";
            }
        }
        ?>
        
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Drew Hollar">
    <title>Log In</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <header>
    </header>
    <main>
        <div class="login-container">
            <h2>Log In</h2>

            <form action="login.php" method="post">
                <div class="form-group">
                    <label class="form-label" for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block login-btn">Log In</button>
                </div>
            </form>
            <p class="mt-3 text-center">Don't have an account? <a href="../user/signup.php">Register here</a></p>
        </div>
        </div>
    </main>
</body>
</html>