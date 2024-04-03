<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Drew Hollar">
    <title>Sign Up</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
    </header>
    <main>
        <p>Sign Up</p>
        <?php
        // Include the database connection file
        require_once '../database/db_connect.php';

        // Define a function to validate input
        function validateInput($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        // Define a function to check if username already exists
        function usernameExists($username, $dbHandle) {
            $query = "SELECT * FROM users WHERE username = $1";
            $result = pg_prepare($dbHandle, "check_username", $query);
            $result = pg_execute($dbHandle, "check_username", array($username));
            return (pg_num_rows($result) > 0);
        }

        // Process the form when it is submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = validateInput($_POST['username']);
            $email = validateInput($_POST['email']);
            $password = validateInput($_POST['password']);

            // Check if username already exists
            if (usernameExists($username, $dbHandle)) {
                echo "<p>Username already exists. Please choose a different username.</p>";
            } else {
                // Hash the password
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

        <form action="signup.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Sign Up</button>
        </form>
        <p>Already have an account? <a href="../user/login.php">Log in here</a></p>
    </main>
</body>

</html>
