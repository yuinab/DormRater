<?php
//Author: Drew Hollar

        require_once '../database/db_connect.php';

        function validateInput($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        // check if username already exists
        function usernameExists($username, $dbHandle) {
            $query = "SELECT * FROM users WHERE username = $1";
            $result = pg_prepare($dbHandle, "check_username", $query);
            $result = pg_execute($dbHandle, "check_username", array($username));
            return (pg_num_rows($result) > 0);
        }

        // process the form when it is submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = validateInput($_POST['username']);
            $email = validateInput($_POST['email']);
            $password = validateInput($_POST['password']);

            // username already exists
            if (usernameExists($username, $dbHandle)) {
                echo "<p>Username already exists. Please choose a different username.</p>";
            } else {

                $password_hash = password_hash($password, PASSWORD_DEFAULT);

                // Insert the new user into the database
                $insertQuery = "INSERT INTO users (username, email, password_hash) VALUES ($1, $2, $3)";
                $insertResult = pg_prepare($dbHandle, "insert_user", $insertQuery);
                $insertResult = pg_execute($dbHandle, "insert_user", array($username, $email, $password_hash));

                if ($insertResult) {
                    echo "<p>Registered successfully. You can now <a href='login.php'>login</a>.</p>";
                } else {
                    echo "<p>An error occurred during registration.</p>";
                }
            }
        }
        
        ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Drew Hollar">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <header>
    </header>
    <main>
        <div class="login-container">
            <h2>Sign Up</h2>

            <form action="signup.php" method="post">
                <div class="form-group">
                    <label class="form-label" for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="password">Password:</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password" required>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">Show</button>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block login-btn">Sign Up</button>
                </div>
            </form>
            <p class="mt-3 text-center">Already have an account? <a href="../user/login.php">Log in here</a></p>
        </div>
    </main>
    <!-- arrow fucntion to toggle password-->
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(() => {
            const passwordInput = $('#password');
            const toggleButton = $('#togglePassword');

            // arrow function to toggle password visibility
            const togglePasswordVisibility = () => {
                const type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
                passwordInput.attr('type', type);
                toggleButton.text(type === 'password' ? 'Show' : 'Hide');
            };

            // event listener for button click
            toggleButton.on('click', togglePasswordVisibility);
        });
    </script>
</body>
</html>
