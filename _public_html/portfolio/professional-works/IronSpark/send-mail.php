<?php
/**
 * IronSpark Studios — Contact Form Handler
 * Returns JSON response for AJAX submission
 */

header('Content-Type: application/json');
header('X-Content-Type-Options: nosniff');

// Only allow POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed.']);
    exit;
}

// Sanitize helper
function clean(string $value): string {
    return htmlspecialchars(strip_tags(trim($value)), ENT_QUOTES, 'UTF-8');
}

// Validate required fields
$name    = clean($_POST['name']    ?? '');
$email   = clean($_POST['email']   ?? '');
$message = clean($_POST['message'] ?? '');
$company = clean($_POST['company'] ?? '');
$service = clean($_POST['service'] ?? '');

$errors = [];

if (empty($name))    $errors[] = 'Name is required.';
if (empty($email))   $errors[] = 'Email is required.';
if (empty($message)) $errors[] = 'Message is required.';

if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Please provide a valid email address.';
}

if (!empty($errors)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => implode(' ', $errors)]);
    exit;
}

// Simple honeypot (add a hidden field named "website" to the form if needed)
if (!empty($_POST['website'])) {
    // Bot detected — silently succeed
    echo json_encode(['success' => true]);
    exit;
}

// Build email
$to      = 'hello@ironsparkstudios.com';
$subject = 'New Contact: ' . $name . ' — IronSpark Studios';

$service_labels = [
    'entertainment' => 'Entertainment / Animation',
    'healthcare'    => 'Healthcare Content',
    'production'    => 'Creative Production',
    'other'         => 'General Inquiry',
];
$service_label = $service_labels[$service] ?? 'Not specified';

$body = "New message from ironsparkstudios.com\n";
$body .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
$body .= "NAME:    {$name}\n";
$body .= "EMAIL:   {$email}\n";
if (!empty($company)) {
$body .= "COMPANY: {$company}\n";
}
$body .= "SERVICE: {$service_label}\n\n";
$body .= "MESSAGE:\n{$message}\n\n";
$body .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
$body .= "Sent from ironsparkstudios.com\n";

$headers  = "From: noreply@ironsparkstudios.com\r\n";
$headers .= "Reply-To: {$email}\r\n";
$headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

$sent = mail($to, $subject, $body, $headers);

if ($sent) {
    // Auto-reply to sender
    $auto_subject = 'We received your message — IronSpark Studios';
    $auto_body  = "Hi {$name},\n\n";
    $auto_body .= "Thanks for reaching out to IronSpark Studios. We received your message and will be in touch soon.\n\n";
    $auto_body .= "In the meantime, take a look at our work:\nhttps://ironsparkstudios.com/work\n\n";
    $auto_body .= "—\nIronSpark Studios\nhello@ironsparkstudios.com\nhttps://ironsparkstudios.com\n";

    $auto_headers  = "From: IronSpark Studios <hello@ironsparkstudios.com>\r\n";
    $auto_headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    mail($email, $auto_subject, $auto_body, $auto_headers);

    echo json_encode(['success' => true]);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Failed to send. Please email us directly at hello@ironsparkstudios.com']);
}
exit;
