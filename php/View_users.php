<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the connection file
include('Connection.php');  // Adjusted path as both are in the same folder

$users = [];

try {
    // Prepare the query to select all users
    $query = "SELECT * FROM users";
    $stmt = $pdo->prepare($query);
    $stmt->execute();  // Execute the query
    
    // Fetch all the results
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // Error handling
    echo "Error fetching users: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>
    <link rel="stylesheet" href="/css/View.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/index.css"> <!-- Assuming the navigation bar styles are in index.css -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    <!-- Navigation Bar -->
    <div class="fixed-nav-bar">
        <div class="logo"><a href="/index.html"><img src="/images/Logo.png" alt=""></a></div>
        <input type="checkbox" id="menuButton" />
        <label for="menuButton" class="menu-button-label">
            <div class="white-bar"></div>
            <div class="white-bar"></div>
            <div class="white-bar"></div>
            <div class="white-bar"></div>
        </label>
    </div>
    <div class="the-bass">
        <div class="rela-block drop-down-container">
            <div class="drop-down-item"><a href="/html/Register.html"><i class="fa-solid fa-user"></i>Register Now</a></div>
        </div>
        <div class="rela-block drop-down-container">
            <div class="drop-down-item"><a href="/php/View_users.php"><i class="fa-solid fa-window-maximize"></i>View Records</a></div>
        </div>
        <div class="rela-block drop-down-container">
            <div class="drop-down-item"><a href="#about"><i class="fa-solid fa-plane-departure"></i>Services</a></div>
        </div>
        <div class="rela-block drop-down-container">
            <div class="drop-down-item"><a href="#contact"><i class="fa-solid fa-phone"></i>Contact Us</a></div>
        </div>
        <div class="rela-block drop-down-container">
            <div class="drop-down-item"><a href="#services"><i class="fa-brands fa-blogger-b"></i>Blog</a></div>
        </div>
        <div class="rela-block drop-down-container">
            <div class="drop-down-item"><a href="#blog"><i class="fa-solid fa-code"></i>About Us</a></div>
        </div>
    </div>

    <!-- Content for Users List -->
    <div class="container">
        <h1>Users List</h1>

        <?php
        if (!empty($users)) {
            echo "<table border='1' cellpadding='5' cellspacing='0'>";
            echo "<tr><th>ID</th><th>Email</th><th>Password</th><th>Age</th><th>Job</th><th>Interests</th><th>Created At</th></tr>";
            
            // Loop through the results and display them in a table
            foreach ($users as $user) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($user['id']) . "</td>";
                echo "<td>" . htmlspecialchars($user['user_email']) . "</td>";
                echo "<td>" . htmlspecialchars($user['user_password']) . "</td>";
                echo "<td>" . htmlspecialchars($user['user_age']) . "</td>";
                echo "<td>" . htmlspecialchars($user['user_job']) . "</td>";
                echo "<td>" . htmlspecialchars($user['user_interest']) . "</td>";
                echo "<td>" . htmlspecialchars($user['created_at']) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No users found.</p>";
        }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/js/View.js"></script>

</body>
</html>
