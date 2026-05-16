<?php
// Change working directory to the project root so all
// require_once 'includes/...' paths resolve correctly.
chdir(__DIR__ . '/..');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = rtrim($uri, '/') ?: '/';

$map = [
    '/'               => 'index.php',
    '/about'          => 'about.php',
    '/services'       => 'services.php',
    '/work'           => 'work.php',
    '/contact'        => 'contact.php',
    '/send-mail'      => 'send-mail.php',
    '/privacy-policy' => 'privacy-policy.php',
    '/terms'          => 'terms.php',
];

$file = $map[$uri] ?? '404.php';
require $file;
