<?php
$host = 'sql113.infinityfree.com';  
$dbname = 'if0_37822752_EmployeeDB';
$username = 'if0_37822752'; 
$password = 'WuZi34yviF';  

try {
    // Create a new PDO instance and set error mode to exception
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // No echo statement here, connection is silently established
} catch (PDOException $e) {
    // Log the error details instead of displaying them
    error_log("Connection failed: " . $e->getMessage());  // Logs to server log file
    echo "Connection failed. Please try again later.";
    exit;  // Exit the script if connection fails
}
?>
