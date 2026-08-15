<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: contact.php');
    exit;
}

$name    = trim((string) ($_POST['name'] ?? ''));
$email   = trim((string) ($_POST['email'] ?? ''));
$subject = trim((string) ($_POST['subject'] ?? ''));
$message = trim((string) ($_POST['message'] ?? ''));
$type    = (string) ($_POST['type'] ?? 'fan');

$allowedTypes = ['fan', 'booking', 'press'];
if (!in_array($type, $allowedTypes, true)) {
    $type = 'fan';
}

if ($name === '' || $email === '' || $subject === '' || $message === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    flash('error', 'Merci de remplir correctement tous les champs.');
    header('Location: contact.php');
    exit;
}

$saved = false;

if (dbAvailable()) {
    try {
        $pdo = getDB();
        $stmt = $pdo->prepare(
            'INSERT INTO messages (name, email, subject, message, type) VALUES (?, ?, ?, ?, ?)'
        );
        $stmt->execute([$name, $email, $subject, $message, $type]);
        $saved = true;
    } catch (Throwable $e) {
        $saved = false;
    }
}

if (!$saved) {
    // Fallback fichier local si MySQL n'est pas encore configuré
    $logDir = __DIR__ . '/uploads';
    if (!is_dir($logDir)) {
        mkdir($logDir, 0755, true);
    }
    $line = sprintf(
        "[%s] %s | %s | %s | %s | %s%s",
        date('c'),
        $type,
        $name,
        $email,
        $subject,
        str_replace(["\r", "\n"], ' ', $message),
        PHP_EOL
    );
    file_put_contents($logDir . '/messages.log', $line, FILE_APPEND | LOCK_EX);
}

flash('success', 'Merci. Votre message a bien été envoyé. L’équipe d’Angela Volcimus Louis vous répondra rapidement.');
header('Location: contact.php');
exit;
