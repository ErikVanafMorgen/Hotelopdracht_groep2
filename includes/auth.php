<?php

function isAdmin(): bool
{
    return !empty($_SESSION['gebruiker_id']) && !empty($_SESSION['is_admin']);
}

function requireAdmin(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isAdmin()) {
        http_response_code(403);
        exit('Geen toegang. Alleen admins kunnen kamers beheren.');
    }
}
