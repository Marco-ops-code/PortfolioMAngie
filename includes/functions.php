<?php
/**
 * Helpers partagés
 */

declare(strict_types=1);

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/db.php';

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function isActive(string $page): string
{
    $current = basename($_SERVER['PHP_SELF'] ?? '');
    return $current === $page ? 'active' : '';
}

function flash(string $type, string $message): void
{
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function getFlash(): ?array
{
    if (empty($_SESSION['flash'])) {
        return null;
    }
    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);
    return $flash;
}

function requireAdmin(): void
{
    if (empty($_SESSION['admin_logged_in'])) {
        header('Location: index.php');
        exit;
    }
}

function formatDateFr(string $date): string
{
    $months = [
        1 => 'janvier', 2 => 'février', 3 => 'mars', 4 => 'avril',
        5 => 'mai', 6 => 'juin', 7 => 'juillet', 8 => 'août',
        9 => 'septembre', 10 => 'octobre', 11 => 'novembre', 12 => 'décembre',
    ];
    $ts = strtotime($date);
    if ($ts === false) {
        return $date;
    }
    $d = (int) date('j', $ts);
    $m = (int) date('n', $ts);
    $y = date('Y', $ts);
    return $d . ' ' . $months[$m] . ' ' . $y;
}

function getUpcomingConcerts(int $limit = 6): array
{
    if (!dbAvailable()) {
        return demoConcerts($limit);
    }

    try {
        $pdo = getDB();
        $stmt = $pdo->prepare(
            'SELECT * FROM concerts
             WHERE event_date >= CURDATE() AND is_published = 1
             ORDER BY event_date ASC
             LIMIT :lim'
        );
        $stmt->bindValue(':lim', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows ?: demoConcerts($limit);
    } catch (Throwable $e) {
        return demoConcerts($limit);
    }
}

function demoConcerts(int $limit = 6): array
{
    $items = [
        [
            'id' => 1,
            'title' => 'Soirée Soul & Gospel',
            'venue' => 'Salle Pleyel',
            'city' => 'Paris',
            'event_date' => '2026-09-12',
            'ticket_url' => '#contact',
            'status' => 'available',
        ],
        [
            'id' => 2,
            'title' => 'Voix Classiques — Récital',
            'venue' => 'Opéra de Lyon',
            'city' => 'Lyon',
            'event_date' => '2026-10-03',
            'ticket_url' => '#contact',
            'status' => 'available',
        ],
        [
            'id' => 3,
            'title' => 'Night of R&B',
            'venue' => 'Le Trianon',
            'city' => 'Paris',
            'event_date' => '2026-11-18',
            'ticket_url' => '#contact',
            'status' => 'soldout',
        ],
        [
            'id' => 4,
            'title' => 'Worship Experience',
            'venue' => 'Grand Temple',
            'city' => 'Bruxelles',
            'event_date' => '2026-12-05',
            'ticket_url' => '#contact',
            'status' => 'available',
        ],
    ];

    return array_slice($items, 0, $limit);
}

function getTracks(): array
{
    if (!dbAvailable()) {
        return demoTracks();
    }

    try {
        $pdo = getDB();
        $stmt = $pdo->query(
            'SELECT * FROM tracks WHERE is_published = 1 ORDER BY sort_order ASC, id DESC'
        );
        $rows = $stmt->fetchAll();
        return $rows ?: demoTracks();
    } catch (Throwable $e) {
        return demoTracks();
    }
}

function demoTracks(): array
{
    return [
        [
            'id' => 1,
            'title' => 'Velvet Prayer',
            'genre' => 'Gospel · R&B',
            'duration' => '3:42',
            'album' => 'Lumière Intérieure',
            'audio_url' => '',
            'spotify_url' => '#',
            'apple_url' => '#',
            'youtube_url' => '#',
        ],
        [
            'id' => 2,
            'title' => 'Aria of Silence',
            'genre' => 'Classique',
            'duration' => '4:18',
            'album' => 'Lumière Intérieure',
            'audio_url' => '',
            'spotify_url' => '#',
            'apple_url' => '#',
            'youtube_url' => '#',
        ],
        [
            'id' => 3,
            'title' => 'Midnight Honey',
            'genre' => 'R&B',
            'duration' => '3:55',
            'album' => 'Lumière Intérieure',
            'audio_url' => '',
            'spotify_url' => '#',
            'apple_url' => '#',
            'youtube_url' => '#',
        ],
        [
            'id' => 4,
            'title' => 'Grace Rising',
            'genre' => 'Gospel',
            'duration' => '4:01',
            'album' => 'Singles',
            'audio_url' => '',
            'spotify_url' => '#',
            'apple_url' => '#',
            'youtube_url' => '#',
        ],
        [
            'id' => 5,
            'title' => 'Nocturne pour Toi',
            'genre' => 'Classique · Soul',
            'duration' => '5:12',
            'album' => 'Singles',
            'audio_url' => '',
            'spotify_url' => '#',
            'apple_url' => '#',
            'youtube_url' => '#',
        ],
    ];
}
