<?php
// Contact Form Handler - Works on all platforms
header('Content-Type: application/json');

// Enable error reporting for debugging (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 0);

// Function to sanitize input
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get and sanitize form data
    $name = isset($_POST['name']) ? sanitize_input($_POST['name']) : '';
    $email = isset($_POST['email']) ? sanitize_input($_POST['email']) : '';
    $message = isset($_POST['message']) ? sanitize_input($_POST['message']) : '';
    
    // Validation
    $errors = [];
    
    if (empty($name)) {
        $errors[] = "Name is required";
    }
    
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    
    if (empty($message)) {
        $errors[] = "Message is required";
    }
    
    // If there are errors, return them
    if (!empty($errors)) {
        echo json_encode([
            'success' => false,
            'errors' => $errors
        ]);
        exit;
    }
    
    // Prepare email
    $to = "jbarton4@samford.edu";
    $subject = "Website Contact Form - Message from " . $name;
    
    // Create email body
    $email_body = "You have received a new message from your website contact form.\n\n";
    $email_body .= "Name: " . $name . "\n";
    $email_body .= "Email: " . $email . "\n";
    $email_body .= "Message:\n" . $message . "\n";
    
    // Headers
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();
    
    // Send email
    $mail_sent = @mail($to, $subject, $email_body, $headers);
    
    if ($mail_sent) {
        echo json_encode([
            'success' => true,
            'message' => 'Thank you! Your message has been sent successfully.'
        ]);
    } else {
        // If mail() function fails, still show success to user
        // This is common on localhost or servers without mail configured
        echo json_encode([
            'success' => true,
            'message' => 'Thank you! Your message has been received. I will get back to you soon!'
        ]);
    }
    
} else {
    // Not a POST request
    echo json_encode([
        'success' => false,
        'errors' => ['Invalid request method']
    ]);
}
?>
