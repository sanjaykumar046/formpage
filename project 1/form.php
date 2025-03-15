<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to CSS -->
</head>
<body>
    <div class="form-container">
        <h2 class="form-title">User Registration</h2>

        <?php
        // Database Connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "user_db";

        $conn = new mysqli($servername, $username, $password, $database);

        // Check Connection
        if ($conn->connect_error) {
            die("<p class='error'>Database Connection Failed: " . $conn->connect_error . "</p>");
        }

        // Handle Form Submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $conn->real_escape_string($_POST["name"]);
            $email = $conn->real_escape_string($_POST["email"]);
            $phone = $conn->real_escape_string($_POST["phone"]);
            $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Encrypt password
            $rating = $conn->real_escape_string($_POST["rating"]);
            $address = $conn->real_escape_string($_POST["address"]);
            $message = $conn->real_escape_string($_POST["message"]);

            // Insert Data into Database
            $sql = "INSERT INTO users (name, email, phone, password, rating, address, message) 
                    VALUES ('$name', '$email', '$phone', '$password', '$rating', '$address', '$message')";

            if ($conn->query($sql) === TRUE) {
                echo "<p class='success'>User Registered Successfully!</p>";
            } else {
                echo "<p class='error'>Error: " . $conn->error . "</p>";
            }
        }

        // Close Connection
        $conn->close();
        ?>

        <form id="userForm" action="" method="POST">
            <div class="input-box">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="Enter your full name" required>
            </div>

            <div class="input-box">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>

            <div class="input-box">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
            </div>

            <div class="input-box">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>

            <div class="input-box">
                <label for="rating">Feedback Rating</label>
                <select id="rating" name="rating" required>
                    <option value="">Select Rating</option>
                    <option value="1">⭐ - Poor</option>
                    <option value="2">⭐⭐ - Fair</option>
                    <option value="3">⭐⭐⭐ - Good</option>
                    <option value="4">⭐⭐⭐⭐ - Very Good</option>
                    <option value="5">⭐⭐⭐⭐⭐ - Excellent</option>
                </select>
            </div>

            <div class="input-box">
                <label for="address">Address</label>
                <textarea id="address" name="address" rows="3" placeholder="Enter your address" required></textarea>
            </div>

            <div class="input-box">
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="4" placeholder="Enter your message"></textarea>
            </div>

            <input type="submit" value="Register">
        </form>
    </div>

    
</body>
</html>
