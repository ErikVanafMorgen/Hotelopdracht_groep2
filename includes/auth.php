<?php

/** Controleert of de gebruiker een admin is. */
function isAdmin(): bool
{
    return !empty($_SESSION['gebruiker_id']) && !empty($_SESSION['is_admin']);
}

/** Alleen als admin mag je op deze pagina zijn. */
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
