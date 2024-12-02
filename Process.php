<?php
$host = 'sql113.infinityfree.com';  
$dbname = 'if0_37822752_EmployeeDB';
$username = 'if0_37822752'; 
$password = 'WuZi34yviF';  

try {
    // Create a new PDO instance and set error mode to exception
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the request method is POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the form data
        $email = $_POST['user_email'];
        $password = $_POST['user_password'];
        $age = $_POST['user_age'];
        $job = $_POST['user_job'];
        $interests = json_encode($_POST['user_interest']);  // Store interests as JSON

        // Prepare the SQL query to insert the data into the users table
        $query = "INSERT INTO users (user_email, user_password, user_age, user_job, user_interest) 
                  VALUES (:user_email, :user_password, :user_age, :user_job, :user_interest)";
        $stmt = $pdo->prepare($query);
        
        // Bind parameters and execute the query
        $stmt->bindParam(':user_email', $email);
        $stmt->bindParam(':user_password', password_hash($password, PASSWORD_DEFAULT)); // Hash the password
        $stmt->bindParam(':user_age', $age);
        $stmt->bindParam(':user_job', $job);
        $stmt->bindParam(':user_interest', $interests);
        $stmt->execute();

        // Return success response back to the frontend (JavaScript will handle the response)
        echo "success"; // Send success message back
    } else {
        // Handle any other method (if necessary)
        echo "Invalid request";
    }

} catch (PDOException $e) {
    // Log error, but do not echo any message back
    error_log("Connection failed: " . $e->getMessage());
    echo "An error occurred, please try again later.";
}
?>
