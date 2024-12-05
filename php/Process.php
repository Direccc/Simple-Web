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
        
        if (isset($_POST['user_interest'])) {
            $interests = $_POST['user_interest'];  // Get the array of interests
            $interests_json = json_encode($interests);  // Convert the array into a JSON string
        } else {
            $interests_json = null;  // If no interests are selected
        }
        // Debugging: Echo the values to check if data is being received
        // Remove echo after testing
        error_log("Email: $email");
        error_log("Password: $password");
        error_log("Age: $age");
        error_log("Job: $job");
        error_log("Interests: $interests");

        // Prepare the SQL query to insert the data into the users table
        $query = "INSERT INTO users (user_email, user_password, user_age, user_job, user_interest) 
                  VALUES (:user_email, :user_password, :user_age, :user_job, :user_interest)";
        $stmt = $pdo->prepare($query);
        
        // Bind parameters and execute the query
        $stmt->bindParam(':user_email', $email);
        $stmt->bindParam(':user_password', $password);
        $stmt->bindParam(':user_age', $age);
        $stmt->bindParam(':user_job', $job);
        $stmt->bindParam(':user_interest', $interests_json);  // Bind the JSON-encoded interests
        $stmt->execute();

        // If the insertion is successful, return "success"
        echo "success"; 
    } else {
        echo "Invalid request method";  // This message helps identify the issue during debugging
    }

} catch (PDOException $e) {
    // Log detailed error for debugging
    error_log("Database error: " . $e->getMessage());
    echo "An error occurred. Please try again later.";  // Display a generic error message to the user
}
?>
