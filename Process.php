<?php
// Include the database connection
include('Connection.php');

// Sanitize and get form data
$email = filter_var($_POST['user_email'], FILTER_SANITIZE_EMAIL);
$password = $_POST['user_password'];
$age = $_POST['user_age'];
$job = $_POST['user_job'];
$interests = isset($_POST['user_interest']) ? $_POST['user_interest'] : [];

// Hash the password for security
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

try {
    // Start a transaction
    $pdo->beginTransaction();

    // Insert user data into the users table
    $stmt = $pdo->prepare("INSERT INTO users (email, password, age_group, job_role) VALUES (:email, :password, :age, :job)");
    $stmt->execute([
        ':email' => $email,
        ':password' => $hashed_password,
        ':age' => $age,
        ':job' => $job
    ]);

    // Get the user ID of the newly inserted user
    $user_id = $pdo->lastInsertId();

    // Insert user interests into the user_interests table if selected
    if (!empty($interests)) {
        foreach ($interests as $interest) {
            // Check if the interest exists in the interests table
            $stmt = $pdo->prepare("SELECT id FROM interests WHERE interest_name = :interest");
            $stmt->execute([':interest' => $interest]);
            $interest_id = $stmt->fetchColumn();

            // If the interest does not exist, you might want to insert it
            if (!$interest_id) {
                $stmt = $pdo->prepare("INSERT INTO interests (interest_name) VALUES (:interest)");
                $stmt->execute([':interest' => $interest]);
                $interest_id = $pdo->lastInsertId(); // Get the new interest_id
            }

            // Insert the interest_id into user_interests table
            $stmt = $pdo->prepare("INSERT INTO user_interests (user_id, interest_id) VALUES (:user_id, :interest_id)");
            $stmt->execute([
                ':user_id' => $user_id,
                ':interest_id' => $interest_id
            ]);
        }
    }

    // Commit the transaction
    $pdo->commit();

    // Return success response
    echo "success";
} catch (PDOException $e) {
    // Rollback the transaction in case of an error
    $pdo->rollBack();

    // Return error response
    echo "error: " . $e->getMessage();
}
?>
